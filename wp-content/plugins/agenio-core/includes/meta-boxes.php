<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'add_meta_boxes', 'agenio_add_meta_boxes' );
function agenio_add_meta_boxes() {
    add_meta_box( 'agenio_service_meta', 'Service Details', 'agenio_service_meta_box', 'service', 'normal', 'high' );
    add_meta_box( 'agenio_case_meta', 'Case Study Details', 'agenio_case_meta_box', 'case_study', 'normal', 'high' );
    add_meta_box( 'agenio_seo_meta', 'SEO Fallback Fields', 'agenio_seo_meta_box', array( 'post', 'page', 'service', 'case_study', 'portfolio' ), 'normal', 'default' );
}

function agenio_textarea_field( $id, $label, $value, $description = '' ) {
    echo '<p><label for="' . esc_attr( $id ) . '"><strong>' . esc_html( $label ) . '</strong></label></p>';
    echo '<textarea style="width:100%;min-height:110px" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '">' . esc_textarea( $value ) . '</textarea>';
    if ( $description ) {
        echo '<p class="description">' . esc_html( $description ) . '</p>';
    }
}

function agenio_input_field( $id, $label, $value, $description = '' ) {
    echo '<p><label for="' . esc_attr( $id ) . '"><strong>' . esc_html( $label ) . '</strong></label></p>';
    echo '<input style="width:100%" type="text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '" value="' . esc_attr( $value ) . '">';
    if ( $description ) {
        echo '<p class="description">' . esc_html( $description ) . '</p>';
    }
}

function agenio_service_meta_box( $post ) {
    wp_nonce_field( 'agenio_save_meta', 'agenio_meta_nonce' );
    agenio_input_field( '_agenio_short_intro', 'Short intro', get_post_meta( $post->ID, '_agenio_short_intro', true ) );
    agenio_textarea_field( '_agenio_deliverables', 'Deliverables', get_post_meta( $post->ID, '_agenio_deliverables', true ), 'One item per line.' );
    agenio_textarea_field( '_agenio_pain_points', 'Pain points', get_post_meta( $post->ID, '_agenio_pain_points', true ), 'One pain point per line.' );
    agenio_textarea_field( '_agenio_related_keywords', 'Related keywords', get_post_meta( $post->ID, '_agenio_related_keywords', true ), 'One keyword per line for content planning.' );
}

function agenio_case_meta_box( $post ) {
    wp_nonce_field( 'agenio_save_meta', 'agenio_meta_nonce' );
    agenio_input_field( '_agenio_client_name', 'Client / project name', get_post_meta( $post->ID, '_agenio_client_name', true ) );
    agenio_input_field( '_agenio_project_url', 'Project URL', get_post_meta( $post->ID, '_agenio_project_url', true ) );
    agenio_textarea_field( '_agenio_metrics', 'Metrics / results', get_post_meta( $post->ID, '_agenio_metrics', true ), 'One metric per line. Example: PageSpeed 52 → 91' );
    agenio_textarea_field( '_agenio_tools_used', 'Tools used', get_post_meta( $post->ID, '_agenio_tools_used', true ), 'One tool per line.' );
}

function agenio_seo_meta_box( $post ) {
    wp_nonce_field( 'agenio_save_meta', 'agenio_meta_nonce' );
    agenio_input_field( '_agenio_seo_title', 'SEO title fallback', get_post_meta( $post->ID, '_agenio_seo_title', true ) );
    agenio_textarea_field( '_agenio_seo_description', 'Meta description fallback', get_post_meta( $post->ID, '_agenio_seo_description', true ) );
    agenio_input_field( '_agenio_primary_keyword', 'Primary keyword', get_post_meta( $post->ID, '_agenio_primary_keyword', true ) );
    agenio_textarea_field( '_agenio_secondary_keywords', 'Secondary keywords', get_post_meta( $post->ID, '_agenio_secondary_keywords', true ), 'One keyword per line.' );
}

add_action( 'save_post', 'agenio_save_meta_boxes' );
function agenio_save_meta_boxes( $post_id ) {
    if ( ! isset( $_POST['agenio_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['agenio_meta_nonce'] ) ), 'agenio_save_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $text_fields = array( '_agenio_short_intro', '_agenio_client_name', '_agenio_project_url', '_agenio_seo_title', '_agenio_primary_keyword' );
    foreach ( $text_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
        }
    }

    $textarea_fields = array( '_agenio_deliverables', '_agenio_pain_points', '_agenio_related_keywords', '_agenio_metrics', '_agenio_tools_used', '_agenio_seo_description', '_agenio_secondary_keywords' );
    foreach ( $textarea_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_textarea_field( wp_unslash( $_POST[ $field ] ) ) );
        }
    }
}
