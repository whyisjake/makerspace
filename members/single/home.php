<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */
get_header('buddypress'); ?>
	<section id="content-header">
		<section class="wrapper">
			<?php if(bp_is_member()) : ?>
				<aside id="profile-data" class="group">
					<div id="user-avatar">
						<?php bp_displayed_user_avatar('width=125&height=125'); ?>
					</div><!--[END #user-avatar]-->
					<div id="user-meta">
						<h1><a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a></h1>
						<span class="user-nicename">@<?php bp_displayed_user_username(); ?></span>
						<span class="activity"><?php bp_last_activity( bp_displayed_user_id() ); ?></span>
					</div><!--[END #user-meta]-->
				</div><!--[END #profile-data]-->
			<?php else : ?>
				<h1><?php wp_title('', true); ?></h1>
			<?php endif; ?>
		</section><!--[END .wrapper]-->
	</section><!--[END #slider]-->
	<section id="body-wrapper" class="wrapper group">
		<section id="body">
			<?php do_action( 'bp_before_member_home_content' ); ?>

			<div id="item-header" role="complementary">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div><!-- #item-nav -->

			<div id="item-body">

				<?php do_action( 'bp_before_member_body' );

				if ( bp_is_user_activity() || !bp_current_component() ) :
					locate_template( array( 'members/single/activity.php'  ), true );

				 elseif ( bp_is_user_blogs() ) :
					locate_template( array( 'members/single/blogs.php'     ), true );

				elseif ( bp_is_user_friends() ) :
					locate_template( array( 'members/single/friends.php'   ), true );

				elseif ( bp_is_user_groups() ) :
					locate_template( array( 'members/single/groups.php'    ), true );

				elseif ( bp_is_user_messages() ) :
					locate_template( array( 'members/single/messages.php'  ), true );

				elseif ( bp_is_user_profile() ) :
					locate_template( array( 'members/single/profile.php'   ), true );

				elseif ( bp_is_user_forums() ) :
					locate_template( array( 'members/single/forums.php'    ), true );

				elseif ( bp_is_user_settings() ) :
					locate_template( array( 'members/single/settings.php'  ), true );

				// If nothing sticks, load a generic template
				else :
					locate_template( array( 'members/single/plugins.php'   ), true );

				endif;

				do_action( 'bp_after_member_body' ); ?>

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ); ?>
		</section><!--[END #body]-->
		<?php get_sidebar('buddypress'); ?>
	</section><!--[END #body-wrapper]-->
<?php get_footer('buddypress'); ?>
