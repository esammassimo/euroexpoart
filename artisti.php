<?php
/**
 * Template name: Artists
*/

get_header(); ?>
<div id="content">
<?php
$year = date("Y");
$artisti = new WP_Query( array ('post_type' => 'artisti', 'editions' => 'edition-$year', 'posts_per_page' => 1000, 'orderby' => 'title', 'order' => 'ASC') );

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
</div>
<?php wp_paginate(); ?>
<?php get_footer(); ?>