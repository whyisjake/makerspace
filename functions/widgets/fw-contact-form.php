<?php class mms_contact_form_widget extends WP_Widget {
	
		function mms_contact_form_widget() {
			$widget_ops = array('classname' => 'mms-contact-form-widget', 'description' => 'Displays a contact form');
			$this->WP_Widget('mms_contact_form_widget', 'Contact Form', $widget_ops);
		}
 
 
		function form($instance) {
		    $instance = wp_parse_args(
		    	(array) $instance, 
		    	array(
		    		'widget-to' => 'Request An Appointment',
		    		'email-from' => '',
		    		'email-subject' => '',
		    		'email-to' => '',
		    		'email-cc' => ''
		    	)
		    );
		    
		    $widget_title = $instance['widget-title'];
		    $email_from = $instance['email-from'];
		    $email_subject = $instance['email-subject'];
		    $email_to = $instance['email-to'];
		    $email_cc = $instance['email-cc']; ?>
			
			<p><label for="<?php echo $this->get_field_name('widget-title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_name('widget-titlet'); ?>" name="<?php echo $this->get_field_name('widget-title'); ?>" type="text" value="<?php echo urldecode($widget_title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_name('email-from'); ?>">From Address: <input class="widefat" id="<?php echo $this->get_field_name('email-from'); ?>" name="<?php echo $this->get_field_name('email-from'); ?>" type="text" value="<?php echo urldecode($email_from); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_name('email-subject'); ?>">Subject: <input class="widefat" id="<?php echo $this->get_field_name('email-subject'); ?>" name="<?php echo $this->get_field_name('email-subject'); ?>" type="text" value="<?php echo urldecode($email_subject); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_name('email-to'); ?>">Email To: <input class="widefat" id="<?php echo $this->get_field_name('email-to'); ?>" name="<?php echo $this->get_field_name('email-to'); ?>" type="text" value="<?php echo urldecode($email_to); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_name('email-cc'); ?>">CC Email: <input class="widefat" id="<?php echo $this->get_field_name('email-cc'); ?>" name="<?php echo $this->get_field_name('email-cc'); ?>" type="text" value="<?php echo urldecode($email_cc); ?>" /></label></p>
			
			
		<?php }
		
		
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['widget-title'] = htmlspecialchars($new_instance['widget-title']);
			$instance['email-from'] = htmlspecialchars($new_instance['email-from']);
			$instance['email-subject'] = htmlspecialchars($new_instance['email-subject']);
			$instance['email-to'] = htmlspecialchars($new_instance['email-to']);
			$instance['email-cc'] = htmlspecialchars($new_instance['email-cc']);
			return $instance;
		}
		
		
		function widget($args, $instance) {
			extract($args, EXTR_SKIP);
			
			echo $before_widget;
			
			$widget_title = empty($instance['widget-title']) ? '' : $instance['widget-title'];
			$email_from = empty($instance['email-from']) ? '' : $instance['email-from'];
			$email_subject = empty($instance['email-subject']) ? '' : $instance['email-subject'];
			$email_to = empty($instance['email-to']) ? '' : $instance['email-to'];
			$email_cc = empty($instance['email-cc']) ? '' : $instance['email-cc'];
			
			if(!empty($email_to)) : ?>
				<h3>Request An Appointment</h3>
    			<form action="#" id="contact-form" method="post">
					<ol class="contact-form reset-list">
						<li>Preferred Method of Contact &nbsp; <input type="radio" name="contact-by" value="phone" id="contact-phone" /> Phone &nbsp; <input type="radio" name="contact-by" value="email" id="contact-email" /> Email</li>
						<li><input type="email" name="email" id="email" value="" placeholder="YourEmail@YourDomainName.com" class="txt requiredField email" /></li>
						<li><input type="text" name="name" id="name" value="" placeholder="First Name &amp; Last Name" class="txt requiredField name" /></li>
						<li><input type="text" name="country" id="country" value="" placeholder="Country of Primary Residence" class="txt country" /></li>
						<li class="state-field"><input type="text" name="state" id="state" value="" placeholder="State" class="text state" /></li>
						<li class="phone-field"><input type="tel" name="phone" id="phone" value="" placeholder="Telephone Number" class="txt requiredField phone" /></li>
						<li class="textarea"><textarea name="message" id="comments" placeholder="Comments" class="txt message"></textarea></li>
						<li class="buttons"><span class="send_but"><input type="hidden" name="submitted" id="submitted" value="true" /><input class="submit" type="submit" value="Send" /></span></li>
						<input type="hidden" id="contact-submit" name="contact-form-submitted" value="true" />
					</ol>
				</form>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						
						var contact = $("input[@name=contact-by]:checked").val();
						var email = $('#email').val();
						var name = $('#name').val();
						var country = $('#country').val();
						var state = $('#state').val();
						var phone = $('#phone').val();
						var message = $('#comments').val();
						var submit = $('#contact-submit').val();
						
						//test if the placeholder attribute is supported
						function testAttribute(element, attribute) {
							var test = document.createElement(element);
							if(attribute in test) {
						    	return true;
						  	} else {
						    	return false;
						    }
						}
						
						if(!testAttribute('input', 'placeholder')) {
							window.onload = function() {
								//add a value if the field is empty
								if(email == '') { $('#email').val('YourEmail@YourDomainName.com'); }
								if(name == '') { $('#name').val('First Name & Last Name'); }
								if(country == '') { $('#country').val('Country of Primary Residence'); }
								if(state == '') { $('#state').val('State'); }
								if(phone == '') { $('#phone').val('Telephone Number'); }
								if(message == '') { $('#comments').val('Comments'); }
								
								//email
								$('#email').focus(function() {
									var val = $(this).val();
									if(val == 'YourEmail@YourDomainName.com') {	$(this).val(''); }
								});
								$('#email').blur(function() {
									var val = $(this).val();
									if(val == '') {	$(this).val('YourEmail@YourDomainName.com'); }
								});
								
								//name
								$('#name').focus(function() {
									var val = $(this).val();	
									if(val == 'First Name & Last Name') { $(this).val(''); }
								});
								$('#name').blur(function() {
									var val = $(this).val();	
									if(val == '') { $(this).val('First Name & Last Name'); }
								});
								
								//country
								$('#country').focus(function() {
									var val = $(this).val();
									if(val == 'Country of Primary Residence') { $(this).val(''); }
								});
								$('#country').blur(function() {
									var val = $(this).val();
									if(val == '') { $(this).val('Country of Primary Residence'); }
								});
								
								//state
								$('#state').focus(function() {
									var val = $(this).val();
									if(val == 'State') { $(this).val(''); }
								});
								$('#state').blur(function() {
									var val = $(this).val();
									if(val == '') { $(this).val('State'); }
								});
								
								//phone
								$('#phone').focus(function() {
									var val = $(this).val();
									if(val == 'Telephone Number') { $(this).val(''); }
								});
								$('#phone').blur(function() {
									var val = $(this).val();
									if(val == '') { $(this).val('Telephone Number'); }
								});
								
								//comments
								$('#comments').focus(function() {
									var val = $(this).val();
									if(val == 'Comments') { $(this).val(''); }
								});
								$('#comments').blur(function() {
									var val = $(this).val();
									if(val == '') { $(this).val('Comments'); }
								});
							}
						}

						
						var send_to = '<?php echo $email_to; ?>';
						
						if(send_to == '') {
							$('input.submit').attr('disabled', 'disabled').css({'border-color':'#ddd', 'color':'#ddd', 'cursor':'default'});
							$('#contact-form').prepend('<p class="error"><em>Please enter an email address in the admin.</em></p>');
						}
						
						//validate the form has been filled out before sending email
						$('#contact-form').submit(function(event) {
							var contact = $("input[name=contact-by]:checked").val();
							var email = $('#email').val();
							var name = $('#name').val();
							var country = $('#country').val();
							var state = $('#state').val();
							var phone = $('#phone').val();
							var message = $('#comments').val();
							var submit = $('#contact-submit').val();
							
							//remove any messages
							$('p.error').slideUp();
							
							//stop the form from submitting normally
							event.preventDefault();
							
							$('input.inputError, textarea.inputError').removeClass('inputError');
		
							var hasError = false;
							
							$('.requiredField').each(function() {
								if(jQuery.trim(jQuery(this).val()) == '' || jQuery.trim(jQuery(this).val()) == 'First Name & Last Name') {
									var labelText = jQuery(this).prev('label').text();
							
									jQuery(this).addClass('inputError');
									hasError = true;
								} else if(jQuery(this).hasClass('email')) {
									var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
									if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
										jQuery(this).addClass('inputError');
										hasError = true;
									}
								}
							});
							
							if(!hasError) {
								$.ajax({
									url: '<?php echo get_stylesheet_directory_uri(); ?>/functions/widgets/contact-form-send.php',
									type: 'post',
									data: {contact:contact, email:email, name:name, country:country, state:state, phone:phone, message:message, contact_form_submit:submit, page:'http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>', sendto:'<?php echo $email_to; ?>', sendfrom:'<?php echo $email_from; ?>', sendcc:'<?php echo $email_cc; ?>', subject:'<?php echo $email_subject; ?>'},
									success: function() {
										$('#contact-form p.error').slideUp();
										$('#contact-form').prepend('<p class="successful"><em>Message successfully sent.</em></p>');
										$('p.successful').delay('5000').slideUp();
									},
									error: function(thrownError) { 
										$('#contact-form').prepend('<p class="error"><em>An Error occurred! Please try again.</em></p>'); 
									}
								});
							}
						});
					});
				</script>
			<?php else : ?>
				<h2>Please enter an address to email to!</h2>
			<?php endif; 
			
			echo $after_widget;
		}
		
 	}
	add_action('widgets_init', create_function('', 'return register_widget("mms_contact_form_widget");'));