<?php
/**
 * Plugin Name: Agenio Core
 * Plugin URI: https://example.com/
 * Description: Core functionality for the Agenio Personal theme: CPTs, settings, SEO fallback, contact forms, performance and white label.
 * Version: 0.1.0
 * Author: Your Brand
 * Text Domain: agenio-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'AGENIO_CORE_VERSION', '0.1.0' );
define( 'AGENIO_CORE_FILE', __FILE__ );
define( 'AGENIO_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'AGENIO_CORE_URI', plugin_dir_url( __FILE__ ) );

require_once AGENIO_CORE_DIR . 'includes/helpers.php';
require_once AGENIO_CORE_DIR . 'includes/post-types.php';
require_once AGENIO_CORE_DIR . 'includes/meta-boxes.php';
require_once AGENIO_CORE_DIR . 'includes/settings.php';
require_once AGENIO_CORE_DIR . 'includes/seo.php';
require_once AGENIO_CORE_DIR . 'includes/contact.php';
require_once AGENIO_CORE_DIR . 'includes/white-label.php';
require_once AGENIO_CORE_DIR . 'includes/maintenance.php';

register_activation_hook( __FILE__, 'agenio_core_activate' );
function agenio_core_activate() {
    agenio_register_post_types();
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'agenio_core_deactivate' );
function agenio_core_deactivate() {
    flush_rewrite_rules();
}
