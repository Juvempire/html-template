<section class="hero-section" id="top">
    <div class="agenio-container hero-grid">
        <div class="hero-content">
            <p class="eyebrow"><?php echo esc_html( agenio_theme_option( 'hero_eyebrow', 'WordPress Web Design • SEO • Digital Marketing' ) ); ?></p>
            <h1><?php echo esc_html( agenio_theme_option( 'hero_title', 'Fast, SEO-focused websites that turn visitors into leads.' ) ); ?></h1>
            <p class="hero-copy"><?php echo esc_html( agenio_theme_option( 'hero_subtitle', 'I help growth-focused businesses build clean, search-friendly and conversion-focused WordPress websites for international markets.' ) ); ?></p>
            <div class="button-row">
                <?php agenio_render_button( agenio_theme_option( 'hero_primary_cta_text', 'Request a Free Website Audit' ), agenio_theme_option( 'hero_primary_cta_url', home_url( '/contact/' ) ) ); ?>
                <a class="agenio-btn ghost" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'View Services', 'agenio-personal' ); ?></a>
            </div>
        </div>
        <div class="hero-panel" aria-label="<?php esc_attr_e( 'Performance and SEO highlights', 'agenio-personal' ); ?>">
            <div class="hero-stat"><strong>SEO-first</strong><span>Technical structure, schema-ready pages and clean internal linking.</span></div>
            <div class="hero-stat"><strong>Performance</strong><span>No page builder, conditional assets and animation controls.</span></div>
            <div class="hero-stat"><strong>Lead-focused</strong><span>Service pages, audit requests and conversion-focused CTAs.</span></div>
        </div>
    </div>
</section>
