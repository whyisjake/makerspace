<?php
/**
 * The template for displaying the footer.
 *
 * @package Mentor.Makerspace.com
 * @since Mentor.Makerspace.com 1.0
 */
?>

		<?php do_action('bp_after_container'); ?>
		<?php do_action('bp_before_footer'); ?>

		<!--[if lt IE 7 ]>
			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php do_action('bp_after_footer'); ?>
		
		<?php mms_ga_code(); ?>
		
		<?php do_action('bp_footer'); ?>
		<?php wp_footer(); ?>
	</body>
</html>