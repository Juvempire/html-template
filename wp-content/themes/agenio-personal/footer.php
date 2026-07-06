<?php
/**
 * Footer template.
 */
?>
</main>

<?php do_action( 'agenio_before_footer' ); ?>

<footer class="site-footer" role="contentinfo">
    <div class="agenio-container site-footer__grid">
        <div class="site-footer__brand">
            <h2><?php echo esc_html( agenio_theme_option( 'brand_name', get_bloginfo( 'name' ) ) ); ?></h2>
            <p><?php echo esc_html( agenio_theme_option( 'footer_tagline', 'Fast, SEO-focused WordPress websites for growth-focused businesses.' ) ); ?></p>
        </div>
        <div class="site-footer__contact">
            <h3><?php esc_html_e( 'Contact', 'agenio-personal' ); ?></h3>
            <?php if ( agenio_theme_option( 'contact_email' ) ) : ?>
                <p><a href="mailto:<?php echo esc_attr( antispambot( agenio_theme_option( 'contact_email' ) ) ); ?>"><?php echo esc_html( antispambot( agenio_theme_option( 'contact_email' ) ) ); ?></a></p>
            <?php endif; ?>
            <?php if ( agenio_theme_option( 'contact_phone' ) ) : ?>
                <p><?php echo esc_html( agenio_theme_option( 'contact_phone' ) ); ?></p>
            <?php endif; ?>
        </div>
        <nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer navigation', 'agenio-personal' ); ?>">
            <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => false ) ); ?>
        </nav>
    </div>
    <div class="agenio-container site-footer__bottom">
        <p><?php echo esc_html( agenio_theme_option( 'footer_copyright', '© ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All Rights Reserved.' ) ); ?></p>
        <a class="back-to-top" href="#top"><?php esc_html_e( 'Back to top', 'agenio-personal' ); ?></a>
    </div>
</footer>

<?php do_action( 'agenio_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>
