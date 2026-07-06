<section class="content-section">
    <div class="agenio-container section-heading-row">
        <div>
            <p class="eyebrow"><?php esc_html_e( 'Testimonials', 'agenio-personal' ); ?></p>
            <h2><?php esc_html_e( 'What clients say about the work.', 'agenio-personal' ); ?></h2>
        </div>
    </div>
    <div class="agenio-container testimonial-grid">
        <?php
        $q = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => 3, 'post_status' => 'publish' ) );
        if ( $q->have_posts() ) :
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <blockquote class="testimonial-card"><p><?php echo esc_html( get_the_content() ); ?></p><cite><?php the_title(); ?></cite></blockquote>
            <?php endwhile; wp_reset_postdata();
        else : ?>
            <blockquote class="testimonial-card"><p><?php esc_html_e( 'Add testimonials later to strengthen trust and conversion.', 'agenio-personal' ); ?></p><cite><?php esc_html_e( 'Future Client', 'agenio-personal' ); ?></cite></blockquote>
        <?php endif; ?>
    </div>
</section>
