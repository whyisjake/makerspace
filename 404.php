<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */

get_header(); ?>
	<section id="content-header">
		<section class="wrapper">
			<h1 class="entry-title"><?php _e('404! Page Not Found', 'mentor_makerspace'); ?></h1>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'mentor_makerspace' ); ?></p>

			<?php get_search_form(); ?>

			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<div class="widget">
				<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'mentor_makerspace' ); ?></h2>
				<ul>
				<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
				</ul>
			</div><!-- .widget -->

			<?php
			/* translators: %1$s: smilie */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'mentor_makerspace' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>

			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
		</section><!--[END #body]-->
		<?php get_sidebar(); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer(); ?>