<?php
	/**
 	  * @package WordPress
 	  * @subpackage Mentor.Makerspace.com
 	 **/
?>
<?php
	
	/********** Include all functions that deal with the head and footer of the theme **********/
	
	
	/*****
	 * Description: Add our stylesheets to the wp_head() function
	 * Since: 0.1
	 * Author: Cole Geissinger */
	function mms_print_styles() {
		if(!is_admin()) {
			wp_enqueue_style('mms-google-font', ("http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700"));
			wp_enqueue_style('mms-styles', get_stylesheet_directory_uri() . '/css/application.css', null, '1.0', 'screen');
		}
	}
	add_action('wp_print_styles', 'mms_print_styles');
	
	
	/*****
	 * Description: Add our javascript to the wp_head() function
	 * Since: 0.1
	 * Author: Cole Geissinger */
	function mms_print_scripts() {
		if(!is_admin()) {
	   	wp_deregister_script('jquery');
	   	wp_register_script('jquery', ('http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js'), false);
	   	wp_enqueue_script('jquery');
	   	wp_enqueue_script('mms-modernizer', get_stylesheet_directory_uri() . '/js/libs/modernizr-2.5.3.custom.min.js', null, '2.0.6', false);
	   	wp_enqueue_script('mms-superfish', get_stylesheet_directory_uri() . '/js/libs/jquery.superfish.1.4.8.min.js', array('jquery'), '1.4.8', true);
	   	wp_enqueue_script('mms-supersubs', get_stylesheet_directory_uri() . '/js/libs/jquery.supersubs.0.2b.min.js', array('jquery', 'mms-superfish'), '0.2b', true);
	   	if(is_front_page()) {
	   		wp_enqueue_script('mms-full-width-slider', get_stylesheet_directory_uri() . '/js/libs/jquery.flexslider-min.js', array('jquery'), '2.1', false); 
	   	}
			wp_enqueue_script('mms-theme-functions', get_stylesheet_directory_uri() . '/js/main.js', null, '0.1', true);
	   	if(is_singular()) {
	   		wp_enqueue_script('comment-reply');
	   	}
		}
	}
	add_action('wp_print_scripts', 'mms_print_scripts');
	
?>