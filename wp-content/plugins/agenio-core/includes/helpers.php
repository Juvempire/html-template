<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function agenio_core_default_options() {
    return array(
        'brand_name'              => get_bloginfo( 'name' ),
        'brand_short_name'        => get_bloginfo( 'name' ),
        'logo_light_id'           => 0,
        'logo_dark_id'            => 0,
        'favicon_id'              => 0,
        'primary_color'           => '#B8FF3D',
        'secondary_color'         => '#111111',
        'accent_color'            => '#ffffff',
        'global_cta_text'         => 'Book a Free Consultation',
        'global_cta_url'          => home_url( '/contact/' ),
        'hero_eyebrow'            => 'WordPress Web Design • SEO • Digital Marketing',
        'hero_title'              => 'Fast, SEO-focused websites that turn visitors into leads.',
        'hero_subtitle'           => 'I help growth-focused businesses build clean, search-friendly and conversion-focused WordPress websites for international markets.',
        'hero_primary_cta_text'   => 'Request a Free Website Audit',
        'hero_primary_cta_url'    => home_url( '/contact/' ),
        'final_cta_title'         => 'Ready to build a faster, SEO-focused website?',
        'final_cta_text'          => 'Send your website URL or project idea and I will help you identify the best next step.',
        'home_sections'           => array( 'hero', 'trust-bar', 'services', 'why-work', 'case-studies', 'process', 'testimonials', 'faq', 'final-cta' ),
        'disabled_sections'       => array(),
        'contact_email'           => get_option( 'admin_email' ),
        'contact_phone'           => '',
        'contact_mode'            => 'built_in',
        'contact_shortcode'       => '',
        'contact_success_message' => 'Thank you. Your message has been sent successfully.',
        'contact_error_message'   => 'Something went wrong. Please try again.',
        'seo_mode'                => 'theme',
        'seo_default_description' => 'WordPress web design, SEO and digital marketing services for growth-focused businesses.',
        'seo_default_og_image_id' => 0,
        'seo_enable_schema'       => 1,
        'seo_enable_breadcrumbs'  => 1,
        'organization_name'       => get_bloginfo( 'name' ),
        'organization_url'        => home_url( '/' ),
        'organization_logo_id'    => 0,
        'twitter_card_type'       => 'summary_large_image',
        'performance_mode'        => 'balanced',
        'disable_preloader'       => 1,
        'disable_custom_cursor'   => 1,
        'disable_smooth_scroll'   => 0,
        'disable_gsap_mobile'     => 1,
        'footer_tagline'          => 'Fast, SEO-focused WordPress websites for growth-focused businesses.',
        'footer_copyright'        => '© ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All Rights Reserved.',
        'login_logo_id'           => 0,
        'admin_footer_text'       => 'Built with Agenio Personal.',
    );
}

function agenio_core_get_options() {
    $saved = get_option( 'agenio_core_options', array() );
    return wp_parse_args( is_array( $saved ) ? $saved : array(), agenio_core_default_options() );
}

function agenio_core_get_option( $key, $default = '' ) {
    $options = agenio_core_get_options();
    return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
}

function agenio_core_update_option( $key, $value ) {
    $options = agenio_core_get_options();
    $options[ $key ] = $value;
    update_option( 'agenio_core_options', $options );
}

function agenio_core_sanitize_checkbox( $value ) {
    return ! empty( $value ) ? 1 : 0;
}

function agenio_core_has_rank_math() {
    return defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' ) || function_exists( 'rank_math' );
}
