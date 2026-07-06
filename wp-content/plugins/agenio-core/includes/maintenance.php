<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_menu', 'agenio_maintenance_submenu' );
function agenio_maintenance_submenu() {
    add_submenu_page( 'agenio-settings', 'Maintenance', 'Maintenance', 'manage_options', 'agenio-maintenance', 'agenio_render_maintenance_page' );
}

function agenio_render_maintenance_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_POST['agenio_flush_rewrites'] ) && check_admin_referer( 'agenio_maintenance_action' ) ) {
        flush_rewrite_rules();
        echo '<div class="updated"><p>Rewrite rules flushed.</p></div>';
    }

    if ( isset( $_POST['agenio_reset_options'] ) && check_admin_referer( 'agenio_maintenance_action' ) ) {
        update_option( 'agenio_core_options', agenio_core_default_options() );
        echo '<div class="updated"><p>Options reset.</p></div>';
    }

    if ( isset( $_POST['agenio_import_options'] ) && check_admin_referer( 'agenio_maintenance_action' ) ) {
        $raw = isset( $_POST['agenio_import_json'] ) ? wp_unslash( $_POST['agenio_import_json'] ) : '';
        $decoded = json_decode( $raw, true );
        if ( is_array( $decoded ) ) {
            update_option( 'agenio_core_options', agenio_sanitize_options( $decoded ) );
            echo '<div class="updated"><p>Options imported.</p></div>';
        } else {
            echo '<div class="error"><p>Invalid JSON.</p></div>';
        }
    }

    $export = wp_json_encode( agenio_core_get_options(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    ?>
    <div class="wrap">
        <h1>Agenio Maintenance</h1>
        <form method="post">
            <?php wp_nonce_field( 'agenio_maintenance_action' ); ?>
            <p><button class="button button-primary" name="agenio_flush_rewrites" value="1">Flush rewrite rules</button></p>
            <p><button class="button" name="agenio_reset_options" value="1" onclick="return confirm('Reset all Agenio options?')">Reset options</button></p>
        </form>
        <h2>Export settings JSON</h2>
        <textarea class="large-text code" rows="14" readonly><?php echo esc_textarea( $export ); ?></textarea>
        <h2>Import settings JSON</h2>
        <form method="post">
            <?php wp_nonce_field( 'agenio_maintenance_action' ); ?>
            <textarea class="large-text code" rows="10" name="agenio_import_json" placeholder="Paste exported Agenio settings JSON here"></textarea>
            <p><button class="button button-primary" name="agenio_import_options" value="1">Import settings</button></p>
        </form>
    </div>
    <?php
}
