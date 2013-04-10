<?php
/**
 * The template for displaying search forms in Mentor.Makerspace.com
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
?>
<form method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
	<input type="search" class="field" name="s" value="<?php echo esc_attr(get_search_query()); ?>" id="s" placeholder="<?php esc_attr_e('Search', 'mentor_makerspace'); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Go', 'mentor_makerspace'); ?>" />
</form>
