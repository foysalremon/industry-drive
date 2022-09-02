<?php 
get_header();

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'category_name' => 'featured'
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    if(get_theme_mod('featured_post') === 'slider'){
        echo '<div class="featured-slider">';
        while ( $query->have_posts() ) {
            $query->the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-primary'); ?>>
                <div class="featured-image">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); } ?>
                </div>
                <div class="post-body">
                    <div class="container">
                        <div class="post-categories"><?php the_category( '|'); ?></div>
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-metas">
                            <div class="post-meta post-meta-readingtime"><?php printf('%s %s', esc_html(floor(str_word_count( strip_tags( get_the_content() ) ) / 200)), esc_html__('min read', 'industry-dive')); ?></div>
                            |<a class="post-meta post-meta-readmore" href="<?php the_permalink(); ?>"><?php printf('%s <span class="dashicons dashicons-arrow-right-alt"></span>', esc_html__('Read More', 'industry-dive')); ?></a>
                        </div>
                    </div>
                </div>
            </article>
            <?php 
        }
        echo '</div>'; 
    } else {
        $secondary = '';
        $tertiary = '';
        while ( $query->have_posts() ) {
            $query->the_post();
            if($query->current_post === 0){
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-primary'); ?>>
                    <div class="featured-image">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full' ); } ?>
                    </div>
                    <div class="post-body">
                        <div class="container">
                            <div class="post-categories"><?php the_category( '|'); ?></div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-metas">
                                <div class="post-meta post-meta-readingtime"><?php printf('%s %s', esc_html(floor(str_word_count( strip_tags( get_the_content() ) ) / 200)), esc_html__('min read', 'industry-dive')); ?></div>
                                |<a class="post-meta post-meta-readmore" href="<?php the_permalink(); ?>"><?php printf('%s <span class="dashicons dashicons-arrow-right-alt"></span>', esc_html__('Read More', 'industry-dive')); ?></a>
                            </div>
                        </div>
                    </div>
                </article>
                <?php 
            } else if ($query->current_post !== 0 && $query->current_post < 3){
                ob_start();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-secondary'); ?>>
                    <div class="featured-image">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post-secondary' ); } ?>
                    </div>
                    <?php 
                        $cat_for_color = array_values(array_filter(get_the_category(),function($cat){ return $cat->slug !== 'trending' && $cat->slug !== 'featured';}))[0];
                        $color = isset($cat_for_color) ? get_term_meta( $cat_for_color->term_id, '_category_color', true ) : 'f7c546';
                        $color = '#' . $color;
                    ?>
                    <div class="post-color" style="border-color: <?php echo esc_attr($color); ?>"><div class="full-color" style="background-color: <?php echo esc_attr($color); ?>"></div></div>
                    <div class="post-body">
                        <div class="post-categories"><?php the_category( '|'); ?></div>
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-metas">
                            <div class="post-meta post-meta-readingtime"><?php printf('%s %s', esc_html(floor(str_word_count( strip_tags( get_the_content() ) ) / 200)), esc_html__('min read', 'industry-dive')); ?></div>
                            |<a class="post-meta post-meta-readmore" href="<?php the_permalink(); ?>"><?php printf('%s <span class="dashicons dashicons-arrow-right-alt"></span>', esc_html__('Read More', 'industry-dive')); ?></a>
                        </div>
                    </div>
                </article>
                <?php 
                $secondary .= ob_get_clean();
            } else {
                ob_start();
                ?>
                <div class="col col-6">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-tertiary'); ?>>
                        <div class="featured-image">
                            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post-tertiary' ); } ?>
                        </div>
                        <?php 
                            $cat_for_color = array_values(array_filter(get_the_category(),function($cat){ return $cat->slug !== 'trending' && $cat->slug !== 'featured';}))[0];
                            $color = isset($cat_for_color) ? get_term_meta( $cat_for_color->term_id, '_category_color', true ) : 'f7c546';
                            $color = '#' . $color;
                        ?>
                        <div class="post-color" style="border-color: <?php echo esc_attr($color); ?>"><div class="full-color" style="background-color: <?php echo esc_attr($color); ?>"></div></div>
                        <div class="post-body">
                            <div class="post-categories"><?php the_category( '|'); ?></div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-metas">
                                <div class="post-meta post-meta-readingtime"><?php printf('%s %s', esc_html(floor(str_word_count( strip_tags( get_the_content() ) ) / 200)), esc_html__('min read', 'industry-dive')); ?></div>
                                |<a class="post-meta post-meta-readmore" href="<?php the_permalink(); ?>"><?php printf('%s <span class="dashicons dashicons-arrow-right-alt"></span>', esc_html__('Read More', 'industry-dive')); ?></a>
                            </div>
                        </div>
                    </article>
            </div>
                <?php 
                $tertiary .= ob_get_clean();
            }
        }

        if($secondary != ''){
            ?>
            <div class="section featued-others-section">
                <div class="container">
                    <div class="row">
                        <div class="col col-6">
                            <?php echo $secondary; ?>
                        </div>
                        <?php echo $tertiary; ?>
                    </div>
                </div>
            </div>
            <?php 
        }
    }
}
wp_reset_postdata();

