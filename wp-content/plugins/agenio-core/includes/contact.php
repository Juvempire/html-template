<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_shortcode( 'agenio_contact_form', 'agenio_contact_form_shortcode' );
function agenio_contact_form_shortcode() {
    $mode = agenio_core_get_option( 'contact_mode', 'built_in' );
    if ( 'disabled' === $mode ) {
        return '';
    }
    if ( 'shortcode' === $mode && agenio_core_get_option( 'contact_shortcode' ) ) {
        return do_shortcode( agenio_core_get_option( 'contact_shortcode' ) );
    }

    ob_start();
    if ( isset( $_GET['agenio_contact'] ) && 'success' === $_GET['agenio_contact'] ) {
        echo '<div class="agenio-form-notice success">' . esc_html( agenio_core_get_option( 'contact_success_message' ) ) . '</div>';
    }
    if ( isset( $_GET['agenio_contact'] ) && 'error' === $_GET['agenio_contact'] ) {
        echo '<div class="agenio-form-notice error">' . esc_html( agenio_core_get_option( 'contact_error_message' ) ) . '</div>';
    }
    ?>
    <form class="agenio-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="agenio_contact_submit">
        <?php wp_nonce_field( 'agenio_contact_submit', 'agenio_contact_nonce' ); ?>
        <p><label>Name <input required type="text" name="name"></label></p>
        <p><label>Email <input required type="email" name="email"></label></p>
        <p><label>Website / Company <input type="text" name="website"></label></p>
        <p><label>What do you need?
            <select name="service">
                <option>New website</option>
                <option>Website redesign</option>
                <option>SEO</option>
                <option>Technical SEO</option>
                <option>Digital marketing</option>
                <option>Speed optimization</option>
            </select>
        </label></p>
        <p><label>Estimated budget
            <select name="budget">
                <option>Under $500</option>
                <option>$500–$1,500</option>
                <option>$1,500–$3,000</option>
                <option>$3,000+</option>
            </select>
        </label></p>
        <p><label>Timeline
            <select name="timeline">
                <option>ASAP</option>
                <option>This month</option>
                <option>1–3 months</option>
                <option>Just exploring</option>
            </select>
        </label></p>
        <p><label>Message <textarea required name="message" rows="6"></textarea></label></p>
        <p class="agenio-hp-field"><label>Leave this field empty <input type="text" name="company_url"></label></p>
        <button class="agenio-btn" type="submit">Submit Message</button>
    </form>
    <?php
    return ob_get_clean();
}

add_action( 'admin_post_agenio_contact_submit', 'agenio_handle_contact_submit' );
add_action( 'admin_post_nopriv_agenio_contact_submit', 'agenio_handle_contact_submit' );
function agenio_handle_contact_submit() {
    if ( ! isset( $_POST['agenio_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['agenio_contact_nonce'] ) ), 'agenio_contact_submit' ) ) {
        wp_safe_redirect( add_query_arg( 'agenio_contact', 'error', wp_get_referer() ?: home_url( '/' ) ) );
        exit;
    }

    if ( ! empty( $_POST['company_url'] ) ) {
        wp_safe_redirect( add_query_arg( 'agenio_contact', 'success', wp_get_referer() ?: home_url( '/' ) ) );
        exit;
    }

    $name     = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email    = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $website  = isset( $_POST['website'] ) ? sanitize_text_field( wp_unslash( $_POST['website'] ) ) : '';
    $service  = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
    $budget   = isset( $_POST['budget'] ) ? sanitize_text_field( wp_unslash( $_POST['budget'] ) ) : '';
    $timeline = isset( $_POST['timeline'] ) ? sanitize_text_field( wp_unslash( $_POST['timeline'] ) ) : '';
    $message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( ! $name || ! is_email( $email ) || ! $message ) {
        wp_safe_redirect( add_query_arg( 'agenio_contact', 'error', wp_get_referer() ?: home_url( '/' ) ) );
        exit;
    }

    $to = sanitize_email( agenio_core_get_option( 'contact_email', get_option( 'admin_email' ) ) );
    $subject = 'New website lead from ' . $name;
    $body = "Name: {$name}\nEmail: {$email}\nWebsite/Company: {$website}\nService: {$service}\nBudget: {$budget}\nTimeline: {$timeline}\n\nMessage:\n{$message}";
    $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

    $sent = wp_mail( $to, $subject, $body, $headers );
    wp_safe_redirect( add_query_arg( 'agenio_contact', $sent ? 'success' : 'error', wp_get_referer() ?: home_url( '/' ) ) );
    exit;
}

add_action( 'wp_head', 'agenio_contact_form_styles' );
function agenio_contact_form_styles() {
    echo '<style>.agenio-hp-field{position:absolute;left:-9999px}.agenio-contact-form{display:grid;gap:16px}.agenio-contact-form input,.agenio-contact-form select,.agenio-contact-form textarea{width:100%;padding:14px;border:1px solid rgba(0,0,0,.14);border-radius:12px}.agenio-form-notice{padding:14px;border-radius:12px;margin-bottom:18px}.agenio-form-notice.success{background:#e9ffd7}.agenio-form-notice.error{background:#ffe8e8}</style>';
}
