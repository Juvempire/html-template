<?php
/**
 * Template Name: Contact / Lead Form
 * Description: Conversion-focused contact page with Agenio contact form.
 */
get_header();
?>
<section class="page-hero compact">
    <div class="agenio-container narrow">
        <p class="eyebrow"><?php esc_html_e( 'Contact', 'agenio-personal' ); ?></p>
        <h1><?php esc_html_e( 'Tell me what you want to build or improve.', 'agenio-personal' ); ?></h1>
        <p class="hero-copy"><?php esc_html_e( 'Send your website URL, project idea or SEO challenge. I will use your details to understand the best next step.', 'agenio-personal' ); ?></p>
    </div>
</section>
<section class="content-section">
    <div class="agenio-container content-sidebar-layout">
        <div class="entry-content">
            <?php echo do_shortcode( '[agenio_contact_form]' ); ?>
        </div>
        <aside class="service-sidebar">
            <h2><?php esc_html_e( 'Good fit for', 'agenio-personal' ); ?></h2>
            <ul class="check-list">
                <li><?php echo agenio_safe_svg_icon( 'check' ); ?> <?php esc_html_e( 'WordPress website design', 'agenio-personal' ); ?></li>
                <li><?php echo agenio_safe_svg_icon( 'check' ); ?> <?php esc_html_e( 'Technical SEO audit', 'agenio-personal' ); ?></li>
                <li><?php echo agenio_safe_svg_icon( 'check' ); ?> <?php esc_html_e( 'Website speed optimization', 'agenio-personal' ); ?></li>
                <li><?php echo agenio_safe_svg_icon( 'check' ); ?> <?php esc_html_e( 'Landing page design', 'agenio-personal' ); ?></li>
            </ul>
        </aside>
    </div>
</section>
<?php get_footer(); ?>
