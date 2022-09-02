<?php 
get_header();

if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header alignwide">
        <div class="container text-center"><h1 class="page-title"><?php single_post_title(); ?></h1></div>
    </header>
<?php endif; ?>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php 
                if ( have_posts() ) {
                    while ( have_posts() ) {
                        the_post();                
                        get_template_part( 'template-parts/content', get_post_format() );
                    }
                
                    the_posts_pagination( array('prev_text' => '<i class="fa fa-angle-double-left"></i>', 'next_text' => '<i class="fa fa-angle-double-right"></i>', 'mid_size' => 2,'screen_reader_text'=>'' ) );
                } else {
                    get_template_part( 'template-parts/content-none' );                
                }
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php 
get_footer(); 