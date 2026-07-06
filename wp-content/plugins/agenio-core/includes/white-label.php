<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'admin_footer_text', 'agenio_admin_footer_text' );
function agenio_admin_footer_text() {
    return esc_html( agenio_core_get_option( 'admin_footer_text', 'Built with Agenio Personal.' ) );
}

add_action( 'login_head', 'agenio_login_logo_css' );
function agenio_login_logo_css() {
    $logo_id = absint( agenio_core_get_option( 'login_logo_id', 0 ) );
    $logo = $logo_id ? wp_get_attachment_image_url( $logo_id, 'full' ) : '';
    if ( ! $logo ) {
        return;
    }
    echo '<style>.login h1 a{background-image:url(' . esc_url( $logo ) . ');background-size:contain;width:220px;height:90px}</style>';
}

add_filter( 'login_headerurl', function() { return home_url( '/' ); } );
add_filter( 'login_headertext', function() { return agenio_core_get_option( 'brand_name', get_bloginfo( 'name' ) ); } );
