<?php get_header(); ?>
<section class="page-hero compact">
    <div class="agenio-container">
        <p class="eyebrow"><?php esc_html_e( 'Case Studies', 'agenio-personal' ); ?></p>
        <h1><?php esc_html_e( 'SEO, Performance & Web Design Results', 'agenio-personal' ); ?></h1>
    </div>
</section>
<section class="content-section">
    <div class="agenio-container card-grid">
        <?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/loops/case-study-card' ); endwhile; ?>
    </div>
</section>
<?php get_footer(); ?>
