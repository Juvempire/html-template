<?php
/**
 * Front page with lightweight section registry.
 */
get_header();

foreach ( agenio_get_home_sections() as $section ) {
    if ( agenio_is_section_enabled( $section ) ) {
        get_template_part( 'template-parts/sections/' . sanitize_file_name( $section ) );
    }
}

get_footer();
