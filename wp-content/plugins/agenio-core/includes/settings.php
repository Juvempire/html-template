<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_menu', 'agenio_settings_menu' );
function agenio_settings_menu() {
    add_menu_page( 'Agenio Settings', 'Agenio', 'manage_options', 'agenio-settings', 'agenio_render_settings_page', 'dashicons-admin-customizer', 58 );
}

add_action( 'admin_init', 'agenio_register_settings' );
function agenio_register_settings() {
    register_setting( 'agenio_core_options_group', 'agenio_core_options', 'agenio_sanitize_options' );
}

function agenio_sanitize_options( $input ) {
    $defaults = agenio_core_default_options();
    $clean = array();

    $text_keys = array(
        'brand_name','brand_short_name','global_cta_text','global_cta_url','hero_eyebrow','hero_title','hero_subtitle','hero_primary_cta_text','hero_primary_cta_url','final_cta_title','final_cta_text','contact_email','contact_phone','contact_shortcode','contact_success_message','contact_error_message','seo_default_description','organization_name','organization_url','twitter_card_type','footer_tagline','footer_copyright','admin_footer_text'
    );
    foreach ( $text_keys as $key ) {
        $clean[ $key ] = isset( $input[ $key ] ) ? sanitize_text_field( $input[ $key ] ) : $defaults[ $key ];
    }

    foreach ( array( 'primary_color','secondary_color','accent_color' ) as $key ) {
        $clean[ $key ] = isset( $input[ $key ] ) && sanitize_hex_color( $input[ $key ] ) ? sanitize_hex_color( $input[ $key ] ) : $defaults[ $key ];
    }

    foreach ( array( 'logo_light_id','logo_dark_id','favicon_id','seo_default_og_image_id','organization_logo_id','login_logo_id' ) as $key ) {
        $clean[ $key ] = isset( $input[ $key ] ) ? absint( $input[ $key ] ) : 0;
    }

    $clean['performance_mode'] = isset( $input['performance_mode'] ) && in_array( $input['performance_mode'], array( 'minimal', 'balanced', 'full' ), true ) ? $input['performance_mode'] : 'balanced';
    $clean['seo_mode']         = isset( $input['seo_mode'] ) && in_array( $input['seo_mode'], array( 'theme', 'rank_math_compat', 'off' ), true ) ? $input['seo_mode'] : 'theme';
    $clean['contact_mode']     = isset( $input['contact_mode'] ) && in_array( $input['contact_mode'], array( 'built_in', 'shortcode', 'disabled' ), true ) ? $input['contact_mode'] : 'built_in';

    foreach ( array( 'seo_enable_schema','seo_enable_breadcrumbs','disable_preloader','disable_custom_cursor','disable_smooth_scroll','disable_gsap_mobile' ) as $key ) {
        $clean[ $key ] = isset( $input[ $key ] ) ? 1 : 0;
    }

    $clean['home_sections'] = isset( $input['home_sections'] ) ? array_filter( array_map( 'sanitize_key', explode( ',', $input['home_sections'] ) ) ) : $defaults['home_sections'];
    $clean['disabled_sections'] = isset( $input['disabled_sections'] ) ? array_filter( array_map( 'sanitize_key', explode( ',', $input['disabled_sections'] ) ) ) : array();

    return wp_parse_args( $clean, $defaults );
}

