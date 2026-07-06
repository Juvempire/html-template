<?php
get_header();
while ( have_posts() ) : the_post();
?>
<article <?php post_class(); ?>>
    <section class="page-hero compact">
        <div class="agenio-container narrow">
            <p class="eyebrow"><?php esc_html_e( 'Portfolio', 'agenio-personal' ); ?></p>
            <h1><?php the_title(); ?></h1>
            <p class="hero-copy"><?php echo esc_html( get_the_excerpt() ); ?></p>
        </div>
    </section>
    <section class="content-section">
        <div class="agenio-container narrow entry-content">
            <?php if ( has_post_thumbnail() ) : ?><figure class="featured-media"><?php the_post_thumbnail( 'large' ); ?></figure><?php endif; ?>
            <?php the_content(); ?>
        </div>
    </section>
</article>
<?php endwhile; get_footer(); ?>
