<?php
	/**
	 * Custom template tags for this theme.
	 *
	 *
	 * @package Mentor.Makerspace.com
	 * @since Mentor.Makerspace.com 1.0
	 */


	/************* BUDDYPRESS CUSTOM FUNCITONS *************/
	function makerspace_user_notification_count() {
		$notifications = bp_core_get_notifications_for_user(bp_loggedin_user_id(), 'object');
		$count = !empty($notifications) ? count($notifications) : 0;

		echo $count;
	}
	
	
	/*****
	 * Description: Add our dynamic color options to the head of our document
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_custom_theme_options() {
		global $shortname, $mms_content_options, $mms_slider_options;
		
		/*** [ Add Styles ] ***/
		//theme options
		$theme_header_height = $mms_content_options[$shortname . '-header'];
		$theme_header_padding = $mms_content_options[$shortname . '-header-padding'];
		$theme_font = array(
			'font' => $mms_content_options[$shortname . '-font1'],
			'font-options' => array(
				'body' => $mms_content_options[$shortname . '-font1-all'],
				'nav' => $mms_content_options[$shortname . '-font1-nav'],
				'#sidebar h1, #sidebar h2, #sidebar h3, #sidebar h4, #sidebar h5' => $mms_content_options[$shortname . '-font1-sidebar'],
				'#main h1' => $mms_content_options[$shortname . '-font1-h1'],
				'#main h2' => $mms_content_options[$shortname . '-font1-h2'],
				'#main h3' => $mms_content_options[$shortname . '-font1-h3'],
				'#main h4' => $mms_content_options[$shortname . '-font1-h4'],
				'#main h5' => $mms_content_options[$shortname . '-font1-h5'],
				'#main h6' => $mms_content_options[$shortname . '-font1-h6'],
				'#body-content p, #body-content li, #body-content a, #body-content blockquote' => $mms_content_options[$shortname . '-font1-body-text'],
			)
		);
		$theme_font_options = implode(', ', array_keys(array_filter($theme_font['font-options'])));
		
		if(!empty($mms_content_options)) {
			echo '<style type="text/css">';

			/*** Theme Options ***/
			//header height
			if(is_numeric($theme_header_height)) {
				$header_height = $theme_header_height . 'px';
			} else {
				$header_height = $theme_header_height;
			}
			echo (!empty($header_height)) ? "header{height:{$header_height};}" : '';
			
			//header padding
			echo (!empty($theme_header_padding)) ? "header{padding:{$theme_header_padding};}" : '';
			
			//custom font
			if(!empty($theme_font['font']) && $theme_font['font'] != '-- Select A Font --') {
				echo (!empty($theme_font) && !empty($theme_font['font-options'])) ? "{$theme_font_options}{font-family:'{$theme_font['font']}';}" : '';
			}
			
			echo '</style>' . "\n";
		}
		
		/*** [ Add Javascripts ] ***/
		//$slider_function = $mms_slider_options[$shortname . '-slider'];
		
		//add slider functions
		//mms_slider_source();
	}
	add_action('wp_head', 'mms_custom_theme_options');


	/*****
	 * Description: Displays our user login form and our user data board
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function makerspace_loggin_user_data() { 
		global $current_user, $bp;
		get_currentuserinfo(); ?>
		<aside id="member-meta">
			<div id="member-area" class="group">
				<?php if(is_user_logged_in()) : ?>
					<?php if(!empty($current_user->user_firstname)) : ?>
						<h5><?php printf(__('Welcome back %1$s!', 'mentor_makerspace'), $current_user->user_firstname); ?></h5>
					<?php else : ?>
						<h5><?php printf(__('Welcome back %1$s!', 'mentor_makerspace'), $current_user->display_name); ?></h5>
					<?php endif; ?>
					<div id="user-photo" class="alignleft">
						<?php echo get_avatar($current_user->user_email, '71'); ?>
					</div><!--[END #user-photo]-->
					<div id="user-data" class="alignleft">
						<ul class="reset-list">
							<li><a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()) . 'friends/requests/'; ?>"><span><?php bp_friend_total_requests_count(); //makerspace_user_notification_count(); ?></span> Requests</a></li>
							<li><a href="<?php echo bp_core_get_user_domain(bp_loggedin_user_id()) . 'messages/'; ?>"><span><?php echo messages_get_unread_count(); ?></span> Messages</a></li>
							<!--<li><a href="#"><span>0</span> Projects</a></li>-->
							<li class="logout-link"><a href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></li>
						</ul>
					</div><!--[END #user-data]-->
				<?php else: ?>
					<form name="loginform" id="loginform" action="<?php echo home_url(); ?>/wp-login.php" method="post" class="group">
						<div class="alignleft">
							<input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" placeholder="<?php esc_attr_e('Username', 'mentor_makerspace'); ?>" size="20" tabindex="30" /></label>
						</div>
						<div class="alignleft">
							<input type="password" name="pwd" id="user_pass" class="input " value="<?php echo esc_attr($user_login); ?>" placeholder="<?php esc_attr_e('Password', 'mentor_makerspace'); ?>" size="20" tabindex="40" /></label>
						</div>
						<div class="submit alignright">
							<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Go', 'mentor_makerspace'); ?>" tabindex="100" />
							<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" />
							<input type="hidden" name="testcookie" value="1" />
						</div>
					</form>
					<p><a href="http://makerspace.com/register/" class="button primary">Register</a></p>
				<?php endif; ?>
			</div><!--[END #member-area]-->
		</aside><!--[END #member-meta]-->
	<?php }


	/*****
	 * Description: Display navigation to next/previous pages when applicable
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	if(!function_exists('mms_content_nav')) :
		function mms_content_nav($nav_id) {
			if(function_exists('pagenavi')) { pagenavi(); }
		}
	endif; //end mms_content_nav


	/*****
	 * Description: Prints HTML with meta information for the current post-date/time and author
	 * Parameters: Insert the value you wish to retrieve. Set a fall back in case no data exists for your $value.
	 * NOTES: Check the wp_get_current_user for information that can be returned http://codex.wordpress.org/Function_Reference/wp_get_current_user
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_get_get_user_info($value = 'display_name', $fallback = '') {
		$current_user = wp_get_current_user(); //return the current users information when logged in

		if(!empty($current_user->$value)) {
			echo $current_user->$value;
		} else {
			echo $current_user->$fallback;
		}
	}


	/*****
	 * Description: Prints HTML with meta information for the current post-date/time and author
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	if(!function_exists('mms_post_meta')) :
		function mms_post_meta() { ?>
			<aside class="post-meta group">
				<section class="post-date alignleft">
					<?php printf(__('%1$s in ', 'mentor_makerspace'), get_the_date()); the_category(','); ?>
				</section> 
				<section class="tags alignleft">
					<?php 
						$tags_list = get_the_tag_list('', __(', ', 'mentor_makerspace'));
						if($tags_list) {
							printf(__('Tags: %1$s', 'mentor_makerspace'), $tags_list);
						} else {
							_e('Tags: <span stlye="font-weight:normal;">none</span>');
						}
					?>
				</section> 
				<section class="comments alignleft">
					<?php printf(__('%1$s <a href="%2$s#comments">Comments</a>', 'mentor_makerspace'), comments_number('<span>0</span>', '<span>1</span>', '<span>%</span>'), get_permalink());  ?>
				</section>
			</aside>
		<?php }
	endif;
	
	
	/*****
	* Description: Return the ID of home or interior
	* Since: 0.1
	* Author: Cole Geissinger
	/*****/
	function mms_get_page_id() {
		if(is_front_page()) {
			$page_id = 'home';
		} else {
			$page_id = 'interior';
		}
		
		echo $page_id;
	}
	
	
	/*****
	 * Description: List out our slider images
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_get_slides() {
		global $shortname, $mms_slider_options;
		
		$slide1 = $mms_slider_options[$shortname . '-slider-image-1'];
		$slide2 = $mms_slider_options[$shortname . '-slider-image-2'];
		$slide3 = $mms_slider_options[$shortname . '-slider-image-3'];
		$slide4 = $mms_slider_options[$shortname . '-slider-image-4'];
		$slide5 = $mms_slider_options[$shortname . '-slider-image-5'];
		$slide6 = $mms_slider_options[$shortname . '-slider-image-6'];
		
		if(!empty($slide1) || !empty($slide2) || !empty($slide3) || !empty($slide4) || !empty($slide5) || !empty($slide6)) {
			$slides = array($slide1,$slide2,$slide3,$slide4,$slide5,$slide6);
		}
		if(isset($slides)) {
			echo '<ul class="slides">' . "\n";
				$i = 1;
			foreach($slides as $slide) {
				if(!empty($slide)) {
					echo '<li>' . "\n";
					echo '<img src="' . $slide . '" />' . "\n";
					echo '</li>' . "\n";
				}
				$i++;
			}
			echo '</ul>' . "\n";
		} else {
			echo '<img src="' . get_stylesheet_directory_uri() . '/images/slider-1.jpg" title="Please upload some slides! :)" />';
		} 
	}

	
	
	/*****
	 * Description: Output the code for our Flexslider Slider (AKA Full Width Slider)
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_slider_source() {
		if(!is_admin() && is_front_page()) {
			global $shortname, $mms_slider_options;
			
			$animation = $mms_slider_options[$shortname . '-full-slider-animation'];
			$direction = $mms_slider_options[$shortname . '-full-slider-direction'];
			$auto = $mms_slider_options[$shortname . '-full-slider-box-columns'];
			$pause = $mms_slider_options[$shortname . '-full-slider-pause-time'];
			$animSpeed = $mms_slider_options[$shortname . '-full-slider-animation-speed'];
			$navEnabled = $mms_slider_options[$shortname . '-full-slider-navigation'];
			$keyboardNav = $mms_slider_options[$shortname . '-full-slider-keyboard-nav'];
			$mouseNav = $mms_slider_options[$shortname . '-full-slider-mouse-nav'];
			$randomSlide = $mms_slider_options[$shortname . '-full-slider-random'];
			$captionOpactiy = $mms_slider_options[$shortname . '-slider-caption-opacity'];
			$pauseHover = $mms_slider_options[$shortname . '-full-slider-pause-hover'];
			
			
			echo '<script type="text/javascript">jQuery(window).load(function(){jQuery(\'.flexslider\').flexslider({';
			
			//is an animation set, or else fall to default
			echo (isset($animation) && !empty($animation)) ? "animation:'$animation'," : "animation:'fade', ";

			//is there a slide direction set
			echo (isset($direction) && !empty($direction)) ? "slideDirection:'$direction'," : "slideDirection:'horizontal', ";

			//auto slide
			echo (isset($auto) && !empty($auto)) ? "slideshow:$auto," : "slideshow:true, ";
	
			//pause time
			echo (isset($pause) && !empty($pause)) ? "slideshowSpeed:$pause," : "slideshowSpeed:7000, ";
			
			//animation speed
			echo (isset($animSpeed) && !empty($animSpeed)) ? "animationDuration:$animSpeed," : "animationDuration:500, ";
			
			//is navigation enabled
			echo (isset($navEnabled) && !empty($navEnabled)) ? "directionNav:$navEnabled," : "directionNav:false, ";
			
			//use keyboard for navigation
			echo (isset($keyboardNav) && !empty($keyboardNav)) ? "keyboardNav:$keyboardNav," : "keyboardNav:true, ";
			
			//pause on hover
			echo (isset($mouseNav) && !empty($mouseNav)) ? "mousewheel:$mouseNav," : "mousewheel:true, ";
			
			//force manual transitions
			echo (isset($randomSlide) && !empty($randomSlide)) ? "randomize:$randomSlide," : "randomize:false, ";
			
			//caption background opacity
			echo (isset($pauseHover) && !empty($pauseHover)) ? "pauseOnHover:$pauseHover" : "pauseOnHover:false";					        
			
			echo '});});</script>';
		}
	}
	

	/*****
	 * Description: Prints text for the homepage title entered in the theme options
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_get_home_page_title() {
		global $shortname, $mms_content_options; ?>
		<p><?php echo esc_attr($mms_content_options[$shortname . '-home-page-title']); ?></p>
	<?php }
	
	/*****
	 * Description: Format the layout of our comments list
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_list_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; 
		
		//echo '<pre>'; print_r($comment); echo '</pre>'; ?>
		
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class('group'); ?>>
			<div class="gravatar alignleft">
				<?php echo get_avatar($comment->comment_author_email, '50'); ?>
			</div><!--[END .gravatar.alignleft]-->
			<div class="comment alignright">
				<div class="comment-meta">
					<strong><?php echo get_comment_author(); ?></strong> - <?php printf(__('%1$s', 'mentor_makerspace'), get_comment_date(), get_comment_time()); ?>
				</div><!--[END .comment-meta]-->
				
				<?php if($comment->comment_approved == '0') : ?>
					<em><?php _e('your comment is awaiting moderation.', 'mentor_makerspace'); ?></em><br />
				<?php endif; ?>
				
				<?php comment_text(); ?>
				
				<div class="reply">
					<?php comment_reply_link(array_merge($args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div><!--[END .reply]-->
			</div><!--[END .alignright]-->
		</li>
	<?php }


	/*****
	 * Description: Filter the comment form fields
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function my_fields($fields) {
		global $req, $aria_req, $commenter;
		$fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1"' . $aria_req . ' placeholder="Name" />' . '</p><!-- #form-section-author .form-section -->';
		$fields['email'] = '<p class="comment-form-email">' . '<label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2"' . $aria_req . ' placeholder="Email" />' . '</p><!-- #form-section-email .form-section -->';
		$fields['url'] = '<p class="comment-form-url"></p><label for="url">' . __( 'Website' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" placeholder="URL" />' . '<!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->';
		return $fields;
	}
	add_filter('comment_form_default_fields','my_fields');
	
	
	/*****
	 * Description: Filter the title to a set number of characters when using the previous and next_post_link function
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_shorten_linktext($linkstring) {
		$characters = 35;
		
		preg_match('/<a.*?>(.*?)<\/a>/is', $linkstring, $matches);
		$display_title = $matches[1];
		$new_title = shorten_with_ellipsis($display_title, $characters);
		
		return str_replace('>' . $display_title . '<', '>' . $new_title . '<', $linkstring);
	}
	function shorten_with_ellipsis($inputstring, $characters) {
  		return (strlen($inputstring) >= $characters) ? substr($inputstring, 0, ($characters-3)) . '...' : $inputstring;
	}
	add_filter('previous_post_link', 'mms_shorten_linktext');
	add_filter('next_post_link', 'mms_shorten_linktext');


	/*******************************************************************
	* @Author: Boutros AbiChedid
	* @Date:   March 20, 2011
	* @Websites: http://bacsoftwareconsulting.com/
	* http://blueoliveonline.com/
	* @Description: Numbered Page Navigation (Pagination) Code.
	* @Tested: Up to WordPress version 3.1.2 (also works on WP 3.3.1)
	********************************************************************/
	 
	/* Function that Rounds To The Nearest Value.
	   Needed for the pagenavi() function */
	function round_num($num, $to_nearest) {
	   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
	   return floor($num/$to_nearest)*$to_nearest;
	}
	 
	/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
	   Function is largely based on Version 2.4 of the WP-PageNavi plugin */
	function pagenavi($before = '', $after = '') {
	    global $wpdb, $wp_query;
	    $pagenavi_options = array();
	    $pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
	    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['first_text'] = ('First Page');
	    $pagenavi_options['last_text'] = ('Last Page');
	    $pagenavi_options['next_text'] = 'Next &raquo;';
	    $pagenavi_options['prev_text'] = '&laquo; Previous';
	    $pagenavi_options['dotright_text'] = '...';
	    $pagenavi_options['dotleft_text'] = '...';
	    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
	    $pagenavi_options['always_show'] = 0;
	    $pagenavi_options['num_larger_page_numbers'] = 0;
	    $pagenavi_options['larger_page_numbers_multiple'] = 5;
	 
	    //If NOT a single Post is being displayed
	    /*http://codex.wordpress.org/Function_Reference/is_single)*/
	    if (!is_single()) {
	        $request = $wp_query->request;
	        //intval — Get the integer value of a variable
	        /*http://php.net/manual/en/function.intval.php*/
	        $posts_per_page = intval(get_query_var('posts_per_page'));
	        //Retrieve variable in the WP_Query class.
	        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
	        $paged = intval(get_query_var('paged'));
	        $numposts = $wp_query->found_posts;
	        $max_page = $wp_query->max_num_pages;
	 
	        //empty — Determine whether a variable is empty
	        /*http://php.net/manual/en/function.empty.php*/
	        if(empty($paged) || $paged == 0) {
	            $paged = 1;
	        }
	 
	        $pages_to_show = intval($pagenavi_options['num_pages']);
	        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	        $pages_to_show_minus_1 = $pages_to_show - 1;
	        $half_page_start = floor($pages_to_show_minus_1/2);
	        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
	        $half_page_end = ceil($pages_to_show_minus_1/2);
	        $start_page = $paged - $half_page_start;
	 
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $end_page = $paged + $half_page_end;
	        if(($end_page - $start_page) != $pages_to_show_minus_1) {
	            $end_page = $start_page + $pages_to_show_minus_1;
	        }
	        if($end_page > $max_page) {
	            $start_page = $max_page - $pages_to_show_minus_1;
	            $end_page = $max_page;
	        }
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
	        //round_num() custom function - Rounds To The Nearest Value.
	        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
	        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
	        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
	        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
	 
	        if($larger_start_page_end - $larger_page_multiple == $start_page) {
	            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
	            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
	        }
	        if($larger_start_page_start <= 0) {
	            $larger_start_page_start = $larger_page_multiple;
	        }
	        if($larger_start_page_end > $max_page) {
	            $larger_start_page_end = $max_page;
	        }
	        if($larger_end_page_end > $max_page) {
	            $larger_end_page_end = $max_page;
	        }
	        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
	            /*http://php.net/manual/en/function.str-replace.php */
	            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
	            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
	            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
	            echo $before.'<div class="pagenavi">'."\n";
	 
	            if(!empty($pages_text)) {
	                echo '<span class="pages">'.$pages_text.'</span>';
	            }
	            //Displays a link to the previous post which exists in chronological order from the current post.
	            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
	            previous_posts_link($pagenavi_options['prev_text']);
	 
	            if ($start_page >= 2 && $pages_to_show < $max_page) {
	                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
	                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
	                /*http://codex.wordpress.org/Data_Validation*/
	                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
	                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
	                if(!empty($pagenavi_options['dotleft_text'])) {
	                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
	                }
	            }
	 
	            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
	                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
	                }
	            }
	 
	            for($i = $start_page; $i  <= $end_page; $i++) {
	                if($i == $paged) {
	                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
	                    echo '<span class="current">'.$current_page_text.'</span>';
	                } else {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
	                }
	            }
	 
	            if ($end_page < $max_page) {
	                if(!empty($pagenavi_options['dotright_text'])) {
	                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
	                }
	                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
	                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
	            }
	            next_posts_link($pagenavi_options['next_text'], $max_page);
	 
	            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
	                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
	                }
	            }
	            echo '</div>'.$after."\n";
	        }
	    }
	}
	
	
	/*****
	 * Description: Retrieve the Google Analytics code
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_ga_code() {
		global $shortname, $mms_general_settings;
		
		$ga = $mms_general_settings['mms-analytics-code'];
		
		if(isset($ga) && !empty($ga)) {
			echo "<script>\n";
			echo "var _gaq=[['_setAccount','$ga'],['_trackPageview']];`
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script'));";
			echo "</script>\n";
		}
	}


	/*****
	 * Description: Add custom field to the field editor in Gravity Forms
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function makerspace_add_placeholder_field($position, $form_id) {
		if($position == 25) { ?>
			<li class="admin_label_setting field_setting" style="display: list-item; ">
				<label for="field_placeholder">
					Placeholder Text <a href="javascript:void(0);" class="tooltip tooltip_form_field_placeholder" tooltip="&lt;h6&gt;Placeholder&lt;/h6&gt;Enter the placeholder/default text for this field.">(?)</a>
				</label>
				<input type="text" id="field_placeholder" class="fieldwidth-3" size="35" onkeyup="SetFieldProperty('placeholder', this.value);">
			</li>
		<?php }
	}
	add_action("gform_field_standard_settings", "makerspace_add_placeholder_field", 10, 2);


	/*****
	 * Description: Set our JavaScripts needed for the makerspace_add_placeholder_field in Gravity Forms
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function makerspace_add_placeholder_editor_js() { ?>
		<script>
			//bind to the field settings event to initialize the checkbox
			jQuery(document).bind('gform_load_field_settings', function(event, field, form) {
				jQuery('#field_placeholder').val(field['placeholder']);
			});
		</script>
	<?php }
	add_action('gform_editor_js', 'makerspace_add_placeholder_editor_js');


	/*****
	 * Description: Use JavaScript to inject the placeholder text in Gravity Forms to it's field
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function makerspace_gform_enqueue_scripts($form, $is_ajax = false) { ?>
		<script>
			jQuery(function() {
				<?php
					//go through each of the form fields
					foreach($form['fields'] as $i => $field) {
						//check if the field has an assigned placeholder
						if(isset($field['placeholder']) && !empty($field['placeholder'])) {
							//if a placeholder text exists, inject it as a new property to the field using jQuery ?>
							var $this = jQuery('#input_<?php echo $form['id']; ?>_<?php echo $field['id']; ?>')
							$this.attr('placeholder', '<?php echo $field['placeholder']; ?>');
							$this.parent().prev().remove(); //remove the labels because we no longer need them
						<?php }
					}
				?>
			});
		</script>
	<?php }
	add_action('gform_enqueue_scripts', 'makerspace_gform_enqueue_scripts', 10, 2);

	function makerspace_replace_bbpress_title($title) {
		return 'Forums';
	}
	remove_filter('bb_get_header', 'bb_get_title');
	apply_filters('bb_init', 'makerspace_replace_bbpress_title');


	/********** SHORTCODES **********/
	/*****
	 * Description: Display a one column layout
	 * Useage: [one-column class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/one-column]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the one column layout. If you wish, you may use the class attribute to insert custom styles
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_one_column($atts, $content = null) { //displays the right source code for a one column layout.
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if(!empty($class)) {
			return '<section class="one-column clear ' . $class . '">' . do_shortcode($content) . '</section>';
		} else {
			return '<section class="one-column clear">' . do_shortcode($content) . '</section>';
		}
		
	}

	/*****
	 * Description: Display a two column layout
	 * Useage: [two-column class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/two-column]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the two column layout. If you wish, you may use the class attribute to insert custom styles. This shortcode only outputs one of the columns. To achieve the two-columns, you need to create three columns with this shortcode. I.E. use it two times.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_two_column($atts, $content = null) { //displays the right source code for a two column layout.
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if(!empty($class)) {
			return '<section class="two-column ' . $class . '">' . do_shortcode($content) . '</section>';
		} else {
			return '<section class="two-column">' . do_shortcode($content) . '</section>';
		}
	}
	
	/*****
	 * Description: Display a three column layout
	 * Useage: [three-column class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/three-column]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the three column layout. If you wish, you may use the class attribute to insert custom styles. This shortcode only outputs one of the columns. To achieve the three-columns, you need to create three columns with this shortcode. I.E. use it three times.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_three_column($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if(!empty($class)) {
			return '<section class="three-column ' . $class . '">' . do_shortcode($content) . '</section>';
		} else {
			return '<section class="three-column">' . do_shortcode($content) . '</section>';
		}
	}

	/*****
	 * Description: Display a four column layout
	 * Useage: [four-column class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/four-column]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the four column layout. If you wish, you may use the class attribute to insert custom styles. This shortcode only outputs one of the columns. To achieve the four-columns, you need to create four columns with this shortcode. I.E. use it four times.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_four_column($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if(!empty($class)) {
			return '<section class="four-column ' . $class . '">' . do_shortcode($content) . '</section>';
		} else {
			return '<section class="four-column">' . do_shortcode($content) . '</section>';
		}
	}

	/*****
	 * Description: Display a featured block
	 * Useage: [featured-block class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/featured-block]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the featured block. If you wish, you may use the class attribute to insert custom styles.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_featured_block($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if(!empty($class)) {
			return '<section class="featured-block ' . $class . '">' . do_shortcode($content) . '</section>';
		} else {
			return '<section class="featured-block">' . do_shortcode($content) . '</section>';
		}
	}

	/*****
	 * Description: Display a call to action
	 * Useage: [call-to-action class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/call-to-action]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the call to action. If you wish, you may use the class attribute to insert custom styles.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_call_to_action($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		if(!empty($class)) {
			return '<div class="call-to-action ' . $class . '">' . do_shortcode($content) . '</div>';
		} else {
			return '<div class="call-to-action">' . do_shortcode($content) . '</div>';
		}
	}
	

	/*****
	 * Description: Display a button
	 * Useage: [button href="http://www.domain.com/url-to-link-to" class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/button]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the call to action. If you wish, you may use the class attribute to insert custom styles.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_iframe_output($atts, $content = null) {
		extract(shortcode_atts(array(
			'href' => '#',
			'width' => '691',
			'height' => '500',
		), $atts));

		if(!empty($href)) {
			return '<iframe src="' . $href . '" width="' . $width . '" height="' . $height . '" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>';
		} else {
			return 'Please enter an href to display your iframe! E.g. [iframe href="URL HERE"]';
		}
	}


	/*****
	 * Description: Display a button
	 * Useage: [button href="http://www.domain.com/url-to-link-to" class="class-1 class-2"]CONTENT HERE TO BE WRAPPED[/button]
	 * Parameters: class="$classes_here"
	 * NOTES: Wrap all of your text you wish to be in the call to action. If you wish, you may use the class attribute to insert custom styles.
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_button($atts, $content = null) {
		extract(shortcode_atts(array(
			'href' => '#',
			'class' => '',
			'style' => ''
		), $atts));

		if(!empty($style)) {
			if(!empty($class)) {
				return '<div class="standalone"><a href="' . $href . '" class="button ' . $class . '">' . do_shortcode($content) . '</a><div>';
			} else {
				return '<div class="standalone"><a href="' . $href . '" class="button">' . do_shortcode($content) . '</a></div>';
			}
		} else {
			if(!empty($class)) {
				return '<a href="' . $href . '" class="button ' . $class . '">' . do_shortcode($content) . '</a>';
			} else {
				return '<a href="' . $href . '" class="button">' . do_shortcode($content) . '</a>';
			}
		}
	}

	/*****
	 * Description: Clear any floated elements
	 * Useage: [clear /]
	 * Since: 1.0
	 * Author: Cole Geissinger
	/*****/
	function mms_clear() {
		return '<div class="clear"></div>';
	}
	
	/*****
	 * Description: Register all of our shortcodes with WordPress when it is initalized
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_register_shortcodes() {
		add_shortcode('one-column', 'mms_one_column');
		add_shortcode('two-column', 'mms_two_column');
		add_shortcode('three-column', 'mms_three_column');
		add_shortcode('four-column', 'mms_four_column');
		add_shortcode('featured-block', 'mms_featured_block');
		add_shortcode('call-to-action', 'mms_call_to_action');
		add_shortcode('iframe', 'mms_iframe_output');
		add_shortcode('button', 'mms_button');
		add_shortcode('clear', 'mms_clear');
		add_shortcode('new_directory', 'mms_directory');
	}
	add_action('init', 'mms_register_shortcodes');
	
	
	/*****
	 * Description: Stop the wpautop wptexturize filters from parsing our shortcodes and then reactivate them after
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_formatter($content) {
		$new_content = '';
	
		//matches the contents and the open and closing tags
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
		//matches just the contents
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
		//divide content into pieces
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
		foreach($pieces as $piece) {
			//look for presence of the shortcode
			if(preg_match($pattern_contents, $piece, $matches)) {
	
				//append to content (no formatting)
				$new_content .= $matches[1];
				
			} else {
	
				//format and append to content
				$new_content .= wptexturize(wpautop($piece));
			}
		}
	
		return $new_content;
	}
	// Remove the 2 main auto-formatters
	remove_filter('the_content', 'wpautop');
	remove_filter('the_content', 'wptexturize');
	
	// Before displaying for viewing, apply this function
	add_filter('the_content', 'mms_formatter', 99);
	add_filter('widget_text', 'mms_formatter', 99);
	
	
	//fix the backtrack_limit bug - if too many shortcodes are used, the content disappears.
	//long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
	@ini_set('pcre.backtrack_limit', 500000);


	function mms_directory() {
		//get_leads($form_id, $sort_field_number=0, $sort_direction='DESC', $search='', $offset=0, $page_size=30, $star=null, $read=null, $is_numeric_sort = false, $start_date=null, $end_date=null, $status='active'){
		$entries = RGFormsModel::get_leads( 2, '1.6', 'ASC', '', '0', 1000 );
		//var_dump($entries);
		$output = '<table class="gf_directory widefat fixed">
			<thead>
				<tr>
					<th>Makerspace Name</th>
					<th>Makerspace Website</th>
					<th>City</th>
					<th>State</th>
				</tr>
			</thead>';
		$i = 1;
		error_reporting('E_ALL');
		foreach ($entries as $entry) {
			$output .= '<tr class="' . ( $i%2 ? 'odd':'even' ) . '">';
			$output .= '<td>' . $entry['1'] . '</td>';
			$output .= '<td><a href="' . esc_url( $entry['2'] ) . '">' . $entry['2'] . '</td>';
			$output .= '<td>' . $entry['11'] . '</td>';
			$output .= '<td>' . $entry['12'] . '</td>';
			$i++;
		}
		$output .= '</table>';
		return $output;
	}

?>
