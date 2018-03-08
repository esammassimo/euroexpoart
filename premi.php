<?php 

/*
** Template name: Premi
*/

get_header(); ?>
<div id="content">
<h1><?php the_title(); ?></h1>
		<?php
            // get all the categories from the database
            $cats = get_terms('prizes', array(
            	'orderby' => slug,
            )
            ); 
            
 
                // loop through the categries
                foreach ($cats as $cat) {
                    // setup the cateogory ID
                    $cat_id = $cat->term_id;

                    // Make a header for the cateogry
                    echo "<h2 class=\"cats\">".$cat->name."</h2>";
                    echo "<p>$cat->description</p>";
                    ?>
                    
                    <?php
                    // create a custom wordpress query
                    query_posts("post_type=artisti&taxonomy=prizes&prizes=$cat->slug&order=ASC&post_per_page=100");
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
                <?php } // done the foreach statement ?>
</div>
<?php get_footer(); ?>