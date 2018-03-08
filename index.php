<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */
 
get_header(); ?>

<div id="slide">
	<?php if ( function_exists( 'show_simpleresponsiveslider' ) ) show_simpleresponsiveslider(); ?>
</div>
 
<?php get_footer(); ?>