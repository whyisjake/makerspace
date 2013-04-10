<?php
/**
 * The template for displaying a list of all the Categories
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 * Template Name: Categories Archive
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
			<?php
				$categories = get_categories();
				foreach($categories as $category) {
					//echo '<pre>'; print_r($category); echo '</pre>'; ?>
					<article class="category group">
						<h2><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->name; ?> <small><?php echo $category->category_count; ?></small></a></h2>
						<?php if(!empty($category->description)) : ?>
							<p><?php echo $category->description; ?></p>
						<?php endif; ?>
					</article>
				<?php }
			?>
		</section><!--[END #body]-->
		<?php get_sidebar(); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer(); ?>