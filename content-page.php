<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php edit_post_link(__('Edit Page', 'mentor_makerspace'), '<span class="edit-link">', '</span>'); ?>
	<?php the_content(); ?>
</article><!--[END #post-<?php the_ID(); ?> ]-->
