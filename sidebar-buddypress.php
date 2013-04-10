<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
?>
		<div id="sidebar" class="widget-area group" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if(!dynamic_sidebar('sidebar')) : endif; // end sidebar widget area ?>
			
			<aside id="sub-navigation" class="widget sub-navigation">
				<h3>Categories</h3>
				<ul class="reset-list">
					<?php //get our top 4 categories. The categories with the most posts will display
						$categories = get_categories('orderby=count&order=desc&hierarchical=0&number=4&pad_counts=1');
						foreach($categories as $category) {
							//echo '<pre>'; print_r($category); echo '</pre>';
							echo '<li><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a></li>';
						}
					?>
					<li><a href="<?php echo get_permalink(1776); //get_permalink(41); ?>" style="text-decoration:underline;">See All</a></li>
				</ul>
				
				<h3>Pages</h3>
				<ul class="reset-list">
					<?php //get our top 4 categories. The categories with the most posts will display
						$pages = wp_get_recent_posts('numberposts=4&post_type=page&post_status=publish&order=ASC');
						foreach($pages as $page) {
							//echo '<pre>'; print_r($page); echo '</pre>';
							echo '<li><a href="' . get_permalink($page['ID']) . '">' . $page['post_title'] . '</a></li>';
						}
					?>
					<!--<li><a href="<?php get_permalink(43) ?>" style="text-decoration:underline;">See All</a></li>-->
				</ul>
				
				<h3>posts</h3>
				<ul class="reset-list last">
					<?php //get our top 4 categories. The categories with the most posts will display
						$posts = wp_get_recent_posts('numberposts=4&post_type=post&post_status=published');
						foreach($posts as $post) {
							//echo '<pre>'; print_r($page); echo '</pre>';
							echo '<li><a href="' . get_permalink($post['ID']) . '">' . $post['post_title'] . '</a></li>';
						}
					?>
					<li><a href="<?php home_url(); ?>" style="text-decoration:underline;">See All</a></li>
				</ul>
			</aside>
		</div><!-- #secondary .widget-area -->
