<?php
	/**
 	  * @package WordPress
 	  * @subpackage Mentor.Makerspace.com
 	 **/
?>
<?php
	
	/********** Initialize and register any menus or functions within the admin area **********/
	//include_once('admin-options.php');
	$theme_name = 'Mentor.Makerspace.com';
	$shortname = 'mms';
	$mms_theme_options = unserialize(get_option($shortname . '-theme-options'));
	$mms_content_options = unserialize(get_option($shortname . '-content-options'));
	$mms_color_options = unserialize(get_option($shortname . '-color-options'));
	$mms_slider_options = unserialize(get_option($shortname . '-slideshow'));
	$mms_homepage_options = unserialize(get_option($shortname . '-home-page-options'));
	
	
	/*****
	 * Description: Filter the WP Menu's in the admin and add a home link
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_home_page_menu($args) {
		$args['show_home'] = true;
		return $args;
	}
	add_filter('wp_page_menu_args', 'mms_home_page_menu');
	
	
	/*****
	 * Description: Add our theme menu and run the processing script
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_add_admin_menu() {
		global $theme_name, $shortname;

		if(isset($_POST['page'])) {
			$page = $_POST['page'];
		}
		$mms_options_array = array();
		
		//get our current pages $fw_options
		if(!empty($page)) {
			include('options/' . $page . '.php');
		}
		
		//check if the theme options have been saved.
		if(isset($_REQUEST['action'])) {
			if($shortname . '-submitted' == $_REQUEST['action']) {
				foreach($mms_options as $value) {
					if($page == $value['page']) { 
						if(in_array($value['type'], array('text', 'text-button', 'text-color', 'textarea', 'select', 'select-typography', 'select-images', 'checkbox', 'radio-images'))) {
							if(!empty($_POST[$value['name']])) {
								//echo '<pre>'; print_r($_POST[$value['name']]); echo '</pre>';
								$mms_options_array[$value['name']] = sanitize_text_field($_POST[$value['name']]);
							}
						}
					}
				}
				//echo '<pre>'; print_r($fw_options_array); echo '</pre>'; 
				update_option($page, serialize($mms_options_array)); 
				
				wp_redirect('admin.php?page=' . $page . '&' . $shortname . '-submitted=true');
				die();
			}
		}
		
		//add the general settings page
		add_theme_page('Theme Options', 'Theme Options', 'moderate_comments', $shortname . '-content-options', 'mms_theme_options');
		
		//add the slider settings and upload page
		add_theme_page('Theme Slideshow', 'Theme Slideshow', 'moderate_comments', $shortname . '-slideshow', 'mms_theme_options');
	}
	add_action('admin_menu', 'mms_add_admin_menu');
	
	
	/*****
	 * Description: Main function which will loop through our options array and output the needed fields
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_theme_options() {
		global $theme_name, $shortname; 
		$page = $_GET['page']; 
		
		//get our current pages $mms_options
		if(!empty($page)) {
			include('options/' . $page . '.php');
		}
		
		//echo '<pre>'; print_r($mms_options); echo '</pre>'; 
		$mms_options_array = unserialize(get_option($page)); ?>

		<div class="wrap <?php echo $shortname; ?>-wrap">
			<div id="main-container">
				<form method="post">
					<?php foreach($mms_options as $value) : //loop through the laoded options
						if($value['page'] == $page) : //load only the PHP for the current page
							switch($value['type']) {
								case 'header': ?>
									<div id="main-header">
										<h2><?php echo $value['title']; ?></h2>
										<?php //if the page is saved, display this message
											if(isset($_GET[$shortname . '-submitted'])) {
												echo '<div id="message" class="updated fade"><p><strong>' . $theme_name . ' options saved.</strong></p></div>';
											}
										?>
									</div><!--[END #main-header]-->
									<?php break;
								
								case 'open': ?>
									<div <?php echo $value['id']; ?> class="section<?php echo ' ' . $value['class']; ?>">
										<h3><?php echo $value['title']; ?></h3>
									<?php break;
								
								case 'close': ?>
									</div><!--[END <?php echo '#' . $value['id']; ?>.section<?php echo '.' . $value['class']; ?>]-->
									<?php break;
								
								case 'section open': ?>
									<div class="box-container">
									<?php break;
									
								case 'section close': ?>
									</div><!--[END .box-container]-->
									<?php break;
									
								case 'section title open': ?>
									<div class="panel">
										<h2><?php echo $value['title']; ?></h2>
										<div class="panel-body">
									<?php break;
									
								case 'section title close': ?>
										</div><!--[END .panel-body]-->
									</div><!--[END .panel]-->
									<?php break;
									
								case 'text': //code for generic text fields ?>
									<div id="<?php echo $value['id']; ?>-wrapper" class="<?php echo $shortname; ?>-input <?php echo $shortname; ?>-text <?php echo $value['name']; if($value['class']) { echo ' ' . $value['class']; } ?> group">  
										<label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label>
										<input name="<?php echo $value['name']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo (isset($mms_options_array[$value['name']])) ? $mms_options_array[$value['name']] : ''; ?>" placeholder="<?php echo (isset($value['placeholder'])) ? $value['placeholder'] : ''; ?>" />
										<small class="description"><?php echo $value['description']; ?></small>
									</div>
									<?php break;
								
								case 'text-button': //code for text fields followed by an upload button ?>
									<div id="<?php echo $value['id']; ?>-wrapper" class="<?php echo $shortname; ?>-input <?php echo $shortname; ?>-text-button <?php echo $value['name']; if($value['class']) { echo ' ' . $value['class']; } ?> group"> 
										<label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label>
										<input name="<?php echo $value['name']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo (isset($mms_options_array[$value['name']])) ? $mms_options_array[$value['name']] : ''; ?>" placeholder="<?php echo (isset($value['placeholder'])) ? $value['placeholder'] : ''; ?>" />
										<input type="button" value="Upload" class="text-button <?php if($value['class'] == 'image-upload') echo 'image-upload'; ?>" />
										<small class="description"><?php echo $value['description']; ?></small>
									</div>
									<?php break;
								
								case 'text-color': //code for color selections ?>
									<div id="<?php echo $value['id']; ?>-wrapper" class="<?php echo $shortname; ?>-input <?php echo $shortname; ?>-text-color <?php echo $value['name']; if($value['class']) { echo ' ' . $value['class']; } ?> group"> 
										<label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label>
										<input name="<?php echo $value['name']; ?>" id="<?php echo $value['id']; ?>" class="color-picker" type="text" value="<?php echo (isset($mms_options_array[$value['name']])) ? $mms_options_array[$value['name']] : ''; ?>" placeholder="<?php echo (isset($value['placeholder'])) ? $value['placeholder'] : ''; ?>" />
										<div class="colorpicker-wrapper">
											<div class="colorpicker-icon"  <?php if($mms_options_array[$value['name']] != "") : ?>style="background-color:#<?php echo $mms_options_array[$value['name']]; ?>"<?php endif; ?>></div>
										</div>
										<small class="description"><?php echo $value['description']; ?></small>
									</div>
									<?php break;
									
								case 'textarea': //code for generic textareas ?>
									<div id="<?php echo $value['id']; ?>-wrapper" class="<?php echo $shortname; ?>-input <?php echo $shortname; ?>-textarea <?php echo $value['name']; if($value['class']) { echo ' ' . $value['class']; } ?> group">   
										<label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label>
										<small class="description"><?php echo $value['description']; ?></small>
										<textarea name="<?php echo $value['name']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"><?php echo (isset($mms_options_array[$value['name']])) ? $mms_options_array[$value['name']] : ''; ?></textarea>
									</div>
									<?php break;
									
								case 'select': //code for generic select fields ?>
									<div id="<?php echo $value['id']; ?>-wrapper" class="<?php echo $shortname; ?>-select <?php echo $shortname; ?>-options <?php echo $value['name']; if($value['class']) { echo ' ' . $value['class']; } ?> group"> 
										<label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label>
										<select name="<?php echo $value['name']; ?>" id="<?php echo $value['id']; ?>">
											<?php foreach($value['options'] as $option) : ?>
												<option <?php if($mms_options_array[$value['name']] == $option) { echo 'selected="selected"'; } ?>>
													<?php echo $option; ?>
												</option>
											<?php endforeach; ?>
										</select>
										<small class="description"><?php echo $value['description']; ?></small>
										<div class="clearfix"></div>
									</div>
									<?php break;
									
								case 'checkbox': //code for checkboxes ?>
									<div id="<?php echo $value['id']; ?>" class="<?php echo $shortname; ?>-input <?php echo $shortname; ?>-checkbox <?php echo $value['name']; if($value['class']) { echo ' ' . $value['class']; } ?> group"> 
										<input type="checkbox" name="<?php echo $value['name']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo ($mms_options_array[$value['name']]) ? 'checked=checked"' : ''; ?> />
										<label for="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></label> 
										<div class="clearfix"></div>
									</div>
									<?php break;
							} //end switch statement
						endif;
					endforeach; ?>
					<input name="save" type="submit" value="Save Changes" class="button" />
					<input type="hidden" name="action" value="<?php echo $shortname; ?>-submitted" />
					<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>" />
				</form>
			</div><!--[END #main-container]-->
		</div><!--[END .wrap.<?php echo $shortname; ?>-wrap]-->
	<?php }

