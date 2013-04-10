<?php
	/**
 	  * @package WordPress
 	  * @subpackage Mentor.Makerspace.com
 	 **/
?>
<?php
	
	/********** Add our custom scripts and styles to ONLY the theme's admin pages **********/
	
	//get the page urls and turn them into an array
	global $shortname;
	$page_urls = array(
		$shortname . '-theme-options', 
		$shortname . '-content-options', 
		$shortname . '-color-options', 
		$shortname . '-slideshow', 
		$shortname . '-home-page-options'
	);
	
	/*****
	 * Description: Add our admin styles
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_admin_print_styles() {
		global $page_urls;
		
		foreach($page_urls as $page_url) :
			if(is_admin() && isset($_GET['page']) && ($_GET['page'] == $page_url)) :
				wp_enqueue_style('thickbox');
				wp_enqueue_style('fw-admin', get_stylesheet_directory_uri() . '/functions/admin/admin-styles.css', null, '0.1', 'screen');
			endif;
		endforeach;
	}
	add_action('admin_init', 'mms_admin_print_styles');
	
	
	/*****
	 * Description: Add metabox styles to only pages and posts
	 * Since: 0.3
	 * Author: Cole Geissinger
	/*****/
	function mms_admin_metabox_styles() {
		if(is_admin()) {
			wp_enqueue_style('fw-metabox-admin', get_stylesheet_directory_uri() . '/functions/admin/admin-metabox-styles.css', null, '0.1', 'screen');
		}
	}
	add_action('admin_print_styles-post.php', 'mms_admin_metabox_styles');
	add_action('admin_print_styles-post-new.php', 'mms_admin_metabox_styles');
	
	
	/*****
	 * Description: Add our custom scripts for the admin area
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_admin_print_scripts() {
		global $page_urls;
		
		foreach($page_urls as $page_url) :
			if(is_admin() && isset($_GET['page']) && ($_GET['page'] == $page_url)) :
				wp_enqueue_script('thickbox');
				wp_enqueue_script('fw-colorpicker', get_stylesheet_directory_uri() . '/functions/admin/js/colorpicker.js', array('jquery'), '0.1', true);
				//wp_enqueue_script('fw-tooltips', get_stylesheet_directory_uri() . '/js/libs/jquery.justthetip.min.js', array('jquery'), '0.1', true);
				wp_enqueue_script('fw-admin-functions', get_stylesheet_directory_uri() . '/functions/admin/js/admin-functions.js', array('jquery'), '0.1', true);
			endif;
		endforeach;
	}
	add_action('wp_print_scripts', 'mms_admin_print_scripts');
	
	
	function themes_url() {
		echo '<script type="text/javascript">var theme_url = \'' . get_stylesheet_directory_uri() . '\';</script>' . "\n"; 
	}
	add_action('admin_head', 'themes_url');
?>