<?php
	/**
	 * Mentor.Makerspace.com functions and definitions
	 *
	 * @package Mentor.Makerspace.com
	 * @since Mentor.Makerspace.com 1.0
	 */

	/********** Include all relevant functions into our theme **********/
	$functions_path = get_stylesheet_directory() . '/functions/';
	$admin_path = get_stylesheet_directory() . '/functions/admin/';
	
	
	/*** Front-end Theme Stuff ***/
	//theme registrations and initializations
	require_once($functions_path . 'theme-init.php');
	
	//header and footer functions of the theme - Adding Style sheets and Scripts
	require_once($functions_path . 'theme-header.php');
	
	
	/*** Back-end Admin Stuff ***/
	//admin theme registrations and initializations
	require_once($admin_path . 'admin-init.php');
	
	//header and footer function for the admin pages - Adding Stylesheets and Scripts
	require_once($admin_path . 'admin-header.php');
	
	//add our meta boxes
	//require_once($admin_path . 'admin-metaboxes.php');





	


	//implement the Custom Header feature
	//require( get_template_directory() . '/inc/custom-header.php' );
