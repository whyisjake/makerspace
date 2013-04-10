<?php
	/**
	 * The Header for our theme.
	 *
	 * Displays all of the <head> section and everything up till <div class="main wrapper group">
	 *
	 * @package Mentor.Makerspace.com
	 * @since Mentor.Makerspace.com 1.0
	 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>
			<?php
				//Print the <title> tag based on what is being viewed
				global $page, $paged;

				//print the page name
				wp_title('|', true, 'right');

				//Add the blog name
				bloginfo('name');

				//add the blog description for the home
				$site_description = get_bloginfo('description', 'display');
				if($site_description && (is_home() || is_front_page())) {
					echo " | $site_description";
				}

				//add a page number if needed
				if($paged >= 2 || $page >= 2) {
					echo ' | ' . sprintf(__('Page %s', 'mentor_makerspace'), max($paged, $page));
				}
			?>
		</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<?php wp_head(); //can't load javascript conditionally through enqueue_script, load them below. ?>
		
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/libs/html5-3.6-respond-1.1.0.min.js"></script>
		<![endif]-->
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
		<![endif]-->
	</head>

	<body id="<?php mms_get_page_id(); ?>" <?php body_class(); ?>>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/" target="_blank">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">install Google Chrome Frame</a> to better experience this site.</p>
		<![endif]-->
		<header id="site-header" class="wrapper group">
			<div id="logo">
				<h2><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/makerspace.png" title="<?php bp_site_name(); ?>" /></a></h2>
			</div><!--[END #logo.image-logo]-->
			<aside id="search">
				<?php get_search_form(); ?>
			</aside><!--[END #search]-->
			<nav role="navigation" class="site-navigation main-navigation">
				<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'menu group')); ?>
			</nav>
			<?php makerspace_loggin_user_data(); ?>
		</header>
		