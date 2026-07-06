<section class="content-section muted">
    <div class="agenio-container section-heading-row">
        <div>
            <p class="eyebrow"><?php esc_html_e( 'Process', 'agenio-personal' ); ?></p>
            <h2><?php esc_html_e( 'A simple workflow from audit to launch.', 'agenio-personal' ); ?></h2>
        </div>
    </div>
    <div class="agenio-container process-grid">
        <?php
        $q = new WP_Query( array( 'post_type' => 'process_step', 'posts_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_status' => 'publish' ) );
        if ( $q->have_posts() ) :
            $i = 1;
            while ( $q->have_posts() ) : $q->the_post(); ?>
                <article class="process-card"><span><?php echo esc_html( sprintf( '%02d', $i++ ) ); ?></span><h3><?php the_title(); ?></h3><p><?php echo esc_html( get_the_excerpt() ); ?></p></article>
            <?php endwhile; wp_reset_postdata();
        else :
            $steps = array( 'Audit & Strategy', 'Structure & Design', 'Develop & Optimize', 'Launch & Improve' );
            foreach ( $steps as $i => $step ) : ?>
                <article class="process-card"><span><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span><h3><?php echo esc_html( $step ); ?></h3><p><?php esc_html_e( 'Replace this placeholder with a real process step.', 'agenio-personal' ); ?></p></article>
            <?php endforeach;
        endif;
        ?>
    </div>
</section>
