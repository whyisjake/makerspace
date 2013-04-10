<?php
	$content = $shortname . '-content-options';
	
	$mms_options = array(
		//General Settings section
		array(
			'title' => 'Content Options',
			'type' => 'header',
			'page' => $content
		),
		/** Header Section **/
		array(
			'title' => 'Header',
			'id' => 'header',
			'class' => 'site-header',
			'type' => 'open',
			'page' => $content
		),
		array(
			'type' => 'section open',
			'page' => $content
		),
		array(
			'title' => 'Home Page Title',
			'description' => 'Set title you wish to use. Use no more than 197 characters.',
			'id' => $shortname . '-home-page-title',
			'class' => 'text',
			'name' => $shortname . '-home-page-title',
			'type' => 'text',
			'page' => $content
		),
		array(
			'type' => 'section close',
			'page' => $content
		),
		array(
			'type' => 'close',
			'page' => $content
		),
		
		
		/*** SEO Options ***/
		array(
			'title' => 'SEO / Social Media Links',
			'id' => 'seo-smo-options',
			'class' => 'seo-smo-options',
			'type' => 'open',
			'page' => $content
		),
		array(
			'type' => 'section open',
			'page' => $content
		),
		array(
			'title' => 'Google Analytics',
			'description' => 'Enter the Google Analytics account number in here.',
			'id' => $shortname . '-analytics-code',
			'name' => $shortname . '-analytics-code',
			'type' => 'text',
			'page' => $content
		),
		array(
			'type' => 'section close',
			'page' => $content
		),
		array(
			'type' => 'close',
			'page' => $content
		)
	);
?>