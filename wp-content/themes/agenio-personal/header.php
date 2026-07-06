<?php
/**
 * Header template.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'agenio-personal' ); ?></a>

<?php do_action( 'agenio_before_header' ); ?>

<header class="site-header" role="banner">
    <div class="agenio-container site-header__inner">
        <a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php $logo = agenio_get_logo_url( 'light' ); ?>
            <?php if ( $logo ) : ?>
                <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( agenio_theme_option( 'brand_name', get_bloginfo( 'name' ) ) ); ?>">
            <?php else : ?>
                <span><?php echo esc_html( agenio_theme_option( 'brand_short_name', get_bloginfo( 'name' ) ) ); ?></span>
            <?php endif; ?>
        </a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu">
            <span><?php esc_html_e( 'Menu', 'agenio-personal' ); ?></span>
        </button>

        <nav class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'agenio-personal' ); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'agenio_fallback_menu',
                )
            );
            ?>
        </nav>

        <div class="site-header__cta">
            <?php agenio_render_button(); ?>
        </div>
    </div>
</header>

<?php do_action( 'agenio_after_header' ); ?>

<main id="main" class="site-main">
<?php
function agenio_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'agenio-personal' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/services/' ) ) . '">' . esc_html__( 'Services', 'agenio-personal' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/case-studies/' ) ) . '">' . esc_html__( 'Case Studies', 'agenio-personal' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/blog/' ) ) . '">' . esc_html__( 'Blog', 'agenio-personal' ) . '</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'agenio-personal' ) . '</a></li>';
    echo '</ul>';
}
