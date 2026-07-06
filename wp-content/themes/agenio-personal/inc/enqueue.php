<?php
/**
 * Theme assets.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_enqueue_scripts', 'agenio_enqueue_assets' );
function agenio_enqueue_assets() {
    $mode = agenio_theme_option( 'performance_mode', 'balanced' );

    wp_enqueue_style( 'agenio-framework', agenio_asset_url( 'css/agenio-framework.css' ), array(), AGENIO_PERSONAL_VERSION );
    wp_enqueue_style( 'agenio-style', get_stylesheet_uri(), array( 'agenio-framework' ), AGENIO_PERSONAL_VERSION );

    // If the original template assets are copied into assets/original, load them selectively.
    if ( agenio_original_asset_exists( 'css/vendor/bootstrap.min.css' ) ) {
        wp_enqueue_style( 'agenio-bootstrap', agenio_original_asset_url( 'css/vendor/bootstrap.min.css' ), array(), AGENIO_PERSONAL_VERSION );
    }

    if ( 'minimal' !== $mode && agenio_original_asset_exists( 'css/plugins/swiper.min.css' ) && ( is_front_page() || is_singular( 'case_study' ) ) ) {
        wp_enqueue_style( 'agenio-swiper', agenio_original_asset_url( 'css/plugins/swiper.min.css' ), array(), AGENIO_PERSONAL_VERSION );
    }

    if ( agenio_original_asset_exists( 'css/style.css' ) ) {
        wp_enqueue_style( 'agenio-original-style', agenio_original_asset_url( 'css/style.css' ), array(), AGENIO_PERSONAL_VERSION );
    }

    wp_enqueue_script( 'agenio-theme', agenio_asset_url( 'js/agenio-theme.js' ), array(), AGENIO_PERSONAL_VERSION, true );

    if ( 'minimal' !== $mode && agenio_original_asset_exists( 'js/plugins/swiper.js' ) && ( is_front_page() || is_singular( 'case_study' ) ) ) {
        wp_enqueue_script( 'agenio-swiper', agenio_original_asset_url( 'js/plugins/swiper.js' ), array(), AGENIO_PERSONAL_VERSION, true );
    }

    if ( 'full' === $mode && agenio_original_asset_exists( 'js/plugins/gsap.min.js' ) ) {
        wp_enqueue_script( 'agenio-gsap', agenio_original_asset_url( 'js/plugins/gsap.min.js' ), array(), AGENIO_PERSONAL_VERSION, true );
    }

    wp_localize_script(
        'agenio-theme',
        'AgenioTheme',
        array(
            'performanceMode' => $mode,
            'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
        )
    );
}

add_action( 'wp_head', 'agenio_dynamic_css_variables', 30 );
function agenio_dynamic_css_variables() {
    $primary   = sanitize_hex_color( agenio_theme_option( 'primary_color', '#B8FF3D' ) ) ?: '#B8FF3D';
    $secondary = sanitize_hex_color( agenio_theme_option( 'secondary_color', '#111111' ) ) ?: '#111111';
    $accent    = sanitize_hex_color( agenio_theme_option( 'accent_color', '#ffffff' ) ) ?: '#ffffff';
    ?>
    <style id="agenio-dynamic-css">
        :root {
            --agenio-primary: <?php echo esc_html( $primary ); ?>;
            --agenio-secondary: <?php echo esc_html( $secondary ); ?>;
            --agenio-accent: <?php echo esc_html( $accent ); ?>;
        }
    </style>
    <?php
}
