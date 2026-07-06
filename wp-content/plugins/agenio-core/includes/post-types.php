<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'agenio_register_post_types' );
function agenio_register_post_types() {
    $items = array(
        'service' => array(
            'singular' => 'Service',
            'plural'   => 'Services',
            'slug'     => 'services',
            'icon'     => 'dashicons-hammer',
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'page-attributes' ),
        ),
        'case_study' => array(
            'singular' => 'Case Study',
            'plural'   => 'Case Studies',
            'slug'     => 'case-studies',
            'icon'     => 'dashicons-analytics',
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        ),
        'portfolio' => array(
            'singular' => 'Portfolio Item',
            'plural'   => 'Portfolio',
            'slug'     => 'portfolio',
            'icon'     => 'dashicons-portfolio',
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        ),
        'testimonial' => array(
            'singular' => 'Testimonial',
            'plural'   => 'Testimonials',
            'slug'     => 'testimonials',
            'icon'     => 'dashicons-format-quote',
            'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        ),
        'faq' => array(
            'singular' => 'FAQ',
            'plural'   => 'FAQs',
            'slug'     => 'faqs',
            'icon'     => 'dashicons-editor-help',
            'supports' => array( 'title', 'editor', 'revisions', 'page-attributes' ),
        ),
        'process_step' => array(
            'singular' => 'Process Step',
            'plural'   => 'Process Steps',
            'slug'     => 'process-steps',
            'icon'     => 'dashicons-list-view',
            'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'page-attributes' ),
        ),
    );

    foreach ( $items as $post_type => $args ) {
        register_post_type(
            $post_type,
            array(
                'labels' => array(
                    'name'          => $args['plural'],
                    'singular_name' => $args['singular'],
                    'add_new_item'  => 'Add New ' . $args['singular'],
                    'edit_item'     => 'Edit ' . $args['singular'],
                    'new_item'      => 'New ' . $args['singular'],
                    'view_item'     => 'View ' . $args['singular'],
                    'search_items'  => 'Search ' . $args['plural'],
                ),
                'public'       => true,
                'has_archive'  => true,
                'rewrite'      => array( 'slug' => $args['slug'] ),
                'menu_icon'    => $args['icon'],
                'show_in_rest' => true,
                'supports'     => $args['supports'],
            )
        );
    }

    register_taxonomy(
        'service_category',
        'service',
        array(
            'label'        => 'Service Categories',
            'hierarchical' => true,
            'rewrite'      => array( 'slug' => 'service-category' ),
            'show_in_rest' => true,
        )
    );

    register_taxonomy(
        'case_study_category',
        'case_study',
        array(
            'label'        => 'Case Study Categories',
            'hierarchical' => true,
            'rewrite'      => array( 'slug' => 'case-study-category' ),
            'show_in_rest' => true,
        )
    );
}
