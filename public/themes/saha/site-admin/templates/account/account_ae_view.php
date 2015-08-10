

<div class="display_none" >
<h1><?php echo ( $this->uri->segment(3) == 'add' ? lang( 'account_add' ) : lang( 'account_edit' ) ); ?></h1>
	
<?php echo form_open_multipart(); ?> 
	<?php if ( isset( $form_status ) ) {echo $form_status;} ?> 
	
	<div class=" page-add-edit page-account-ae">
		<label><?php echo lang( 'account_username' ); ?>:<input type="text" name="account_username" value="<?php if ( isset( $account_username ) ) {echo $account_username;} ?>" maxlength="255"<?php if ( $this->uri->segment(3) == 'edit' ) {echo ' disabled="disabled"';} ?> /><span class="txt_require">*</span></label>
		<label><?php echo lang( 'account_email' ); ?>:<input type="text" name="account_email" value="<?php if ( isset( $account_email ) ) {echo $account_email;} ?>" maxlength="255" /><span class="txt_require">*</span></label>
		<label><?php echo lang( 'account_password' ); ?>:<input type="password" name="account_password" value="" maxlength="255" /><?php if ( $this->uri->segment(3) == 'add' ): ?><span class="txt_require">*</span><?php else: ?><span class="txt_comment"><?php echo lang( 'account_enter_current_if_change' ); ?></span><?php endif; ?></label>
		
		<?php if ( $this->uri->segment(3) == 'edit' ): ?> 
		<label><?php echo lang( 'account_new_password' ); ?>:<input type="password" name="account_new_password" value="" maxlength="255" /><span class="txt_comment"><?php echo lang( 'account_enter_if_change' ); ?></span></label>
		<?php endif; ?> 
		
		<?php if ( $this->config_model->load_single( 'allow_avatar' ) == '1' && $this->uri->segment(3) == 'edit' ): ?> 
		<label style="display:none" ><?php echo lang( 'account_avatar' ); ?>: 
			<?php if ( isset( $account_avatar ) && $account_avatar != null ): ?>
			<?php echo anchor( '#', lang( 'account_delete_avatar' ), array( 'onclick' => 'return ajax_delete_avatar()' ) ); ?> <span class="ajax_delete_avatar_result"></span><br />
			<div class="account-avatar-wrap">
				<img src="<?php echo $this->base_url.$account_avatar; ?>" alt="<?php echo lang( 'account_avatar' ); ?>" class="account-avatar account-avatar-edit" />
			</div>
			<?php endif; ?>
			<input type="file" name="account_avatar" /><br />
			<span class="txt_comment">&lt;= <?php echo $this->config_model->load_single( 'avatar_size' ); ?>KB. <?php echo str_replace( '|', ', ', $this->config_model->load_single( 'avatar_allowed_types' ) ); ?></span>
		</label>
		<?php endif; ?> 	
		
		<label style="display:none" ><?php echo lang( 'account_fullname' ); ?>:<input type="text" name="account_fullname" value="<?php if ( isset( $account_fullname ) ) {echo $account_fullname;} ?>" maxlength="255" /></label>
		<label style="display:none" ><?php echo lang( 'account_birthdate' ); ?>:<input type="text" name="account_birthdate" value="<?php if ( isset( $account_birthdate ) ) {echo $account_birthdate;} ?>" maxlength="10" /><span class="txt_comment"><?php echo lang( 'account_birthdate_format' ); ?></span></label>
		<?php /*<label><?php echo lang( 'account_signature' ); ?>:<textarea name="account_signature" cols="30" rows="5"><?php if ( isset( $account_signature ) ) {echo $account_signature;} ?></textarea></label>*/ // not use? ?>
		<label style="display:none" ><?php echo lang( 'account_timezone' ); ?>:<?php echo timezone_menu( (isset($account_timezone) ? $account_timezone : $this->config_model->load_single( 'site_timezone' )), '', 'account_timezone' ); ?></label>
		<label style="display:none" ><?php echo lang( 'account_level' ); ?>:
			<select name="level_group_id">
				<option></option>
				<?php if ( isset($list_level['items']) && is_array($list_level['items']) ): ?>
				<?php foreach ( $list_level['items'] as $key ): ?>
				<option value="<?php echo $key->level_group_id; ?>"<?php if( isset($level_group_id) && $level_group_id == $key->level_group_id ): ?> selected="selected"<?php endif; ?>><?php echo $key->level_name; ?></option>
				<?php endforeach; ?>
				<?php endif; ?>
			</select>
			<span class="txt_require">*</span>
		</label>
		<label style="display:none"><?php echo lang( 'account_status' ); ?>:
			<select name="account_status" id="account_status">
				<option value="1"<?php if ( isset($account_status) && $account_status == '1' ): ?> selected="selected"<?php endif; ?>><?php echo lang("account_enable"); ?></option>
				<option value="0"<?php if ( isset($account_status) && $account_status == '0' ): ?> selected="selected"<?php endif; ?>><?php echo lang("account_disable"); ?></option>
			</select>
			<span class="txt_require">*</span>
		</label>
		<label style="display:none" class="account_status_text"><?php echo lang( 'account_status_text' ); ?>:<input type="text" name="account_status_text" value="<?php if ( isset( $account_status_text ) ) {echo $account_status_text;} ?>" maxlength="255" /></label>
		<button type="submit" class="bb-button standard btn btn-primary"><?php echo lang( 'admin_save' ); ?></button>
	</div>
