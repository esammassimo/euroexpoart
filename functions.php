<?php
/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'starkers' ),
	) );
}
endif;

if ( ! function_exists( 'starkers_menu' ) ):
/**
 * Set our wp_nav_menu() fallback, starkers_menu().
 *
 * @since Starkers HTML5 3.0
 */
function starkers_menu() {
	echo '<nav><ul><li><a href="'.get_bloginfo('url').'">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * @since Starkers HTML5 3.0
 * @deprecated in Starkers HTML5 3.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s says:', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>
			<br />
		<?php endif; ?>

		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'starkers' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' );
			?>

		<?php comment_text(); ?>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'starkers' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '</article>';
}

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'starkers' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'starkers' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'starkers' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'starkers' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'starkers' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'starkers' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'starkers_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated Starkers HTML5 3.2
 */
function starkers_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	printf( __( 'Posted on %2$s by %3$s', 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

// post type personalizzato - Artisti
add_action('init', 'artisti_register');   

function artisti_register() {   
	$labels = array( 
		'name' => _x('Artisti', 'post type general name'), 
		'singular_name' => _x('Artista', 'post type singular name'), 
		'add_new' => _x('Aggiungi Nuovo Artista', 'portfolio item'), 
		'add_new_item' => __('Aggiungi Nuovo Artista'), 
		'edit_item' => __('Modifica Artista'), 
		'new_item' => __('Nuovo Artista'), 
		'view_item' => __('Vedi Artista'), 
		'search_items' => __('Cerca Artista'), 
		'not_found' => __('Nessun Artista Trovato'), 
		'not_found_in_trash' => __('Non abbiamo trovato nulla nel cestino'), 
		'parent_item_colon' => '' );
		
		$args = array( 
			'labels' => $labels, 
			'taxonomies' => (array('category','editions','prizes')),
			'public' => true, 
			'publicly_queryable' => true, 
			'show_ui' => true, 
			'query_var' => true, 
			'menu_icon' => false, 
			'rewrite' => array('slug' => 'artisti'), 
			'capability_type' => 'post',
			'hierarchical' => false, 
			'menu_position' => null, 
			'supports' => array('title','editor', 'thumbnail', 'author', 'comments') );   
			                                                               

register_post_type( 'artisti' , $args ); 

}

// post type personalizzato - Vincitori
add_action('init', 'winners_register');   

function winners_register() {   
	$labels = array( 
		'name' => _x('Vincitori', 'post type general name'), 
		'singular_name' => _x('Vincitore', 'post type singular name'), 
		'add_new' => _x('Aggiungi Nuovo Vincitore', 'portfolio item'), 
		'add_new_item' => __('Aggiungi Nuovo Vincitore'), 
		'edit_item' => __('Modifica Vincitore'), 
		'new_item' => __('Nuovo Vincitore'), 
		'view_item' => __('Vedi Vincitore'), 
		'search_items' => __('Cerca Vincitore'), 
		'not_found' => __('Nessun Vincitore Trovato'), 
		'not_found_in_trash' => __('Non abbiamo trovato nulla nel cestino'), 
		'parent_item_colon' => '' );
		
		$args = array( 
			'labels' => $labels, 
			'taxonomies' => (array('category','editions','prizes')),
			'public' => true, 
			'publicly_queryable' => true, 
			'show_ui' => true, 
			'query_var' => true, 
			'menu_icon' => false, 
			'rewrite' => array('slug' => 'winners'), 
			'capability_type' => 'post',
			'hierarchical' => false, 
			'menu_position' => null, 
			'supports' => array('title','editor', 'thumbnail', 'author', 'comments') );   
			                                                               

register_post_type( 'winners' , $args ); 

}

// custom taxonomy per le edizioni
// custom taxonomy
function edition_taxonomies() {

register_taxonomy('editions', 'edizioni', array( 
'hierarchical' => true, // This array of options controls the labels displayed in the WordPress Admin UI 
'labels' => array( 
        'name' => _x( 'Edizioni', 'taxonomy general name' ), 
        'singular_name' => _x( 'Edizioni', 'taxonomy singular name' ), 
        'search_items' => __( 'Cerca Edizione' ), 
        'all_items' => __( 'Tutte le Edizioni' ), 
        'parent_item' => __( 'Edizioni Collegate' ), 
        'parent_item_colon' => __( 'Edizione collegata:' ), 
        'edit_item' => __( 'Modifica Edizione' ), 
        'update_item' => __( 'Aggiorna Edizione' ), 
        'add_new_item' => __( 'Aggiungi Nuova Edizione' ), 
        'new_item_name' => __( 'Nuova Edizione' ), 
        'menu_name' => __( 'Edizioni' ), 
        ), // Control the slugs used for this taxonomy 
        'rewrite' => array( 
                'slug' => 'editions', // This controls the base slug that will display before each term 
                'with_front' => false, // Don't display the category base before "/locations/" 
                'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/" ), 
        ),
)); 
} 

add_action( 'init', 'edition_taxonomies', 0 );

// custom taxonomy per le categorie dei vincitori
// custom taxonomy
function prizes_taxonomies() {

register_taxonomy('prizes', 'premi', array( 
'hierarchical' => true, // This array of options controls the labels displayed in the WordPress Admin UI 
'labels' => array( 
        'name' => _x( 'Premi', 'taxonomy general name' ), 
        'singular_name' => _x( 'Premio', 'taxonomy singular name' ), 
        'search_items' => __( 'Cerca Premio' ), 
        'all_items' => __( 'Tutti i Premi' ), 
        'parent_item' => __( 'Premi Collegati' ), 
        'parent_item_colon' => __( 'Premio collegato:' ), 
        'edit_item' => __( 'Modifica Premio' ), 
        'update_item' => __( 'Aggiorna Premio' ), 
        'add_new_item' => __( 'Aggiungi Nuovo Premio' ), 
        'new_item_name' => __( 'Nuovo Premio' ), 
        'menu_name' => __( 'Premi' ), 
        ), // Control the slugs used for this taxonomy 
        'rewrite' => array( 
                'slug' => 'prizes', // This controls the base slug that will display before each term 
                'with_front' => false, // Don't display the category base before "/locations/" 
                'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/" ), 
        ),
)); 
} 

add_action( 'init', 'prizes_taxonomies', 0 );