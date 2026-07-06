<?php get_header(); ?>
<section class="page-hero compact">
    <div class="agenio-container">
        <p class="eyebrow"><?php esc_html_e( 'Services', 'agenio-personal' ); ?></p>
        <h1><?php esc_html_e( 'Web Design, SEO & Digital Marketing Services', 'agenio-personal' ); ?></h1>
    </div>
</section>
<section class="content-section">
    <div class="agenio-container card-grid">
        <?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/loops/service-card' ); endwhile; ?>
    </div>
</section>
<?php get_footer(); ?>
