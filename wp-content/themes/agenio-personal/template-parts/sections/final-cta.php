<section class="final-cta">
    <div class="agenio-container final-cta__inner">
        <p class="eyebrow"><?php esc_html_e( 'Start your project', 'agenio-personal' ); ?></p>
        <h2><?php echo esc_html( agenio_theme_option( 'final_cta_title', 'Ready to build a faster, SEO-focused website?' ) ); ?></h2>
        <p><?php echo esc_html( agenio_theme_option( 'final_cta_text', 'Send your website URL or project idea and I will help you identify the best next step.' ) ); ?></p>
        <?php agenio_render_button(); ?>
    </div>
</section>
