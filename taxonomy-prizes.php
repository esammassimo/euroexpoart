<?php get_header(); ?>
<div id="content">
<h1><?php the_title(); ?></h1>
		<?php
		
			$c = $_SERVER['REQUEST_URI'];
			$ca = explode("/",$c);
			$cat = $ca[2];
			$premio = get_term_by('slug',$cat,'prizes');
      		// create a custom wordpress query
      		query_posts("post_type=artisti&taxonomy=prizes&prizes=$premio->name&order=ASC&post_per_page=100");
    	
    	?>
    <ul class="artists">
      <?php
        if (have_posts()) : while (have_posts()) : the_post(); ?>
        <li>
        <?php if ( has_post_thumbnail() ) { ?>
          <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
        <?php } ?>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>                  					
        </li>
        <?php endwhile; endif; // done our wordpress loop. Will start again for each category ?>
    </ul>

</div>
<?php get_footer(); ?>