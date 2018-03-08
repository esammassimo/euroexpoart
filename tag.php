<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */

get_header(); ?>
<div id="content">
		<h1><?php	printf( __( '%s', 'starkers' ), '' . single_tag_title( '', false ) . '' ); ?></h1>
    <ul class="artists">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
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