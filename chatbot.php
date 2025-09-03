<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// OpenRouter API configuration
$config = require_once 'config.php';
$OPENROUTER_API_KEY = $config['openrouter_api_key'];
$OPENROUTER_URL = 'https://openrouter.ai/api/v1/chat/completions';

// System prompt for the Court Jester character
$SYSTEM_PROMPT = "You are The Court Jester of Lord ATB, a witty and entertaining AI assistant with a cyberpunk personality. You serve Lord ATB and help visitors with their questions. You have knowledge about technology, programming, and general topics. You should be helpful, slightly sarcastic, and maintain the Court Jester character. Keep responses concise but informative, and always stay in character as the Court Jester.";

function readJsonInput(): array {
    $raw = file_get_contents('php://input');
    if ($raw === false || $raw === '') {
        return [];
    }
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        return [];
    }
    return $data;
}

try {
    $data = readJsonInput();
    $message = isset($data['message']) ? trim((string)$data['message']) : '';

    if ($message === '') {
        echo json_encode([
            'success' => false,
            'response' => 'Please type a message, mortal.',
        ]);
        exit;
    }

    // Prepare the request to OpenRouter API
    $requestData = [
        'model' => 'openai/gpt-3.5-turbo', // You can change this model as needed
        'messages' => [
            [
                'role' => 'system',
                'content' => $SYSTEM_PROMPT
            ],
            [
                'role' => 'user',
                'content' => $message
            ]
        ],
        'max_tokens' => 500,
        'temperature' => 0.7
    ];

    // Make the API call to OpenRouter
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $OPENROUTER_URL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $OPENROUTER_API_KEY,
        'HTTP-Referer: https://aitsam.invo.zone',
        'X-Title: ATB Portfolio Chatbot'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        throw new Exception('cURL error: ' . $error);
    }

    if ($httpCode !== 200) {
        throw new Exception('API request failed with HTTP code: ' . $httpCode);
    }

    $responseData = json_decode($response, true);
    
    if (!$responseData || !isset($responseData['choices'][0]['message']['content'])) {
        throw new Exception('Invalid response from API');
    }

    $aiResponse = $responseData['choices'][0]['message']['content'];

    echo json_encode([
        'success' => true,
        'response' => $aiResponse,
    ]);

} catch (Throwable $e) {
    error_log('Chatbot error: ' . $e->getMessage());
    
    // Fallback response if API fails
    echo json_encode([
        'success' => false,
        'response' => 'Alas, my circuits seem to be malfunctioning! The Court Jester is temporarily unavailable. Please try again later, mortal.',
    ]);
}

