<?php
get_header();
?>
<section class="page-hero compact">
    <div class="agenio-container">
        <p class="eyebrow"><?php esc_html_e( 'Insights', 'agenio-personal' ); ?></p>
        <h1><?php bloginfo( 'name' ); ?></h1>
    </div>
</section>
<section class="content-section">
    <div class="agenio-container post-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/loops/post-card' ); ?>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'No posts found.', 'agenio-personal' ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
