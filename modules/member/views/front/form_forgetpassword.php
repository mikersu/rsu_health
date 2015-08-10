<!DOCTYPE html>
<html>
<head>
	<script src="<?php echo $this->theme_path; ?>js/jquery-1.7.2.min.js"></script>

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
<body>

<div style="color: #817f7f;" >

	<p>กรุณาใส่อีเมล์ที่ต้องการ reset password</p>
	<span>E-mail</span>
	<input type="email" name="email" class="email" placeholder="example@example.com" >
	<button type="" class="btn-resetpass" >ขอรหัสผ่านใหม่</button>
	
</div>

<script>
	
$('.btn-resetpass').click(function(event) {
	$('.btn-resetpass').attr('disabled', 'disabled').text( 'กรุณารอสักครู ระบบกำลังทำงาน' );



	var mail = $('.email').val();
	$.ajax({
	    url: '<?php echo site_url( "member/forgetpassword" ) ?>' ,
	    type: "POST" ,
	    dataType: "json",
	    data: csrf_name+'='+csrf_value+'&email='+mail ,
	    success: function( data ) 
	    { 
			if ( data.error == 1 ) {
				alert( data.text );
				$('.btn-resetpass').removeAttr('disabled').text( 'ขอรหัสผ่านใหม่' );
			}else{
				alert( data.text );
				parent.$.fancybox.close();
			}
	    }
	});

});


</script>



</body>
</html>