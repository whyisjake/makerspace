<?php
	/**
	 * Mentor.Makerspace.com functions and definitions
	 *
	 * @package Mentor.Makerspace.com
	 * @since Mentor.Makerspace.com 1.0
	 */
	

	/*****
	 * Description: Set the content width based on the theme's design and stylesheet
	 * Since: Mentor.Makerspace.com 1.0
	 * Author: Cole Geissinger
	/*****/
	if(!isset($content_width)) $content_width = 691; /* pixels */


	/*****
	 * Description: Sets up theme defaults and registers support for various WordPress features. Note that this function is hooked into the after_setup_theme hook, which runs before the init hook. The init hook is too late for some features, such as indicating support post thumbnails.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	if(!function_exists( 'mms_setup')) :
		function mms_setup() {
			global $functions_path;

			//custom theme functions
			require_once($functions_path . 'theme-functions.php');
			
			//widgets and 
			require_once($functions_path . 'widgets.php');
	
			//custom template tags for this theme.
			require_once($functions_path . 'passive-functions.php');

			//custom Theme Options
			//require($functions_path . '/theme-options/theme-options.php' );

			/**
			 * Make theme available for translation
			 * Translations can be filed in the /languages/ directory
			 * If you're building a theme based on Mentor.Makerspace.com, use a find and replace
			 * to change 'mentor_makerspace' to the name of your theme in all the template files
			 */
			load_theme_textdomain('mentor_makerspace', get_template_directory() . '/languages');

			//add default posts and comments RSS feed links to head
			add_theme_support('automatic-feed-links');

			//enable support for Post Thumbnails
			add_theme_support('post-thumbnails');

			//register wp_nav_menu()
			register_nav_menus(array(
				'primary' => __('Primary Menu', 'mentor_makerspace'),
				'footer' => __('Footer Menu', 'mentor_makerspace')
			));

			//add support for the Aside Post Formats
			add_theme_support('post-formats', array('aside'));

			//add RSS links to <head>
			add_theme_support('automatic-feed-links');

			//clean up the <head> and remove unneeded WordPress' defaults
			remove_action('wp_head', 'rsd_link');
 			remove_action('wp_head', 'wlwmanifest_link');
 			remove_action('wp_head', 'wp_generator');

 			//allow shortcodes to be ran in the text widgets
 			add_filter('widget_text', 'do_shortcode');
		}
	endif; //mms_setup function check
	add_action('after_setup_theme', 'mms_setup');
	
?>