<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */

get_header(); ?>
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
    <?php 
			$socialink = get_permalink($post->ID);
			$imgu = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			$imgurl = urlencode($imgu[0]);
		?>
		<ul class="social-links">
			<li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($socialink); ?>" class="share facebook">Facebook</a></li>
			<li><a href="https://twitter.com/share?url=<?php echo urlencode($socialink); ?>" class="share twitter">Twitter</a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo urlencode($socialink); ?>" class="share google-plus">Google Plus</a></li>
			<li><a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode($socialink); ?>&media=<?php echo $imgurl; ?>" class="share pinterest">Pinterest</a></li>
		</ul>
		<?php
			/*if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail($post_id, 'medium');
			} else {
		 		// niente
			}*/
		?>
		<p><?php the_content(); ?></p>
<?php endwhile; // end of the loop. ?>
</ul>
</div>
<?php get_footer(); ?>