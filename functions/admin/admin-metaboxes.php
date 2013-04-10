<?php
	/**
 	  * @package WordPress
 	  * @subpackage Mentor.Makerspace.com
 	 **/
?>
<?php
	
	/**** Anything and everything Meta Boxes goes in here ****/
	
	/*****
	 * Description: Register our meta boxes and add them to the appropriate pages and posts
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_add_meta_boxes() {
		add_meta_box('mms-meta-tags', 'Title and Meta Tags', 'mms_meta_tag_mb', 'post', 'normal', 'high');
		add_meta_box('mms-meta-tags', 'Title and Meta Tags', 'mms_meta_tag_mb', 'page', 'normal', 'high');
	}
	add_action('add_meta_boxes', 'mms_add_meta_boxes');
	
	
	/*****
	 * Description: Create the function for our title and meta tag meta boxe
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_meta_tag_mb() {
		global $post;
		$meta_value = unserialize(get_post_meta($post->ID, '_mms-meta-boxes', true));
		wp_nonce_field('mms-meta-box-nonce', 'meta_box_nonce'); ?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.meta-count').each(function() {
					var length = $(this).val().length; //get the current number of characters
					var title_max = 69;
					var descript_max = 155;
					var keyword_max = 200;
					
					$(this).parent().find('.meta-counter').html(length); //add the character count
					$(this).keyup(function() {
						var new_length = $(this).val().length; //get the new current character count
						var title_length = $('#mms-title-tag').val().length;
						var descript_length = $('#mms-meta-description').val().length;
						var keyword_length = $('#mms-meta-keywords').val().length;
						
						if(title_length > title_max) {
							$('#mms-title-tag').parent().find('.meta-counter').addClass('count-over');
						} else {
							$('#mms-title-tag').parent().find('.meta-counter').removeClass('count-over');
						}
						
						if(descript_length > descript_max) {
							$('#mms-meta-description').parent().find('.meta-counter').addClass('count-over');
						} else {
							$('#mms-meta-description').parent().find('.meta-counter').removeClass('count-over');
						}
						
						if(keyword_length > keyword_max) {
							$('#mms-meta-keywords').parent().find('.meta-counter').addClass('count-over');
						} else {
							$('#mms-meta-keywords').parent().find('.meta-counter').removeClass('count-over');
						}
					
						$(this).parent().find('.meta-counter').html(new_length); //update the current character count
					});
				});
			});
		</script>
		<table id="meta-tags" width="100%">
			<tr scope="row">
				<th scope="row" style="width:100px; text-align:left;">Title Tag</th>
				<td>
					<label for="mms-title-tag">
						<span class="meta-counter alignright"></span>
						<input type="text" name="_mms-meta-boxes[]" id="mms-title-tag" class="full-width meta-count" value="<?php echo is_array($meta_value) ? stripslashes($meta_value[0]) : ''; ?>" />
					</label>
				</td>
			</tr>
			<tr scope="row">
				<th scope="row" style="width:100px; text-align:left;">Meta Description</th>
				<td>
					<label for="mms-meta-description">
						<span class="meta-counter alignright"></span>
						<input type="text" name="_mms-meta-boxes[]" id="mms-meta-description" class="full-width meta-count" value="<?php echo is_array($meta_value) ? stripslashes($meta_value[1]) : ''; ?>" />
					</label>
				</td>
			</tr>
			<tr scope="row">
				<th scope="row" style="width:100px; text-align:left;">Meta Keywords</th>
				<td>
					<label for="mms-meta-keywords">
						<span class="meta-counter alignright"></span>
						<input type="text" name="_mms-meta-boxes[]" id="mms-meta-keywords" class="full-width meta-count" value="<?php echo is_array($meta_value) ? stripslashes($meta_value[2]) : ''; ?>" />
					</label>
				</td>
			</tr>
		</table>
	<?php }
	
	
	/*****
	 * Description: Save our meta boxes into the database post_meta
	 * Since: 0.1
	 * Author: Cole Geissinger
	/*****/
	function mms_save_meta_boxes($post_id) {
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if(!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'mms-meta-box-nonce')) return;
		if(!current_user_can('edit_post')) return;
		
		$mms_meta_boxes = addslashes(serialize($_POST['_mms-meta-boxes']));
		update_post_meta($post_id, '_mms-meta-boxes', $mms_meta_boxes);
	}
	add_action('save_post', 'mms_save_meta_boxes');
?>