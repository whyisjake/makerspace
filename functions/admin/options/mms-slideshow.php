<?php
	$slider = $shortname . '-slideshow';
	
	$mms_options = array(
		/*** Slider Settings ***/
		array(
			'title' => 'Slideshow',
			'type' => 'header',
			'page' => $slider
		),
		/** Image Upload Section **/
		array(
			'title' => 'Add Slides',
			'id' => 'add-slides',
			'class' => 'add-slides',
			'type' => 'open',
			'page' => $slider
		),
		array(
			'type' => 'section open',
			'page' => $slider
		),
		array(
			'title' => 'Add Slide 1',
			'description' => 'Upload an image. <strong>960x291 ONLY</strong> other wise image will not fit.',
			'id' => $shortname . '-slider-image-1',
			'class' => 'text-button',
			'name' => $shortname . '-slider-image-1',
			'type' => 'text-button',
			'page' => $slider
		),
		array(
			'title' => 'Add Slide 2',
			'description' => 'Upload an image. <strong>960x291 ONLY</strong> other wise image will not fit.',
			'id' => $shortname . '-slider-image-2',
			'class' => 'text-button',
			'name' => $shortname . '-slider-image-2',
			'type' => 'text-button',
			'page' => $slider
		),
		array(
			'title' => 'Add Slide 3',
			'description' => 'Upload an image. <strong>960x291 ONLY</strong> other wise image will not fit.',
			'id' => $shortname . '-slider-image-3',
			'class' => 'text-button',
			'name' => $shortname . '-slider-image-3',
			'type' => 'text-button',
			'page' => $slider
		),
		array(
			'title' => 'Add Slide 4',
			'description' => 'Upload an image. <strong>960x291 ONLY</strong> other wise image will not fit.',
			'id' => $shortname . '-slider-image-4',
			'class' => 'text-button',
			'name' => $shortname . '-slider-image-4',
			'type' => 'text-button',
			'page' => $slider
		),
		array(
			'title' => 'Add Slide 5',
			'description' => 'Upload an image. <strong>960x291 ONLY</strong> other wise image will not fit.',
			'id' => $shortname . '-slider-image-5',
			'class' => 'text-button',
			'name' => $shortname . '-slider-image-5',
			'type' => 'text-button',
			'page' => $slider
		),
		array(
			'title' => 'Add Slide 6',
			'description' => 'Upload an image. <strong>960x291 ONLY</strong> other wise image will not fit.',
			'id' => $shortname . '-slider-image-6',
			'class' => 'text-button',
			'name' => $shortname . '-slider-image-6',
			'type' => 'text-button',
			'page' => $slider
		),
		array(
			'type' => 'section close',
			'page' => $slider
		),
		array(
			'type' => 'close',
			'page' => $slider
		),
		/** Slider Settings Section **/
		array(
			'title' => 'Advanced Settings',
			'id' => 'advanced-settings',
			'class' => 'advanced-settings',
			'type' => 'open',
			'page' => $slider
		),
		array(
			'type' => 'section open',
			'page' => $slider
		),
		array(
			'title' => 'Slide Effects',
			'description' => 'Select which slide effects you would like. <strong>Default is Fade</strong>.',
			'id' => $shortname . '-full-slider-animation',
			'class' => $shortname . '-full-slider-animation',
			'name' => $shortname . '-full-slider-animation',
			'type' => 'select',
			'options' => array('fade', 'slide'),
			'page' => $slider
		),
		array(
			'title' => 'Slide Direction',
			'description' => 'Select the direction of the slide. <strong>Default is Horizontal</strong> - <strong>Only used if Slide is selected</strong>.',
			'id' => $shortname . '-full-slider-direction',
			'class' => $shortname . '-full-slider-direction',
			'name' => $shortname . '-full-slider-direction',
			'type' => 'select',
			'options' => array('horizontal', 'vertical'),
			'page' => $slider
		),
		array(
			'title' => 'Auto Slide',
			'description' => 'Enable or disable auto sliding. <strong>Default is True</strong> - <strong>Used only if a Slide is selected</strong>.',
			'id' => $shortname . '-full-slider-box-columns',
			'class' => $shortname . '-full-slider-box-columns',
			'name' => $shortname . '-full-slider-box-columns',
			'type' => 'select',
			'options' => array('false', 'true'),
			'page' => $slider
		),
		array(
			'title' => 'Pause Time',
			'description' => 'Set the duration each slide is shown, set in milliseconds. <strong>Default is 7000</strong> - <strong>Use only numbers</strong>.',
			'id' => $shortname . '-full-slider-pause-time',
			'class' => $shortname . '-full-slider-pause-time',
			'name' => $shortname . '-full-slider-pause-time',
			'type' => 'text',
			'page' => $slider
		),
		array(
			'title' => 'Animation Speed',
			'description' => 'Set the speed of the slide transition <u>in milliseconds</u>. <strong>Default is 600</strong> - <strong>Use only numbers</strong>.',
			'id' => $shortname . '-full-slider-animation-speed',
			'class' => $shortname . '-full-slider-animation-speed',
			'name' => $shortname . '-full-slider-animation-speed',
			'type' => 'text',
			'page' => $slider
		),
		array(
			'title' => 'Enable Navigation',
			'description' => 'Enable the navigation arrows. <strong>Default is True</strong>.',
			'id' => $shortname . '-full-slider-navigation',
			'class' => $shortname . '-full-slider-navigation',
			'name' => $shortname . '-full-slider-navigation',
			'type' => 'select',
			'options' => array('false', 'true'),
			'page' => $slider
		),
		array(
			'title' => 'Enable Keyboard Navigation',
			'description' => 'Enable the keyboard arrow keys to change slide. <strong>Default is true</strong>.',
			'id' => $shortname . '-full-slider-keyboard-nav',
			'class' => $shortname . '-full-slider-keyboard-nav',
			'name' => $shortname . '-full-slider-keyboard-nav',
			'type' => 'select',
			'options' => array('true', 'false'),
			'page' => $slider
		),
		array(
			'title' => 'Enable Mouse Wheel Navigation',
			'description' =>  'Enable the mouse wheel to change slide. <strong>Default is false</strong>.',
			'id' => $shortname . '-full-slider-mouse-nav',
			'class' => $shortname . '-full-slider-mouse-nav',
			'name' => $shortname . '-full-slider-mouse-nav',
			'type' => 'select',
			'options' => array('false', 'true'),
			'page' => $slider
		),
		array(
			'title' => 'Randomize Slides',
			'description' => 'Enable the slider to ignore the slide order and display them randomly. <strong>Default is false</strong>.',
			'id' => $shortname . '-full-slider-random',
			'class' => $shortname . '-full-slider-random',
			'name' => $shortname . '-full-slider-random',
			'type' => 'select',
			'options' => array('false', 'true'),
			'page' => $slider
		),
		array(
			'title' => 'Pause on Hover',
			'description' => 'Disable the slide transitions when hovering or interfacing with the slider. <strong>Default is true</strong>.',
			'id' => $shortname . '-full-slider-pause-hover',
			'class' => $shortname . '-full-slider-pause-hover',
			'name' => $shortname . '-full-slider-pause-hover',
			'type' => 'select',
			'options' => array('true', 'false'),
			'page' => $slider
		),
		array(
			'type' => 'section title close',
			'page' => $slider
		),
		array(
			'type' => 'section close',
			'page' => $slider
		),
		array(
			'type' => 'close',
			'page' => $slider
		)
	);
?>