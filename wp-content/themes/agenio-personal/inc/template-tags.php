<?php
/**
 * Template tag helpers.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function agenio_render_button( $text = '', $url = '', $class = 'agenio-btn' ) {
    $text = $text ?: agenio_theme_option( 'global_cta_text', 'Book a Free Consultation' );
    $url  = $url ?: agenio_theme_option( 'global_cta_url', home_url( '/contact/' ) );
    ?>
    <a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>">
        <span><?php echo esc_html( $text ); ?></span>
        <?php echo agenio_safe_svg_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </a>
    <?php
}

function agenio_posted_on() {
    printf(
        '<time datetime="%1$s">%2$s</time>',
        esc_attr( get_the_date( DATE_W3C ) ),
        esc_html( get_the_date() )
    );
}

function agenio_archive_title() {
    if ( is_post_type_archive( 'service' ) ) {
        return __( 'Services', 'agenio-personal' );
    }
    if ( is_post_type_archive( 'case_study' ) ) {
        return __( 'Case Studies', 'agenio-personal' );
    }
    if ( is_search() ) {
        return sprintf( __( 'Search results for: %s', 'agenio-personal' ), get_search_query() );
    }
    return get_the_archive_title();
}
