<?php

/**
 * Template Name: BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage Theme
 */
get_header('buddypress'); ?>
	<section id="content-header">
		<section class="wrapper">
			<h1><?php _e('Activity', 'makerspace') ?></h1>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<?php do_action('bp_before_directory_activity_page'); ?>
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<?php do_action('bg_before_directory_activity'); ?>
			<?php do_action('bg_before_director_activity_content'); ?>
			
			<?php if(is_user_logged_in()) : ?>
				<?php locate_template(array('activity/post-form.php'), true); ?>
			<?php endif; ?>
			
			<?php do_action('template_notices'); ?>
			
			<section class="item-list-tabs activity-type-tabs" role="navigation">
				<ul>
					<?php do_action('bp_before_activity_type_tab_all'); ?>
					
					<li class="selected" id="activity-all">
						<a href="<?php bp_activity_directory_permalink(); ?>" title="<?php _e('The public activity for everyone on this site.', 'makerspace'); ?>"><?php printf(__('All Members <span>%s</span>', 'makerspace'), bp_get_total_member_count()); ?></a>
					</li>
					
					<?php if(bp_is_active('groups')) : ?>
						<?php do_action('bp_before_activity_type_tab_friends'); ?>
						
						<?php if(bp_is_active('friends')) : ?>
							<?php if(bp_get_total_friend_count(bp_loggedin_user_id())) : ?>
								<li id="activity-friends"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" title="<?php _e('The activity of my friends only.', 'makerspace'); ?>"><?php printf(__('My Friends <span>%s</span>'. 'makerspace'), bp_get_total_friends_count(bp_loggedin_user_id())); ?></a></li>
							<?php endif; ?>
						<?php endif; ?>
						
						<?php do_action('bp_before_activity_type_tab_groups'); ?>
						
						<?php if(bp_is_active('groups')) : ?>
							<?php if(bp_get_total_group_count_for_user(bp_loggedin_user_id())) : ?>
								<li id="activity-groups"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" title="<?php _e('The activity of groups I am a member of.', 'makerspace'); ?>"><?php printf(__('My groups <span>%s</span>', 'makerspace'), bp_get_total_group_count_for_user(bp_loggedin_user_id())); ?></li>
							<?php endif; ?>
						<?php endif; ?>
						
						<?php do_action('bp_before_activity_type_tab_favorites'); ?>
						
						<?php if(bp_get_total_favorite_count_for_user(bp_loggedin_user_id())) : ?>
							<li id="activity-favorites"><a href="<?php echo bo_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" title="<?php _e('The activity I\'ve marked as a favorite.', 'makerspace'); ?>"><?php printf(__('My Favorites <span>%s</span>', 'makerspace'), bp_get_total_favorite_count_for_user(bp_loggedin_user_id())); ?></a></li>
						<?php endif; ?>
						
						<?php do_action('bp_before_activity_type_tab_mentions'); ?>
						
						<li id="activity-mentions"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>" title="<?php _e('Activity that I have been mentioned in.', 'makerspace'); ?>"><?php _e('Mentions', 'makerspace'); ?>
							<?php if(bp_get_total_mention_count_for_user(bp_loggedin_user_id())) : ?>
								<strong><?php printf(__('<span>%s</span>', 'makerspace'), bp_get_total_mention_count_for_user(bp_loggedin_user_id())); ?></strong>
							<?php endif; ?>
						</a></li>
						
					<?php endif; ?>
					
					<?php do_action('bp_activity_type_tabs'); ?>
				</ul>
			</section><!--[.item-list-tabs.activity-type-tabs]-->
			<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
				<ul>
					<li class="feed"><a href="<?php bp_sitewide_activity_feed_link(); ?>" title="<?php _e( 'RSS Feed', 'makerspace' ); ?>"><?php _e( 'RSS', 'makerspace' ); ?></a></li>

					<?php do_action( 'bp_activity_syndication_options' ); ?>

					<li id="activity-filter-select" class="last">
						<label for="activity-filter-by"><?php _e( 'Show:', 'makerspace' ); ?></label>
						<select id="activity-filter-by">
							<option value="-1"><?php _e( 'Everything', 'makerspace' ); ?></option>
							<option value="activity_update"><?php _e( 'Updates', 'makerspace' ); ?></option>

							<?php if ( bp_is_active( 'blogs' ) ) : ?>
								<option value="new_blog_post"><?php _e( 'Posts', 'makerspace' ); ?></option>
								<option value="new_blog_comment"><?php _e( 'Comments', 'makerspace' ); ?></option>
							<?php endif; ?>

							<?php if ( bp_is_active( 'forums' ) ) : ?>
								<option value="new_forum_topic"><?php _e( 'Forum Topics', 'makerspace' ); ?></option>
								<option value="new_forum_post"><?php _e( 'Forum Replies', 'makerspace' ); ?></option>
							<?php endif; ?>

							<?php if ( bp_is_active( 'groups' ) ) : ?>
								<option value="created_group"><?php _e( 'New Groups', 'makerspace' ); ?></option>
								<option value="joined_group"><?php _e( 'Group Memberships', 'makerspace' ); ?></option>
							<?php endif; ?>

							<?php if ( bp_is_active( 'friends' ) ) : ?>
								<option value="friendship_accepted,friendship_created"><?php _e( 'Friendships', 'makerspace' ); ?></option>
							<?php endif; ?>

							<option value="new_member"><?php _e( 'New Members', 'makerspace' ); ?></option>

							<?php do_action( 'bp_activity_filter_options' ); ?>
						</select>
					</li>
				</ul>
			</div><!-- .item-list-tabs -->

			<?php do_action( 'bp_before_directory_activity_list' ); ?>

			<div class="activity" role="main">
				<?php locate_template( array( 'activity/activity-loop.php' ), true ); ?>
			</div><!-- .activity -->

			<?php do_action( 'bp_after_directory_activity_list' ); ?>
			<?php do_action( 'bp_directory_activity_content' ); ?>
			<?php do_action( 'bp_after_directory_activity_content' ); ?>
			<?php do_action( 'bp_after_directory_activity' ); ?>
		</section><!--[END #body]-->
		<?php get_sidebar('buddypress'); ?>
	</section><!--[END #body-wrapper]-->
	<?php do_action( 'bp_after_directory_activity_page' ); ?>
<?php get_footer('buddypress'); ?>
