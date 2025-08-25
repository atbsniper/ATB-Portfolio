<?php
// Theme setup
function cyberpunk_portfolio_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'cyberpunk-portfolio'),
    ));
}
add_action('after_setup_theme', 'cyberpunk_portfolio_setup');

// Enqueue scripts and styles
function cyberpunk_portfolio_scripts() {
    wp_enqueue_style('cyberpunk-portfolio-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'cyberpunk_portfolio_scripts');

// Custom excerpt length
function cyberpunk_portfolio_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'cyberpunk_portfolio_excerpt_length');

// Custom excerpt more
function cyberpunk_portfolio_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'cyberpunk_portfolio_excerpt_more');

// Add custom body classes
function cyberpunk_portfolio_body_classes($classes) {
    if (is_single()) {
        $classes[] = 'single-post-page';
    }
    if (is_home()) {
        $classes[] = 'blog-page';
    }
    return $classes;
}
add_filter('body_class', 'cyberpunk_portfolio_body_classes');
