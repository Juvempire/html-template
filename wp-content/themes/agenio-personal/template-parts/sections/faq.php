<section class="content-section muted" id="faq">
    <div class="agenio-container narrow">
        <p class="eyebrow"><?php esc_html_e( 'FAQ', 'agenio-personal' ); ?></p>
        <h2><?php esc_html_e( 'Questions before starting a project.', 'agenio-personal' ); ?></h2>
        <div class="faq-list">
            <?php
            $q = new WP_Query( array( 'post_type' => 'faq', 'posts_per_page' => 8, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_status' => 'publish' ) );
            if ( $q->have_posts() ) :
                while ( $q->have_posts() ) : $q->the_post(); ?>
                    <details class="faq-item"><summary><?php the_title(); ?></summary><div><?php the_content(); ?></div></details>
                <?php endwhile; wp_reset_postdata();
            else : ?>
                <details class="faq-item" open><summary><?php esc_html_e( 'Do you work with international clients?', 'agenio-personal' ); ?></summary><div><p><?php esc_html_e( 'Yes. The site is structured for remote collaboration with English-speaking clients in Europe, Canada and the United States.', 'agenio-personal' ); ?></p></div></details>
                <details class="faq-item"><summary><?php esc_html_e( 'Can you handle SEO and development together?', 'agenio-personal' ); ?></summary><div><p><?php esc_html_e( 'Yes. The structure is built around WordPress development, technical SEO, speed and conversion.', 'agenio-personal' ); ?></p></div></details>
            <?php endif; ?>
        </div>
    </div>
</section>
