<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

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
            'response' => 'Please type a message.',
        ]);
        exit;
    }

    // Simple echo-style response for now; replace with real AI logic later
    $reply = "You said: " . $message;

    echo json_encode([
        'success' => true,
        'response' => $reply,
    ]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'response' => 'Server error.',
    ]);
}

