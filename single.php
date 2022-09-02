<?php 
get_header();

while ( have_posts() ) {
    the_post();              
    ?>
    <article <?php post_class('post-featured-primary'); ?>>
        <div class="featured-image">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); } ?>
        </div>
        <div class="post-body">
            <div class="container">
                <div class="post-categories"><?php the_category( '|'); ?></div>
                <h3 class="post-title"><?php the_title(); ?></h3>
            </div>
        </div>
    </article>
    <div class="section post-entry-section">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>
    <?php 

    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
}

get_footer(); 