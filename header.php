<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage EuroExpoArt
 * @since EuroExpoArt 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/jquery.fancybox.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.fancybox.js"></script>

<script src="<?php bloginfo('template_directory'); ?>/js/modernizr-1.6.min.js"></script>
<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
 
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>
</head>
 
<body <?php body_class(); ?>>
 <secton id="global-link">
 	<ul>
	 	<li><a rel="nofollow" target="_blank" href="http://www.neoartgallery.it"><img src="<?php bloginfo("stylesheet_directory"); ?>/images/logos/nag-logo.jpeg" /></a></li>
	 	<li><a rel="nofollow" target="_blank" href="http://euroexpoart.com"><img class="current" src="<?php bloginfo("stylesheet_directory"); ?>/images/logos/eea-logo.png" /></a></li>
	 	<li><a rel="nofollow" target="_blank" href="http://www.giorgiobertozzi.it"><img src="<?php bloginfo("stylesheet_directory"); ?>/images/logos/giorgio-logo.jpg" /></a></li>
	 	<li><a rel="nofollow" target="_blank" href="http://www.ferdanyusufi.net/"><img src="<?php bloginfo("stylesheet_directory"); ?>/images/logos/ferdan-logo.jpg" /></a></li>
 	</ul>
 </secton>
 <div class="clear"></div>
    <header>
        <div class="container bghead">
        	<div id="head">
        	<a href="<?php bloginfo('url'); ?>"><img id="logo" src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" /></a>
    			<?php get_search_form(); ?>
    		<nav class="bgmenu">
    			<ul>
    				<?php wp_nav_menu( array('menu' => 'main') ); ?>
    			</ul>
    		</nav>
        	<?php if ( is_page('12') || is_tax('editions') ) { ?>
        	<ul class="submenu">
        		<?php wp_nav_menu( array('menu' => 'years') ); ?>
        	</ul>
        		<?php } else { ?>
        		<?php } ?>
    		<div class="clear"></div>
    		</div>
    	</div>    	
    </header>