<?php
/**
 * Theme helper functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function agenio_theme_option( $key, $default = '' ) {
    if ( function_exists( 'agenio_core_get_option' ) ) {
        return agenio_core_get_option( $key, $default );
    }

    $fallbacks = array(
        'brand_name'              => get_bloginfo( 'name' ),
        'brand_short_name'        => get_bloginfo( 'name' ),
        'primary_color'           => '#B8FF3D',
        'secondary_color'         => '#111111',
        'accent_color'            => '#ffffff',
        'global_cta_text'         => 'Book a Free Consultation',
        'global_cta_url'          => home_url( '/contact/' ),
        'contact_email'           => get_option( 'admin_email' ),
        'contact_phone'           => '',
        'performance_mode'        => 'balanced',
        'seo_mode'                => 'theme',
        'footer_copyright'        => '© ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All Rights Reserved.',
    );

    return array_key_exists( $key, $fallbacks ) ? $fallbacks[ $key ] : $default;
}

function agenio_asset_url( $path = '' ) {
    return esc_url( AGENIO_PERSONAL_URI . '/assets/' . ltrim( $path, '/' ) );
}

function agenio_original_asset_exists( $relative_path ) {
    return file_exists( AGENIO_PERSONAL_DIR . '/assets/original/' . ltrim( $relative_path, '/' ) );
}

function agenio_original_asset_url( $relative_path ) {
    return esc_url( AGENIO_PERSONAL_URI . '/assets/original/' . ltrim( $relative_path, '/' ) );
}

function agenio_get_logo_url( $variant = 'light' ) {
    $key = 'dark' === $variant ? 'logo_dark_id' : 'logo_light_id';
    $id  = absint( agenio_theme_option( $key, 0 ) );

    if ( $id ) {
        $url = wp_get_attachment_image_url( $id, 'full' );
        if ( $url ) {
            return $url;
        }
    }

    return '';
}

function agenio_get_home_sections() {
    $default = array( 'hero', 'trust-bar', 'services', 'why-work', 'case-studies', 'process', 'testimonials', 'faq', 'final-cta' );
    $sections = agenio_theme_option( 'home_sections', $default );

    if ( is_string( $sections ) ) {
        $sections = array_filter( array_map( 'sanitize_key', explode( ',', $sections ) ) );
    }

    return is_array( $sections ) && $sections ? $sections : $default;
}

function agenio_is_section_enabled( $section ) {
    $disabled = agenio_theme_option( 'disabled_sections', array() );
    if ( is_string( $disabled ) ) {
        $disabled = array_filter( array_map( 'sanitize_key', explode( ',', $disabled ) ) );
    }
    return ! in_array( sanitize_key( $section ), (array) $disabled, true );
}

function agenio_has_rank_math() {
    return defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' ) || function_exists( 'rank_math' );
}

function agenio_safe_svg_icon( $name ) {
    $allowed = array(
        'arrow' => '<svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12h14M13 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'check' => '<svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    );

    return isset( $allowed[ $name ] ) ? $allowed[ $name ] : '';
}
