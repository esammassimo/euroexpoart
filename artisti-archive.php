<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */

get_header(); ?>
<div id="content">
<?php

$artisti = new WP_Query( array ('post_type' => 'artisti', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => 10) );

?>
<ul class="artists">
<?php if ( $artisti->have_posts() ) while ( $artisti->have_posts() ) : $artisti->the_post(); ?>

			<li>
		<?php
			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail($post_id, 'medium');
			} else {
		 		// niente
			}
		?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</li>
<?php endwhile; // end of the loop. ?>
</ul>
<?php if(function_exists('wp_paginate')) {
    wp_paginate();
} ?>
</div>
<?php get_footer(); ?>