<?php echo form_close(); ?> 

</div>


































<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>
<?php echo $retVal = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXTRAS PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<h4><i class="icon-reorder"></i>Account setting</h4>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->

				<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
				<?php echo form_open( '', $attributes); ?>

				<div class="control-group display_none">
					<label class="control-label"><?php echo lang( 'account_username' ); ?></label>
					<div class="controls">
						<input name='account_username' type="text" value="<?php echo $account_username = ( ! empty( $account_username ) ) ? $account_username : '' ; ?>" class="span10 m-wrap" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo lang( 'Name' ); ?></label>
					<div class="controls">
						<input name='nickname' type="text" value="<?php echo $nickname = ( ! empty( $nickname ) ) ? $nickname : '' ; ?>" class="span10 m-wrap" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo lang( 'Username' ); ?></label>
					<div class="controls">
						<input name='account_email' type="email" value="<?php echo $account_email = ( ! empty( $account_email ) ) ? $account_email : '' ; ?>" class="span10 m-wrap" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo lang( 'Password' ); ?></label>
					<div class="controls">
						<input name='account_password' type="password" value="" class="span10 m-wrap" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo lang( 'Confirm Password' ); ?></label>
					<div class="controls">
						<input name='account_new_password' type="password" value="" class="span10 m-wrap" />
					</div>
				</div>



				<!-- IMAGE COVER -->
                <div class="control-group">
                    <label class="control-label">Logo </label>
                        <div class="controls">
                            <div class="upload_img_big">
                                
                                <?php if ( ! empty( $account_avatar ) ): ?>
                                    
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a>
                                                <img style="width: 10em; padding-bottom: 1em;" class="hover_image" src="<?php echo base_url( $account_avatar ) ?>" href="<?php echo base_url( $account_avatar ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $account_avatar ?>" name="logo_company_header">
                                    </div>

                                <?php endif ?>
                            </div>
                            <span data-url="<?php echo site_url( 'filemanager/image' ) ?>"  class="big_logo btn green fileinput-button">
                                <i class="icon-plus icon-white"></i>
                                <span>Add files image...</span>
                            </span>
                        </div>
                </div>
				<!-- END IMAGE COVER -->

				<div class="control-group">
					<label class="control-label"><?php echo lang( 'Position' ); ?></label>
					<div class="controls">

						<select name="level_group_id">
							<option></option>
							<?php if ( isset($list_level['items']) && is_array($list_level['items']) ): ?>
								<?php foreach ( $list_level['items'] as $key ): ?>
									<option value="<?php echo $key->level_group_id; ?>"<?php if( isset($level_group_id) && $level_group_id == $key->level_group_id ): ?> selected="selected"<?php endif; ?>><?php echo $key->level_name; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>	


					</div>
				</div>


				<div class="control-group">
					<label class="control-label"><?php echo lang( 'Status' ); ?></label>
					<div class="controls">
						<select name="account_status" id="account_status">
							<option value="1"<?php if ( isset($account_status) && $account_status == '1' ): ?> selected="selected"<?php endif; ?>><?php echo lang("account_enable"); ?></option>
							<option value="0"<?php if ( isset($account_status) && $account_status == '0' ): ?> selected="selected"<?php endif; ?>><?php echo lang("account_disable"); ?></option>
						</select>
					</div>
				</div>



				<div class="form-actions">
					<button type="submit" class="btn blue">Submit</button>
					<a class="btn" href="<?php echo site_url('site-admin/member/member_admin') ?>">Cancel</a>
				</div>

				<?php echo form_close(); ?>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXTRAS PORTLET-->
	</div>
