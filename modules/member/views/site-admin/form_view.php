
<?php echo $error_validation = ( ! empty( $error_validation ) ) ? $error_validation : '' ; ?>

<div class="row-fluid">
   <div class="span12">
	  <!-- BEGIN EXTRAS PORTLET-->
	  <div class="portlet box blue">
		 <div class="portlet-title">
			<h4><i class="icon-reorder"></i>Detail in member</h4>
		 </div>
		 <div class="portlet-body form">
			<!-- BEGIN FORM-->
			
            <?php $attributes = array( 'class' => 'form-horizontal' ); ?>
			<?php echo form_open( '', $attributes); ?>


                <!-- IMAGE COVER UPLOAD -->
                <div class="control-group user_cover_image">
                    <label class="control-label">Cover image upload</label>
                    <div class="controls">
                        <div class="upload_img_cover">

                            <?php if ( ! empty( $show_data['account_avatar'] ) ): ?>

                                <div class="main_c">
                                    <div class="tn_c">
                                        <a>
                                            <img src="<?php echo base_url( $show_data['account_avatar'] ) ?>" alt="" title="" style="max-width: 13em;" >
                                        </a>
                                    </div>
                                    <input type="hidden" value="<?php echo $show_data['account_avatar'] ?>" name="account_avatar">
                                </div>

                            <?php endif ?>

                        </div>
                        <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file_cover btn green fileinput-button">
                            <i class="icon-plus icon-white"></i>
                            <span>Add files...</span>
                        </span>
                        <span>ขนาดที่แนะนำ 250x250</span>
                    </div>
                </div>


			   <div class="control-group">
				  <label class="control-label">Name LastName</label>
				  <div class="controls">
				 		<input name='account_fullname' type="text" value="<?php echo $name = ( ! empty( $show_data['account_fullname'] ) ) ? $show_data['account_fullname'] : '' ; ?>" class="span6 m-wrap" />
				  </div>
			   </div>

				<div class="control-group">
					<label class="control-label">Birthdate</label>
					<div class="controls">
						<div class="input-append date form_datetime">
							<input name="account_birthdate" size="16" type="text" value="<?php echo $retVal = ( ! empty( $show_data['account_birthdate'] ) ) ? $show_data['account_birthdate'] : '' ; ?>" readonly class="m-wrap set-date">
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>				

				<div class="control-group">
					<label class="control-label">Gender</label>
					<div class="controls">
						<?php $show_data['gender'] = ( ! empty( $show_data['gender'] ) ) ? $show_data['gender'] : 1 ; ?>
						<label class="radio">
							<div class="radio"><span><input type="radio" <?php echo $retVal = ( $show_data['gender'] == 1 ) ? 'checked=""' : '' ; ?> value="1" name="gender"></span></div>
							Male
						</label>
						<label class="radio">
							<div class="radio"><span><input type="radio" <?php echo $retVal = ( $show_data['gender'] == 2 ) ? 'checked=""' : '' ; ?> value="2" name="gender"></span></div>
							Female
						</label>  
					</div>
				</div>

			   <div class="control-group">
				  <label class="control-label">E-mail</label>
				  <div class="controls">
					  	<input name='account_email' type="text" value="<?php echo $account_email = ( ! empty( $show_data['account_email'] ) ) ? $show_data['account_email'] : '' ; ?>" class="span6 m-wrap" />
				  </div>
			   </div>

			   <div class="control-group">
				  <label class="control-label">Password</label>
				  <div class="controls">
					  	<input name='account_password' type="password" value="" class="span6 m-wrap" />
				  </div>
			   </div>

			   <?php if ( ! empty( $member_add ) ): ?>
			   	<div class="control-group">
			   		<label class="control-label">Password Confirm</label>
			   		<div class="controls">
			   			<input name='account_password_confirm' type="password" value="" class="span6 m-wrap" />
			   		</div>
			   	</div>
			   <?php endif ?>

			   <div class="control-group">
				  <label class="control-label">Penname</label>
				  <div class="controls">
					  	<input name='nickname' type="text" value="<?php echo $nickname = ( ! empty( $show_data['nickname'] ) ) ? $show_data['nickname'] : '' ; ?>" class="span6 m-wrap" />
				  </div>
			   </div>
			

				<div class="control-group">
				    <label class="control-label">Status</label>
				    <div class="controls">
				        <div class="basic-toggle-button">
				            <input name="account_status" type="checkbox" class="toggle" <?php echo $account_status = ( ! empty( $show_data['account_status'] ) ) ? 'checked="checked"' : '' ; ?> value="1" />
				        </div>
				    </div>
				</div>
				

			   <div class="form-actions">
				  <button type="submit" class="btn blue">Submit</button>
                  <a class="btn" href="<?php echo site_url('site-admin/member') ?>">Cancel</a>
			   </div>
			<?php echo form_close(); ?>
			<!-- END FORM-->
		 </div>
	  </div>
	  <!-- END EXTRAS PORTLET-->
   </div>
</div>


<script>
	
$(document).ready(function() {
	

	$(".set-date").datepicker({ 
		dateFormat: 'dd/mm/yy' 
	});

    /**
    *
    * Block comment file cover 
    *
    **/
    $('.set_upload_file_cover').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_cover')

    })

    $('.upload_img_cover').on( 'getFileCallback' , function( event , file ){

    	console.log(event);

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="account_avatar" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // end file cover 


});


</script>














