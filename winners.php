<?php

/**
 * Template Name: Vincitori
 *
 */

get_header(); ?>
<div id="content">
<h1><?php single_term_title(); ?></h1>
<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$orders = array (
	'post_type' => 'winners',
	'posts_per_page' => 1000,
	'orderby' => 'title',
	'order' => 'ASC',
	'tax_query' => array(
      array(
        'taxonomy'  =>  'editions',
        'field'     =>  'slug',
        'terms'     =>  'edition-2017'
      )    
	)
);

//print_r($orders);

$winners = new WP_Query( $orders );

?>
<ul class="artists">
<?php if ( $winners->have_posts() ) while ( $winners->have_posts() ) : $winners->the_post(); ?>
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
<?php //wp_paginate(); ?>
<?php get_footer(); ?>