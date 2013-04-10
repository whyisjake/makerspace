<?php
	/**
 	  * @package Mentor.Makerspace.com
 	  * @subpackage Mentor.Makerspace.com
 	 **/
?>
<?php
	
	/********** All all widget registrations here **********/
	/*****
     * Description: Register widgetized areas and update sidebar with default widgets
     * Since: 1.0
     * Author: Cole Geissinger
    /*****/
    function mms_widgets_init() {
        if(function_exists('register_sidebar')) {
            register_sidebar(array(
                'name' => 'Sidebar',
                'id'   => 'sidebar',
                'description'   => 'Place widgets for the sidebar.',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
            ));
        }
    }
    add_action('widgets_init', 'mms_widgets_init');
?>