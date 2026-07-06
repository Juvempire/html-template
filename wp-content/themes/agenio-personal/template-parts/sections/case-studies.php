<section class="content-section" id="case-studies">
    <div class="agenio-container section-heading-row">
        <div>
            <p class="eyebrow"><?php esc_html_e( 'Case studies', 'agenio-personal' ); ?></p>
            <h2><?php esc_html_e( 'Results-focused work, not only visual output.', 'agenio-personal' ); ?></h2>
        </div>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'case_study' ) ?: home_url( '/case-studies/' ) ); ?>" class="text-link"><?php esc_html_e( 'View case studies', 'agenio-personal' ); ?></a>
    </div>
    <div class="agenio-container card-grid">
        <?php
        $q = new WP_Query( array( 'post_type' => 'case_study', 'posts_per_page' => 3, 'post_status' => 'publish' ) );
        if ( $q->have_posts() ) :
            while ( $q->have_posts() ) : $q->the_post();
                get_template_part( 'template-parts/loops/case-study-card' );
            endwhile;
            wp_reset_postdata();
        else : ?>
            <article class="content-card wide"><h3><?php esc_html_e( 'Add your first case study', 'agenio-personal' ); ?></h3><p><?php esc_html_e( 'Use the Case Studies post type to document problem, solution, tools and measurable improvements.', 'agenio-personal' ); ?></p></article>
        <?php endif; ?>
    </div>
</section>
