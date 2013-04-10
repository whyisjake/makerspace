<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
$post_page_title = get_the_title(get_option('page_for_posts', true)); //get the title of the parent (which is the blog)
get_header(); ?>
	<section id="content-header">
		<section class="wrapper">
			<h1><?php echo $post_page_title; ?></h1>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<?php while(have_posts()) : the_post(); ?>
				<?php mms_content_nav('nav-above'); ?>

				<?php get_template_part('content', 'single'); ?>

				<?php mms_content_nav('nav-below'); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if(comments_open() || '0' != get_comments_number())
						comments_template('', true);
				?>
			<?php endwhile; // end of the loop. ?>
		</section><!--[END #body]-->
		<?php get_sidebar(); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer(); ?>