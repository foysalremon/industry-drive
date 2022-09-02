<div class="col col-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class('post post-normal'); ?>>
        <div class="featured-image">
            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post-general' ); } ?>
        </div>
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