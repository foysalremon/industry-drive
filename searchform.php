<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <span class="dashicons dashicons-search"></span>
	<input type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e('Search', 'industry-dive'); ?>" />
</form>
