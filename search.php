<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div id="content">
<?php if ( have_posts() ) : ?>
		<h1><?php printf( __( 'Search Results for: %s', 'starkers' ), '' . get_search_query() . '' ); ?></h1>
			<ul class="artists">
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
      </ul>
<?php else : ?>
		<h2><?php _e( 'Nothing Found', 'starkers' ); ?></h2>
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'starkers' ); ?></p>
			<?php get_search_form(); ?>
<?php endif; ?>

</div>
<?php get_footer(); ?>