jQuery(document).ready(function($) {

	/*** Image uploader ***/
	//run WordPress' media uploader inside of thickbox on our custom meta box for the slideshow
	function upload_image() {
		$('input[type=button].text-button').click(function() {
			formfield = $(this).prev().attr('id'); //get the id of the relevant input field
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true'); //load the media uploader in thickbo
			
			return false;
		});
	}
	
	upload_image();
	
	//add the name of the image back to the form field for the slideshow meta box
	window.send_to_editor = function(html) {
		imgurl = $('img', html).attr('src'); //get the url of the image uploaded
		
		$('input#' + formfield).val(imgurl); //add the imgurl value to the input value field
		tb_remove(); //remove thickbox
		
	}
	
	
	/*** Color Picker & Color Functionality ***/
	$('input.color-picker').ColorPicker({
		onShow: function(colpkr) {
			$(colpkr).slideDown(500);
			return false;
		},
		onHide: function(colpkr, hex) {
			$(colpkr).slideUp(500);
			$('.selected').next().css('backgroundColor', '#' + $(this).val(hex));
			$('.selected').removeClass();
			return false;
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$('.colorpicker').slideUp(500);
			$('.selected').next().find('.colorpicker-icon').css('backgroundColor', '#' + hex);
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	}).bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	}).click(function() {
		$(this).addClass('selected');
	});
	
	
	/*** Font Example ***/
	var selector = $('select#fw-font1');
	var value = selector.val(); //get the value of the dropdown when selected
	
	if(selector.length == 1) {
		selector.next().addClass(stripstring(value, false)); //add our class to the example font div
		
		//add the css styles and stylesheet we need to the head
		$('head').append('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' + stripstring(value, true) + '" type="text/css" media="all" class="google-font-set" />');
		$('head').append('<style type="text/css" class="google-font-set">.' + stripstring(value, false) + '{font-family:\'' + value + '\', sans-serif;</style>');
	}
	
	$('select#fw-font1').change(function() { //when the font is changed
		var value = $(this).val(); //get the value of the dropdown when selected
		
		$(this).next().removeClass().addClass(stripstring(value, false)); //add our class to the example font div
		
		$('link.google-font-set, style.google-font-set').each(function() { //remove any existing google stylesheets
			$(this).remove();
		});
		
		//add the css styles and stylesheet we need to the head
		$('head').append('<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' + stripstring(value, true) + '" type="text/css" media="all" class="google-font-set" />');
		$('head').append('<style type="text/css" class="google-font-set">.' + stripstring(value, false) + '{font-family:\'' + value + '\', sans-serif;</style>');
	});
	
	
	/*** Sliding Panels ***/
	$('.fw-wrap .panel > div.panel-body').hide().click(function(event) {
		event.stopPropagation();
	});
	
	$('.fw-wrap .panel').toggle(function() {
		$(this).addClass('open').find('div.panel-body').slideDown();
	}, function() {
		$(this).removeClass('open').find('div.panel-body').slideUp();
	});
	
	
	/*** Background Texture Selection ***/
	$('#options-column div.image-select').click(function() {
		var image = $(this).children().attr('title');
		
		//add or remove class
		$('#options-column div').removeClass('selected');
		$(this).toggleClass('selected');
		
		$('input#fw-background-image').val(image);
	});
	
	
	/*** Save our form options with Command+S ***/
	$(window).keypress(function(event) {
	    if(!(event.which == 115 && event.ctrlKey) && !(event.which == 19)) return true;
	    alert("Ctrl-S pressed");
	    event.preventDefault();
	    return false;
	});
	
	
	/*** Tooltips ***/
	var mouseX = 0;
	var mouseY = 0;
	$().mousemove( function(e) {
		mouseX = e.pageX; 
		mouseY = e.pageY;
	});
	 
	$(".jttip").hover(
		function () {
			id = $(this).attr('id');
			
			split = id.split('-', 2)
			number = split[1];
			
			clearTimeout(window['ta' + number]);
			$('#'+id).show();

			
		}, 
		function () {
			
			id = $(this).attr('id');
			$('#'+id).fadeOut('fast');
			
		}
	);
	 
	$(".jttip").each(function (i) {
		var prependjQueryjQueryi = 0;
		
		$("#jttrigger-"+i).hover(
	      function () {
			
			if(prependjQueryjQueryi == 0) {
				$("#jttip-"+i).prepend('<img class="nubbin" src="' + theme_url + '/images/tooltip.png" alt="arrow" height="13" width="27" border="0">');
				prependjQueryjQueryi = "done";
			}
			
			var triggerPos = $("#jttrigger-"+i).position();
			var jttipPos = $("#jttip-"+i).position();
			var triggerHeight = $("#jttrigger-"+i).height();
			var triggerWidth = $("#jttrigger-"+i).width();
			
	      	var jttipWidth = $("#jttip-"+i).width();
	      	
	      	var offsetX = triggerWidth-jttipWidth;
	      	
	      	$("#jttip-"+i).css('top',triggerPos.top+triggerHeight);
	      	
	      	if(offsetX > 0)
	      	{
	      		$("#jttip-"+i).css('left',triggerPos.left-(offsetX/2));
	      	}
	      	else
	      	{
	      		$("#jttip-"+i).css('left',triggerPos.left+(offsetX/2));
	      	}
	      	
	      	window['t' + i] = setTimeout(function() { $("#jttip-"+i).fadeIn('fast'); },300);
	      	
	        
	      }, 
	      function () {
				
				clearTimeout(window['t' + i]);

				if($("#jttip-"+i).css("display") == 'block')
				{
					window['ta' + i] = setTimeout(function() { $("#jttip-"+i).hide(); },300);
				}

	      });
	      
		});
});


/*** Functions ***/

/*****
 * Description: Remove special characters and whitespaces with dashes
 * Since: 0.1
 * Author: Cole Geissinger
/*****/
function stripstring(str, class_str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	
	if(class_str == false) {
		str = str.toLowerCase();
	}
	
	//remove accents, swap ñ for n, etc
	var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
	var to   = "aaaaeeeeiiiioooouuuunc------";
	
	for(var i = 0, l = from.length; i < l; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}

  	str = str.replace(/[^a-zA-Z0-9 -]/g, '') //remove invalid chars
      .replace(/\s+/g, '-') //collapse whitespace and replace with -
      .replace(/-+/g, '-'); //collapse dashes
	
	if(class_str) {
		str = str.replace('-', '+');
	}
	
	return str;
}