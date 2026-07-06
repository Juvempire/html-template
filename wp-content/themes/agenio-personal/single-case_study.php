<?php
get_header();
while ( have_posts() ) : the_post();
$metrics = get_post_meta( get_the_ID(), '_agenio_metrics', true );
?>
<article <?php post_class(); ?>>
    <section class="page-hero compact">
        <div class="agenio-container narrow">
            <p class="eyebrow"><?php esc_html_e( 'Case Study', 'agenio-personal' ); ?></p>
            <h1><?php the_title(); ?></h1>
            <p class="hero-copy"><?php echo esc_html( get_the_excerpt() ); ?></p>
        </div>
    </section>
    <?php if ( $metrics ) : ?>
        <section class="metrics-strip">
            <div class="agenio-container metrics-grid">
                <?php foreach ( array_filter( array_map( 'trim', explode( "\n", $metrics ) ) ) as $line ) : ?>
                    <div class="metric-card"><strong><?php echo esc_html( $line ); ?></strong></div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
    <section class="content-section">
        <div class="agenio-container narrow entry-content">
            <?php if ( has_post_thumbnail() ) : ?><figure class="featured-media"><?php the_post_thumbnail( 'large' ); ?></figure><?php endif; ?>
            <?php the_content(); ?>
        </div>
    </section>
</article>
<?php endwhile; get_footer(); ?>
