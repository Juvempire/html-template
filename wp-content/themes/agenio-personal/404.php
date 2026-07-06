<?php get_header(); ?>
<section class="page-hero compact">
    <div class="agenio-container narrow">
        <p class="eyebrow"><?php esc_html_e( '404', 'agenio-personal' ); ?></p>
        <h1><?php esc_html_e( 'Page not found', 'agenio-personal' ); ?></h1>
        <p><?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'agenio-personal' ); ?></p>
        <?php agenio_render_button( __( 'Go Home', 'agenio-personal' ), home_url( '/' ) ); ?>
    </div>
</section>
<?php get_footer(); ?>
