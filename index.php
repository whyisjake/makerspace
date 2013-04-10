<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
get_header(); ?>
	<section id="content-header">
		<section class="wrapper">
			<div>
				<?php mms_get_home_page_title(); ?>
			</div>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); //start the loop ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part('content', get_post_format());
					?>
				<?php endwhile; ?>

				<?php mms_content_nav( 'nav-below' ); ?>
			<?php else : ?>
				<?php get_template_part('no-results', 'index'); ?>
			<?php endif; ?>
		</section><!--[END #body]-->
		<?php get_sidebar(); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer(); ?>
<?php get_footer(); ?>