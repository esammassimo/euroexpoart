<?php
/**
 * Template name: News
*/

get_header(); ?>
<div id="content">
<?php
$artisti = new WP_Query( array ('post_type' => 'post', 'posts_per_page' => 1000) );

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
                <p><?php the_excerpt(); ?></p>
	</li>
<?php endwhile; // end of the loop. ?>
</ul>
</div>
<?php get_footer(); ?>