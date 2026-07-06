<?php
get_header();
while ( have_posts() ) : the_post();
$deliverables = get_post_meta( get_the_ID(), '_agenio_deliverables', true );
?>
<article <?php post_class(); ?>>
    <section class="page-hero service-hero">
        <div class="agenio-container narrow">
            <p class="eyebrow"><?php esc_html_e( 'Service', 'agenio-personal' ); ?></p>
            <h1><?php the_title(); ?></h1>
            <p class="hero-copy"><?php echo esc_html( get_post_meta( get_the_ID(), '_agenio_short_intro', true ) ?: get_the_excerpt() ); ?></p>
            <?php agenio_render_button(); ?>
        </div>
    </section>
    <section class="content-section">
        <div class="agenio-container content-sidebar-layout">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <aside class="service-sidebar">
                <h2><?php esc_html_e( 'What you get', 'agenio-personal' ); ?></h2>
                <?php if ( $deliverables ) : ?>
                    <ul class="check-list">
                        <?php foreach ( array_filter( array_map( 'trim', explode( "\n", $deliverables ) ) ) as $item ) : ?>
                            <li><?php echo agenio_safe_svg_icon( 'check' ); ?> <?php echo esc_html( $item ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </aside>
        </div>
    </section>
</article>
<?php endwhile; get_footer(); ?>
