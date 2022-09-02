<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo ID_THEME_URI . '/assets/images/favicon.png'; ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'moose' ); ?></a>

<header class="site-header">
    <div class="top-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-3 sm-d-none">
                    <div class="header-search">
                        <?php  echo get_search_form(); ?>
                    </div>
                </div>
                <div class="col col-6 text-center text-sm-left">
                    <a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php 
                            echo '<h1 class="site-title">' . get_bloginfo( 'name' ) . '</h1>'; 
                            echo '<h5 class="site-tagline">' . get_bloginfo( 'description', 'display' ) . '</h5>'; 
                        ?>
                    </a>
                </div>
                <div class="col col-6 text-right d-none sm-d-block">
                    <button class="btn btn-primary">
                        <span class="dashicons dashicons-menu"></span>
                    </button>
                </div>
                <div class="col col-3 text-right sm-d-none">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.15 23.71"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path class="cls-1" d="M22.65,22.63v-14c0-.15-.18-.33-.35-.47L18.64,5.53V2.6a.49.49,0,0,0-.48-.48H14L11.87.57a.57.57,0,0,0-.54,0L9.21,2.12H5a.48.48,0,0,0-.48.48V5.5L.86,8.19a.63.63,0,0,0-.36.46V22.73a.49.49,0,0,0,.44.48H22.16A.51.51,0,0,0,22.65,22.63ZM21.73,9.51V21.76l-8-6.4Zm-.36-.85-2.73,2v-4ZM11.58,1.49l.85.62H10.72l.86-.62Zm6.09,1.6v8.27L11.58,15.8l-6.1-4.44V3.09ZM1.42,9.51l8,5.85-8,6.44Zm3.14,1.18-2.8-2,2.8-2ZM2.29,22.28l7.9-6.35,1.09.79a.42.42,0,0,0,.59,0L13,15.93l8,6.35Z"/><rect class="cls-1" x="8.34" y="5.45" width="6.53" height="0.92"/><rect class="cls-1" x="8.34" y="8.4" width="6.53" height="0.92"/><rect class="cls-1" x="8.34" y="11.35" width="6.53" height="0.92"/></g></g></svg><span><?php esc_html_e('Subscribe', 'industry-dive'); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <nav class="site-navbar">
        <div class="container text-center">
        <?php 
        wp_nav_menu( array(
            'theme_location'  => 'primary',
            'depth'           => 2,
            'container'         => false,
            'menu_class'      => 'navbar-nav'
        ) );
        ?>
        </div>
    </nav>
</header>
