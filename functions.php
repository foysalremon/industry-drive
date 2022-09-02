<?php 
 // Define Default Constants
 define( 'ID_THEME_DIR', get_template_directory() );
 define( 'ID_THEME_URI', get_template_directory_uri() );
 define( 'ID_THEME_SUB_DIR', ID_THEME_DIR.'/inc/' );

 // On setting up theme
 if(!function_exists('industry_drive_setup')){
    function industry_drive_setup(){
        /* Make theme available for translation. */
        load_theme_textdomain( 'industry-drive', get_template_directory() . '/languages' );

        /* Add default posts and comments RSS feed links to head. */
        add_theme_support( 'automatic-feed-links' );

        /* Let WordPress manage the document title. */
        add_theme_support( 'title-tag' );

        /* Add post-formats support. */
        add_theme_support(
            'post-formats',
            array(
                'link',
                'aside',
                'gallery',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat',
            )
        );

        /* Enable support for Post Thumbnails on posts and pages. */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1530, 9999 );

        register_nav_menus(
            array(
                'primary' => esc_html__( 'Header Menu', 'industry-drive' ),
                'footer'  => esc_html__( 'Footer Menu', 'industry-drive' ),
            )
        );

        /* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );
    }

    add_action( 'after_setup_theme', 'industry_drive_setup' );
 }

 // Set content width
function industry_drive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'industry_drive_content_width', 1530 );
}
add_action( 'after_setup_theme', 'industry_drive_content_width', 0 );

// Enqueue scripts and styles.
function industry_drive_scripts() {
	wp_enqueue_style( 'moose-style', ID_THEME_URI . '/style.css', array(), filemtime(get_theme_file_path('/style.css')) );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'industry_drive_scripts' );