</div>




<script type="text/javascript" >
	
$(function() {


    /**
    *
    * set delete all youtube url
    *
    **/
    $('.set_bin').live('click', function(event) {
        $(this).parent().remove();
    });
    // end delete all youtube url

	$('.big_logo').click(function(){

		set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

		set_open.target_object = $('.upload_img_big')

	})

	$('.upload_img_big').on( 'getFileCallback' , function( event , file ){

		console.log( file );

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img style="width: 10em; padding-bottom: 1em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="logo_company_header" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

	})



    /**
    *
    * Block comment file video cover 
    *
    **/
    $('.set_upload_file_video_cover').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_video_cover')

    })

    $('.upload_video_cover').on( 'getFileCallback' , function( event , file ){

        detail_video = '<div class="box_show_youtube box_show_video"><input type="hidden" name="file_video_cover" value="'+rawurlencode( file.path )+'" ><img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo site_url("popup") ?>?data_video='+rawurlencode( file.path )+'" alt="" src="<?php echo $this->theme_path ?>image/my_video.png"> <span class="video_name" >name video</span> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"><i></i>Remove</span><div style="clear: both;"></div></div>';

        $(this).html( detail_video );
        $('.video_name').html( file.name )


    } )

    // end file cover 




	$('.hover_video').fancybox({
		
			padding: 0,
			openEffect : 'elastic',
			openSpeed  : 150,
			scrolling : "no",
			closeEffect : 'elastic',
			closeSpeed  : 150,

	});

    $('.hover_image').fancybox({
        
            padding: 0,
            openEffect : 'elastic',
            openSpeed  : 150,
            scrolling : "no",
            closeEffect : 'elastic',
            closeSpeed  : 150,

    });

});   



</script>



































































<script type="text/javascript">
	$(document).ready(function() {
		$("input[name=account_birthdate]").datepicker({ 
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			yearRange: '1900:'+(new Date).getFullYear()
		});

		$("#account_status").change(function() {
			if ( $(this).val() == '0' ) {
				$(".account_status_text").show();
			} else {
				$(".account_status_text").hide();
			}
		});
		if ( $("#account_status").val() == '0' ) {
			$(".account_status_text").show();
		}
	});// jquery document ready

	<?php if ( $this->config_model->load_single( 'allow_avatar' ) == '1' && $this->uri->segment(3) == 'edit' ): ?> 
	function ajax_delete_avatar() {
		$confirm = confirm( '<?php echo lang( 'account_are_you_sure_delete_avatar' ); ?>' );
		
		// set loading status
		$('.ajax_delete_avatar_result').html('<img src="'+base_url+'public/themes/system/site-admin/images/loading.gif" alt="" />');
		
		if ( $confirm == true ) {
			$.ajax({
				url: site_url+'site-admin/account/delete_avatar',
				type: 'POST',
				data: csrf_name+'='+csrf_value+'&account_id=<?php echo $account_id; ?>',
				dataType: 'json',
				success: function( data ) {
					if ( data.result == true ) {
						$('.account-avatar-wrap').remove();
					}
					$('.ajax_delete_avatar_result').html('');
				},
				error: function( data, status, e ) {
					alert( e );
				}
			});
			return false;
		} else {
			return false;
		}
	}
	<?php endif; ?> 
</script>