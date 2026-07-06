<?php
/**
 * Theme setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'after_setup_theme', 'agenio_personal_setup' );
function agenio_personal_setup() {
    load_theme_textdomain( 'agenio-personal', AGENIO_PERSONAL_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/agenio-framework.css' );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'agenio-personal' ),
            'footer'  => __( 'Footer Menu', 'agenio-personal' ),
        )
    );
}

add_filter( 'body_class', 'agenio_body_classes' );
function agenio_body_classes( $classes ) {
    $classes[] = 'agenio-theme';
    $classes[] = 'performance-' . sanitize_html_class( agenio_theme_option( 'performance_mode', 'balanced' ) );
    return $classes;
}
