<section class="content-section" id="services">
    <div class="agenio-container section-heading-row">
        <div>
            <p class="eyebrow"><?php esc_html_e( 'Services', 'agenio-personal' ); ?></p>
            <h2><?php esc_html_e( 'Websites built for speed, search and conversion.', 'agenio-personal' ); ?></h2>
        </div>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ?: home_url( '/services/' ) ); ?>" class="text-link"><?php esc_html_e( 'All services', 'agenio-personal' ); ?></a>
    </div>
    <div class="agenio-container card-grid">
        <?php
        $q = new WP_Query( array( 'post_type' => 'service', 'posts_per_page' => 6, 'post_status' => 'publish' ) );
        if ( $q->have_posts() ) :
            while ( $q->have_posts() ) : $q->the_post();
                get_template_part( 'template-parts/loops/service-card' );
            endwhile;
            wp_reset_postdata();
        else :
            $fallbacks = array( 'WordPress Website Design', 'Technical SEO', 'Website Speed Optimization' );
            foreach ( $fallbacks as $title ) : ?>
                <article class="content-card"><h3><?php echo esc_html( $title ); ?></h3><p><?php esc_html_e( 'Create this service in the WordPress admin to replace this placeholder.', 'agenio-personal' ); ?></p></article>
            <?php endforeach;
        endif;
        ?>
    </div>
</section>
