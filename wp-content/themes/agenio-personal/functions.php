<?php
/**
 * Agenio Personal theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'AGENIO_PERSONAL_VERSION', '0.1.0' );
define( 'AGENIO_PERSONAL_DIR', get_template_directory() );
define( 'AGENIO_PERSONAL_URI', get_template_directory_uri() );

require_once AGENIO_PERSONAL_DIR . '/inc/helpers.php';
require_once AGENIO_PERSONAL_DIR . '/inc/setup.php';
require_once AGENIO_PERSONAL_DIR . '/inc/enqueue.php';
require_once AGENIO_PERSONAL_DIR . '/inc/template-tags.php';
