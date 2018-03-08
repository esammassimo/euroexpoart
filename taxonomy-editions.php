<?php get_header(); ?>
<div id="content">
<h1><?php single_term_title(); ?></h1>
<?php

$uri = $_SERVER['REQUEST_URI'];
$t = explode("/", $uri);
$tax = $t[2]; 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$orders = array (
	'post_type' => 'artisti',
	'posts_per_page' => 1000,
	'orderby' => 'title',
	'order' => 'ASC',
  'tax_query' => array(
      array(
        'taxonomy'  =>  'editions',
        'field'     =>  'slug',
        'terms'     =>  $tax
      )    
  )
);

//print_r($orders);

$artisti = new WP_Query( $orders );

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
<?php //wp_paginate(); ?>
<?php get_footer(); ?>