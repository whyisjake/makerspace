<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */

get_header(); ?>
	<section id="content-header">
		<section class="wrapper">
			<h1 class="page-title">
				<?php
					if(is_category()) {
						echo single_cat_title('', false);
					} elseif(is_tag()) {
						echo single_tag_title('', false);
					} elseif(is_day()) {
						echo get_the_date();
					} elseif(is_month()) {
						echo get_the_date('F Y');
					} elseif(is_year()) {
						echo get_the_date('Y');
					} else {
						_e('Archives', 'mentor_makerspace');
					}
				?>
			</h1>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<?php if(have_posts()) : ?>
				<header class="page-header">
					
					<?php
						if ( is_category() ) {
							// show an optional category description
							$category_description = category_description();
							if ( ! empty( $category_description ) )
								echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

						} elseif ( is_tag() ) {
							// show an optional tag description
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) )
								echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						}
					?>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php mms_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>
		</section><!--[END #body]-->
		<?php get_sidebar(); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer(); ?>