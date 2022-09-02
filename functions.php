<?php 
 // Define Default Constants
 define( 'ID_THEME_DIR', get_template_directory() );
 define( 'ID_THEME_URI', get_template_directory_uri() );
 define( 'ID_THEME_SUB_DIR', ID_THEME_DIR.'/inc/' );

 // On setting up theme
 if(!function_exists('industry_dive_setup')){
    function industry_dive_setup(){
        /* Make theme available for translation. */
        load_theme_textdomain( 'industry-dive', get_template_directory() . '/languages' );

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
        add_image_size( 'post-secondary', 745, 360, true );
        add_image_size( 'post-tertiary', 745, 760, true );
        add_image_size( 'post-general', 485, 390, true );

        register_nav_menus(
            array(
                'primary' => esc_html__( 'Header Menu', 'industry-dive' ),
                'footer'  => esc_html__( 'Footer Menu', 'industry-dive' ),
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

    add_action( 'after_setup_theme', 'industry_dive_setup' );
 }

 // Set content width
function industry_dive_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'industry_dive_content_width', 1530 );
}
add_action( 'after_setup_theme', 'industry_dive_content_width', 0 );

// Enqueue scripts and styles.
function industry_dive_scripts() {
	wp_enqueue_style( 'id-style', ID_THEME_URI . '/style.css', array(), filemtime(get_theme_file_path('/style.css')) );
    wp_enqueue_script( 'id', ID_THEME_URI . '/assets/js/theme.js', array('jquery'), filemtime(get_theme_file_path('/assets/js/theme.js')), true );
    wp_localize_script( 'id', 'id', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
	) );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'industry_dive_scripts' );

function id_category_colorpicker_enqueue( $taxonomy ) {
    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'id-admin', ID_THEME_URI . '/assets/js/admin.js', array('wp-color-picker'), filemtime(get_theme_file_path('/assets/js/admin.js')), true );
}
add_action( 'admin_enqueue_scripts', 'id_category_colorpicker_enqueue' );


// Loadmore ajax
function id_loadmore_ajax_handler(){
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => $_POST['page'] + 1
    );
 
	$query = new WP_Query( $args );
 
    ob_start();
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
			get_template_part( 'template-parts/content', get_post_format() ); 
		endwhile; 
	endif;
    $postdata = ob_get_clean();
    wp_send_json(array('posts' => $postdata, 'max_page' => $query->max_num_pages));
    wp_reset_postdata();
	die;
}
 
add_action('wp_ajax_loadmore', 'id_loadmore_ajax_handler'); 
add_action('wp_ajax_nopriv_loadmore', 'id_loadmore_ajax_handler');

//add color to category
function id_colorpicker_field_edit_category( $term ) {
    $color = isset($term->term_id) ? get_term_meta( $term->term_id, '_category_color', true ) : 'f7c546';
    $color = ( ! empty( $color ) ) ? "#{$color}" : '#f7c546';
  ?>
    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Color</label></th>
        <td>
            <input name="_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" data-default-color="<?php echo $color; ?>"/>
            <p class="description"><?php _e('Select a color for the category to style posts', 'industry-drive'); ?></p>
        </td>
    </tr>
  <?php
}
add_action( 'category_edit_form_fields', 'id_colorpicker_field_edit_category' );
add_action( 'category_add_form_fields', 'id_colorpicker_field_edit_category' );

function id_save_termmeta( $term_id ) {
    if( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
        update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
    } else {
        delete_term_meta( $term_id, '_category_color' );
    }

}
add_action( 'created_category', 'id_save_termmeta' ); 
add_action( 'edited_category',  'id_save_termmeta' );