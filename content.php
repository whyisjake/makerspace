<?php
/**
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
	<aside class="post-author">
		<a href="<?php echo bp_core_get_user_domain($post->post_author); ?>">
			<?php echo get_avatar(get_the_author_meta('ID'), '71'); ?>
			<?php printf(__('by %1$s', 'mentor_makerspace'), get_the_author_meta('display_name')); ?>
		</a>
	</aside>
	<section class="post-body">
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mentor_makerspace' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<?php if('post' == get_post_type()) : ?>
				<div class="entry-meta">
					<?php mms_post_meta(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if(is_search()) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'mentor_makerspace')); ?>
				<?php wp_link_pages(array('before' => '<div class="page-links">' . __('Pages:', 'mentor_makerspace'), 'after' => '</div>')); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</section><!--[END .post-body]-->
</article><!-- #post-<?php the_ID(); ?> -->
