<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */

get_header(); ?>
	<section id="content-header">
		<section class="wrapper">
			<h1><?php single_post_title(); ?></h1>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<?php while(have_posts()) : the_post();
				get_template_part('content', 'page');
			endwhile; ?>
		</section><!--[END #body]-->
		<?php get_sidebar(); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer(); ?>