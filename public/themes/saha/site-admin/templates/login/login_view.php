<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Backoffice System login</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="<?php echo $this->theme_path; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link rel=stylesheet href="<?php echo $this->theme_path; ?>assets/fancybox/source/jquery.fancybox.css">
	<link href="<?php echo $this->theme_path; ?>assets/css/metro.css" rel="stylesheet" />
	<link href="<?php echo $this->theme_path; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?php echo $this->theme_path; ?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo $this->theme_path; ?>assets/css/style_responsive.css" rel="stylesheet" />
	<link href="<?php echo $this->theme_path; ?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/uniform/css/uniform.default.css" />
	<script type="text/javascript">
		// declare variable for use in .js file
		var base_url = '<?php echo $this->base_url; ?>';
		var site_url = '<?php echo site_url(); ?>/';
		<?php //if ( config_item( 'csrf_protection' ) == true ): ?> 
		var csrf_name = '<?php echo config_item( 'csrf_token_name' ); ?>';
		var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
		<?php //endif; ?> 
	</script>


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="<?php echo $this->theme_path ?>public/img/logorsu.jpg" alt="">
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<?php echo form_open( current_url().( isset( $go_to ) ? '?rdr='.$go_to : '' ), array( 'onsubmit' => 'return ajax_admin_login($(this));' ) ); ?> 
		<h3 class="form-title">Login to your account</h3>
		<div class="hide set_error"></div>
		<div class="control-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="controls">
				<div class="input-icon left">
					<i class="icon-user"></i>
					<input class="m-wrap placeholder-no-fix" autocomplete='off' type="text" placeholder="Username" name="username" autofocus />
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="controls">
				<div class="input-icon left">
					<i class="icon-lock"></i>
					<input class="m-wrap placeholder-no-fix" type="password" placeholder="Password" name="password"/>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<label class="btn green pull-left fancybox fancybox.iframe" href="<?php echo site_url( 'member/view_forgetpassword' ) ?>" >
				Forget Password
			</label>
			<button type="submit" class="btn green pull-right login-button">
				Login <i class="m-icon-swapright m-icon-white"></i>
			</button>            
		</div>

		<?php echo form_close(); ?> 
		<?php echo $this->modules_plug->do_action( 'admin_login_page' ); ?>
		<!-- END LOGIN FORM -->        


	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		2015 &copy; , Mr.Cherdpong All Rights Reserved.
	</div>
	<!-- END COPYRIGHT -->
	<!-- BEGIN JAVASCRIPTS -->
	<script src="<?php echo $this->theme_path; ?>assets/js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo $this->theme_path; ?>assets/bootstrap/js/bootstrap.min.js"></script>  
	<script src="<?php echo $this->theme_path; ?>assets/uniform/jquery.uniform.min.js"></script> 
	<script src="<?php echo $this->theme_path; ?>assets/js/jquery.blockui.js"></script>
	<script src="<?php echo $this->theme_path; ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo $this->theme_path; ?>assets/fancybox/source/jquery.fancybox.js"></script>
	<script src="<?php echo $this->theme_path; ?>assets/js/app.js"></script>

	<script>
		jQuery(document).ready(function() {     
			App.initLogin();
			$('.fancybox').fancybox({
  //     	maxWidth	: 300,
  width 	: 500,

});
		});

		function ajax_admin_login( thisobj ) {
			var serialize_val = thisobj.serialize();

			
			
		// disable submit button.
		$( '.login-button' ).attr( 'disabled', 'disabled' );
		

		// set loading status
		$('.ajax_status').html('<img src="'+base_url+'public/themes/system/site-admin/images/loading.gif" alt="" />');
		
		$.ajax({
			url: thisobj.attr('action'),
			type: 'POST',
			data: serialize_val,
			dataType: 'json',
			success: function( data ) {
				if ( data.form_status === true ) {
					window.location = data.go_to;
				} else {
					$( '.login-button' ).removeAttr( 'disabled' );
					$( '.ajax_status' ).html( '' );
					$( '.form-status' ).html(data.form_status);
					
					$('.captcha').attr( 'src', base_url+'public/images/securimage_show.php?' + Math.random() );
					$('.login-username').focus();
					if ( data.show_captcha == true ) {
						$('.captcha-field').show( 'fade', {}, 'fast' );
					} else {
						$('.captcha-field').hide( 'fade', {}, 'fast' );
					}

					$('.set_error').html(data.form_status).show();

				}
			},
			error: function( data, status, e ) {
				alert( 'Login error '+e );
				$( '.login-button' ).removeAttr( 'disabled' );
			}
		});
		return false;
	}// ajax_admin_login


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>






