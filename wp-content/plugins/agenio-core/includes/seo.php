<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'agenio_output_seo_fallback', 2 );
function agenio_output_seo_fallback() {
    $mode = agenio_core_get_option( 'seo_mode', 'theme' );

    if ( 'off' === $mode ) {
        return;
    }

    if ( agenio_core_has_rank_math() ) {
        return;
    }

    if ( 'rank_math_compat' === $mode ) {
        return;
    }

    $title = '';
    $description = '';
    $image = '';

    if ( is_singular() ) {
        $post_id = get_queried_object_id();
        $title = get_post_meta( $post_id, '_agenio_seo_title', true ) ?: wp_get_document_title();
        $description = get_post_meta( $post_id, '_agenio_seo_description', true ) ?: get_the_excerpt( $post_id );
        if ( has_post_thumbnail( $post_id ) ) {
            $image = wp_get_attachment_image_url( get_post_thumbnail_id( $post_id ), 'full' );
        }
    } else {
        $title = wp_get_document_title();
        $description = agenio_core_get_option( 'seo_default_description', get_bloginfo( 'description' ) );
    }

    $description = $description ? wp_strip_all_tags( $description ) : agenio_core_get_option( 'seo_default_description', '' );
    $canonical = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );

    $og_id = absint( agenio_core_get_option( 'seo_default_og_image_id', 0 ) );
    if ( ! $image && $og_id ) {
        $image = wp_get_attachment_image_url( $og_id, 'full' );
    }

    echo "\n<!-- Agenio SEO fallback: disabled automatically when Rank Math is active. -->\n";
    echo '<meta name="description" content="' . esc_attr( wp_trim_words( $description, 30, '' ) ) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url( $canonical ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( wp_trim_words( $description, 30, '' ) ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $canonical ) . '">' . "\n";
    echo '<meta property="og:type" content="' . ( is_singular( 'post' ) ? 'article' : 'website' ) . '">' . "\n";
    if ( $image ) {
        echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
    }
    echo '<meta name="twitter:card" content="' . esc_attr( agenio_core_get_option( 'twitter_card_type', 'summary_large_image' ) ) . '">' . "\n";

    if ( agenio_core_get_option( 'seo_enable_schema', 1 ) ) {
        agenio_output_schema_jsonld();
    }
}

function agenio_output_schema_jsonld() {
    $org_logo_id = absint( agenio_core_get_option( 'organization_logo_id', 0 ) );
    $org_logo = $org_logo_id ? wp_get_attachment_image_url( $org_logo_id, 'full' ) : '';

    $graph = array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            array(
                '@type' => 'Organization',
                '@id'   => home_url( '/#organization' ),
                'name'  => agenio_core_get_option( 'organization_name', get_bloginfo( 'name' ) ),
                'url'   => agenio_core_get_option( 'organization_url', home_url( '/' ) ),
            ),
            array(
                '@type' => 'WebSite',
                '@id'   => home_url( '/#website' ),
                'url'   => home_url( '/' ),
                'name'  => get_bloginfo( 'name' ),
            ),
        ),
    );

    if ( $org_logo ) {
        $graph['@graph'][0]['logo'] = $org_logo;
    }

    if ( is_singular( 'service' ) ) {
        $graph['@graph'][] = array(
            '@type'       => 'Service',
            '@id'         => get_permalink() . '#service',
            'name'        => get_the_title(),
            'description' => wp_strip_all_tags( get_the_excerpt() ),
            'provider'    => array( '@id' => home_url( '/#organization' ) ),
            'url'         => get_permalink(),
        );
    }

    if ( is_singular( 'post' ) ) {
        $graph['@graph'][] = array(
            '@type'         => 'Article',
            '@id'           => get_permalink() . '#article',
            'headline'      => get_the_title(),
            'datePublished' => get_the_date( DATE_W3C ),
            'dateModified'  => get_the_modified_date( DATE_W3C ),
            'author'        => array( '@type' => 'Person', 'name' => get_the_author() ),
            'publisher'     => array( '@id' => home_url( '/#organization' ) ),
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