unset($args);
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category_name' => 'trending'
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
    $secondary = '';
    $tertiary = '';
    while ( $query->have_posts() ) {
        $query->the_post();
        if ($query->current_post === 0){
            ob_start();
            ?>
            <div class="col col-6">
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-tertiary'); ?>>
                    <div class="featured-image">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post-tertiary' ); } ?>
                    </div>
                    <?php 
                        $cat_for_color = array_values(array_filter(get_the_category(),function($cat){ return $cat->slug !== 'trending' && $cat->slug !== 'featured';}))[0];
                        $color = isset($cat_for_color) ? get_term_meta( $cat_for_color->term_id, '_category_color', true ) : 'f7c546';
                        $color = '#' . $color;
                    ?>
                    <div class="post-color" style="border-color: <?php echo esc_attr($color); ?>"><div class="full-color" style="background-color: <?php echo esc_attr($color); ?>"></div></div>
                    <div class="post-body">
                        <div class="post-categories"><?php the_category( '|'); ?></div>
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-metas">
                            <div class="post-meta post-meta-readingtime"><?php printf('%s %s', esc_html(floor(str_word_count( strip_tags( get_the_content() ) ) / 200)), esc_html__('min read', 'industry-dive')); ?></div>
                            |<a class="post-meta post-meta-readmore" href="<?php the_permalink(); ?>"><?php printf('%s <span class="dashicons dashicons-arrow-right-alt"></span>', esc_html__('Read More', 'industry-dive')); ?></a>
                        </div>
                    </div>
                </article>
            </div>
            <?php 
            $tertiary .= ob_get_clean();
        } else {
            ob_start();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-secondary'); ?>>
                <div class="featured-image">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post-secondary' ); } ?>
                </div>
                <?php 
                    $cat_for_color = array_values(array_filter(get_the_category(),function($cat){ return $cat->slug !== 'trending' && $cat->slug !== 'featured';}))[0];
                    $color = isset($cat_for_color) ? get_term_meta( $cat_for_color->term_id, '_category_color', true ) : 'f7c546';
                    $color = '#' . $color;
                ?>
                <div class="post-color" style="border-color: <?php echo esc_attr($color); ?>"><div class="full-color" style="background-color: <?php echo esc_attr($color); ?>"></div></div>
                <div class="post-body">
                    <div class="post-categories"><?php the_category( '|'); ?></div>
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="post-metas">
                        <div class="post-meta post-meta-readingtime"><?php printf('%s %s', esc_html(floor(str_word_count( strip_tags( get_the_content() ) ) / 200)), esc_html__('min read', 'industry-dive')); ?></div>
                        |<a class="post-meta post-meta-readmore" href="<?php the_permalink(); ?>"><?php printf('%s <span class="dashicons dashicons-arrow-right-alt"></span>', esc_html__('Read More', 'industry-dive')); ?></a>
                    </div>
                </div>
            </article>
            <?php 
            $secondary .= ob_get_clean();
        }
    }

    if($secondary != ''){
        ?>
        <div class="section trending-section">
            <div class="container">
                <h2 class="section-title"><?php _e('Trending Now', 'industry-dive'); ?></h2>
                <div class="row">
                    <?php echo $tertiary; ?>
                    <div class="col col-6">
                        <?php echo $secondary; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
    }
}
wp_reset_postdata();

?>
<div class="section latest-article-section">
    <div class="container">
        <h2 class="section-title"><?php _e('Latest Article', 'industry-dive'); ?></h2>
        <?php 
            unset($args);
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
            );
            
            $query = new WP_Query( $args );

            if ( $query->have_posts() ) {
                echo '<div class="row" id="latest-post">';
                while ( $query->have_posts() ) {
                    $query->the_post();                
                    get_template_part( 'template-parts/content', get_post_format() );
                }
                echo '</div>';
            } else {
                get_template_part( 'template-parts/content-none' );                
            }
    
            if (  $query->max_num_pages > 1 ){
                printf('<div class="text-center"><a class="btn btn-primary btn-lg id-loadmore">%s</a></div>', esc_html__('Load More', 'industry-dive'));
            }

            wp_reset_postdata();
        ?>
    </div>
</div>
<?php 
get_footer(); 