function agenio_render_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $o = agenio_core_get_options();
    ?>
    <div class="wrap">
        <h1>Agenio Settings</h1>
        <p>Personal white-label WordPress system for web design, SEO and digital marketing.</p>
        <form method="post" action="options.php">
            <?php settings_fields( 'agenio_core_options_group' ); ?>
            <h2>Branding</h2>
            <table class="form-table" role="presentation">
                <?php agenio_settings_text_row( 'brand_name', 'Brand name', $o ); ?>
                <?php agenio_settings_text_row( 'brand_short_name', 'Short brand name', $o ); ?>
                <?php agenio_settings_text_row( 'logo_light_id', 'Light logo attachment ID', $o, 'Upload logo in Media Library and paste attachment ID here.' ); ?>
                <?php agenio_settings_text_row( 'logo_dark_id', 'Dark logo attachment ID', $o ); ?>
                <?php agenio_settings_text_row( 'favicon_id', 'Favicon attachment ID', $o ); ?>
                <?php agenio_settings_text_row( 'primary_color', 'Primary color', $o, 'Use hex, e.g. #B8FF3D' ); ?>
                <?php agenio_settings_text_row( 'secondary_color', 'Secondary color', $o ); ?>
                <?php agenio_settings_text_row( 'accent_color', 'Accent color', $o ); ?>
                <?php agenio_settings_text_row( 'global_cta_text', 'Global CTA text', $o ); ?>
                <?php agenio_settings_text_row( 'global_cta_url', 'Global CTA URL', $o ); ?>
            </table>

            <h2>Homepage</h2>
            <table class="form-table" role="presentation">
                <?php agenio_settings_text_row( 'hero_eyebrow', 'Hero eyebrow', $o ); ?>
                <?php agenio_settings_text_row( 'hero_title', 'Hero title', $o ); ?>
                <?php agenio_settings_textarea_row( 'hero_subtitle', 'Hero subtitle', $o ); ?>
                <?php agenio_settings_text_row( 'hero_primary_cta_text', 'Hero primary CTA text', $o ); ?>
                <?php agenio_settings_text_row( 'hero_primary_cta_url', 'Hero primary CTA URL', $o ); ?>
                <?php agenio_settings_textarea_row( 'home_sections', 'Homepage sections order', array( 'home_sections' => implode( ',', (array) $o['home_sections'] ) ), 'Comma-separated: hero,trust-bar,services,why-work,case-studies,process,testimonials,faq,final-cta' ); ?>
                <?php agenio_settings_textarea_row( 'disabled_sections', 'Disabled sections', array( 'disabled_sections' => implode( ',', (array) $o['disabled_sections'] ) ), 'Comma-separated section slugs.' ); ?>
            </table>

            <h2>SEO</h2>
            <table class="form-table" role="presentation">
                <tr><th>SEO mode</th><td><?php agenio_select( 'seo_mode', $o['seo_mode'], array( 'theme' => 'Theme SEO', 'rank_math_compat' => 'Rank Math Compatibility', 'off' => 'Off' ) ); ?></td></tr>
                <?php agenio_settings_textarea_row( 'seo_default_description', 'Default meta description', $o ); ?>
                <?php agenio_settings_text_row( 'seo_default_og_image_id', 'Default OG image attachment ID', $o ); ?>
                <?php agenio_settings_text_row( 'organization_logo_id', 'Organization logo attachment ID', $o ); ?>
                <?php agenio_settings_text_row( 'organization_name', 'Organization name', $o ); ?>
                <?php agenio_settings_text_row( 'organization_url', 'Organization URL', $o ); ?>
                <tr><th>Schema</th><td><?php agenio_checkbox( 'seo_enable_schema', $o['seo_enable_schema'], 'Enable JSON-LD schema fallback' ); ?></td></tr>
                <tr><th>Breadcrumbs</th><td><?php agenio_checkbox( 'seo_enable_breadcrumbs', $o['seo_enable_breadcrumbs'], 'Enable breadcrumb schema fallback' ); ?></td></tr>
            </table>

            <h2>Performance</h2>
            <table class="form-table" role="presentation">
                <tr><th>Performance mode</th><td><?php agenio_select( 'performance_mode', $o['performance_mode'], array( 'minimal' => 'Minimal', 'balanced' => 'Balanced', 'full' => 'Full animation' ) ); ?></td></tr>
                <tr><th>Preloader</th><td><?php agenio_checkbox( 'disable_preloader', $o['disable_preloader'], 'Disable preloader' ); ?></td></tr>
                <tr><th>Custom cursor</th><td><?php agenio_checkbox( 'disable_custom_cursor', $o['disable_custom_cursor'], 'Disable custom cursor' ); ?></td></tr>
                <tr><th>Smooth scroll</th><td><?php agenio_checkbox( 'disable_smooth_scroll', $o['disable_smooth_scroll'], 'Disable smooth scroll' ); ?></td></tr>
                <tr><th>GSAP mobile</th><td><?php agenio_checkbox( 'disable_gsap_mobile', $o['disable_gsap_mobile'], 'Disable GSAP on mobile' ); ?></td></tr>
            </table>

            <h2>Contact</h2>
            <table class="form-table" role="presentation">
                <tr><th>Contact mode</th><td><?php agenio_select( 'contact_mode', $o['contact_mode'], array( 'built_in' => 'Built-in form', 'shortcode' => 'Shortcode', 'disabled' => 'Disabled' ) ); ?></td></tr>
                <?php agenio_settings_text_row( 'contact_email', 'Recipient email', $o ); ?>
                <?php agenio_settings_text_row( 'contact_phone', 'Phone', $o ); ?>
                <?php agenio_settings_text_row( 'contact_shortcode', 'Contact shortcode', $o ); ?>
                <?php agenio_settings_text_row( 'contact_success_message', 'Success message', $o ); ?>
                <?php agenio_settings_text_row( 'contact_error_message', 'Error message', $o ); ?>
            </table>

            <h2>White Label</h2>
            <table class="form-table" role="presentation">
                <?php agenio_settings_text_row( 'login_logo_id', 'Login logo attachment ID', $o ); ?>
                <?php agenio_settings_text_row( 'admin_footer_text', 'Admin footer text', $o ); ?>
                <?php agenio_settings_textarea_row( 'footer_tagline', 'Footer tagline', $o ); ?>
                <?php agenio_settings_text_row( 'footer_copyright', 'Footer copyright', $o ); ?>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function agenio_settings_text_row( $key, $label, $o, $description = '' ) {
    echo '<tr><th scope="row"><label for="agenio_' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th><td>';
    echo '<input class="regular-text" id="agenio_' . esc_attr( $key ) . '" type="text" name="agenio_core_options[' . esc_attr( $key ) . ']" value="' . esc_attr( $o[ $key ] ?? '' ) . '">';
    if ( $description ) {
        echo '<p class="description">' . esc_html( $description ) . '</p>';
    }
    echo '</td></tr>';
}

function agenio_settings_textarea_row( $key, $label, $o, $description = '' ) {
    echo '<tr><th scope="row"><label for="agenio_' . esc_attr( $key ) . '">' . esc_html( $label ) . '</label></th><td>';
    echo '<textarea class="large-text" rows="3" id="agenio_' . esc_attr( $key ) . '" name="agenio_core_options[' . esc_attr( $key ) . ']">' . esc_textarea( $o[ $key ] ?? '' ) . '</textarea>';
    if ( $description ) {
        echo '<p class="description">' . esc_html( $description ) . '</p>';
    }
    echo '</td></tr>';
}

function agenio_select( $key, $value, $options ) {
    echo '<select name="agenio_core_options[' . esc_attr( $key ) . ']">';
    foreach ( $options as $k => $label ) {
        echo '<option value="' . esc_attr( $k ) . '" ' . selected( $value, $k, false ) . '>' . esc_html( $label ) . '</option>';
    }
    echo '</select>';
}

function agenio_checkbox( $key, $value, $label ) {
    echo '<label><input type="checkbox" name="agenio_core_options[' . esc_attr( $key ) . ']" value="1" ' . checked( $value, 1, false ) . '> ' . esc_html( $label ) . '</label>';
}
