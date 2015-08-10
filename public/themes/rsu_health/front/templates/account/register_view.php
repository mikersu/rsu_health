<div class="content">
	<div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="javascript:void(0)">Member</a></li>
            <li class="active"><a href="javascript:void(0)">Register</a></li>
        </ol>
        <h1 class="page__header">
        	<span>Mem</span>ber
        </h1>
        <div class="wrap__content bg--factory">
        	<div class="account">
            	<div class="account__detail">
                    <h1 class="account__detail--topic">Register</h1>
                    <div class="account__detail--sub">Advanced Power Equipment (Thailand) Co.,Ltd</div>
                	

                    <?php 
                    $attributes = array('class' => 'email', 'id' => 'myform');
                    echo form_open_multipart('', $attributes);
                    ?>

                    <?php echo $error = ( !empty($error) ) ? $error : '' ; ?>   
                    <?php echo $retVal = ( ! empty( $form_status ) ) ? $form_status : '' ; ?> 
                    <div class="form over_input">
                    	<div class="form-group">
                        	<div class="wrap--label">&nbsp;</div>
                            <div class="wrap--input">
                            	<div class="account__detail--profile">
                                    <img class="show_image" style="width:137px" src="<?php echo $retVal = ( ! empty( $show_data['image'] ) ) ? base_url().$show_data['image'] : $this->theme_path.'images/upload/webboard/avatar.jpg' ; ?>"/>
                                </div>
                            </div>
                        </div>

                    	<div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Select Image') ?> :</label></div>
                            <div class="wrap--input">
                            	<div class="upload_file">
                                    <div>
                                    	<span class="file_name">......</span>
                                        <input type="hidden" class="value_image" name="image" value="<?php echo $retVal = ( ! empty( $show_data['image'] ) ) ? $show_data['image'] : '' ; ?>">
                                        <input type="button" class="btn btn_black sizeL" id="ajxiupload" value="BROWSE" >
                                        <p class="status_post" ></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Name LastName') ?> :</label></div>
                            <div class="wrap--input"><input type="text" name="name_lastname" value="<?php echo $retVal = ( ! empty( $show_data['name_lastname'] ) ) ? $show_data['name_lastname'] : '' ; ?>" ></div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Birthdate') ?> :</label></div>
                            <div class="wrap--input">
                            	<input type="text" name="birthdate" value="<?php echo $retVal = ( ! empty( $show_data['birthdate'] ) ) ? $show_data['birthdate'] : '' ; ?>" id="datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Gender') ?> :</label></div>
                            <div class="wrap--input">
                            	<div class="wrap--radio">
                                	<input value="1" type="radio" checked id="radio-1-1" name="gender" 
                                    class="regular-radio" />
                                    <label class="input" for="radio-1-1"></label>
                                    <?php echo lang_get('Man') ?>
                                </div>
                                <div class="wrap--radio">
                                	<input value="2" type="radio" id="radio-1-2" name="gender"
                                    class="regular-radio" />
                                    <label class="input" for="radio-1-2"></label>
                                    <?php echo lang_get('Woman') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('E-mail') ?> :</label></div>
                            <div class="wrap--input"><input name="email" value="<?php echo $retVal = ( ! empty( $show_data['email'] ) ) ? $show_data['email'] : '' ; ?>" type="text" ></div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Password') ?> :</label></div>
                            <div class="wrap--input"><input name="password" type="password" value=""></div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Confirm Password') ?> :</label></div>
                            <div class="wrap--input"><input name="c_password" type="password" value=""></div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('NickName') ?> :</label></div>
                            <div class="wrap--input"><input name="nickname" type="text" value="<?php echo $retVal = ( ! empty( $show_data['nickname'] ) ) ? $show_data['nickname'] : '' ; ?>"></div>
                        </div>
                        <div class="form-group">
                        	<div class="wrap--label"><label><?php echo lang_get('Condition') ?> :</label></div>
                            <div class="wrap--input">
                            	<textarea disabled><?php echo $retVal = ( ! empty( $member_privacy_policy ) ) ? $member_privacy_policy : '' ; ?></textarea>
                                <p><input type="checkbox" name="checkbox" value="1"> <label><?php echo lang_get('Acceptance') ?></label> </p>
                                <div class="wrap--btn">
                                	<a class="btn-gray"  href="<?php echo current_url() ?>"><?php echo lang_get('Reset') ?></a>
                                	<button class="btn-gray" style="padding: 0;border: none;" type=""><?php echo lang_get('Confirm') ?></button>
                                </div>
                            </div>
                        </div>	
                    </div>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<script>

  // jQuery(document).ready(function($) {

  //   $("#datepicker").datepicker( { dateFormat: 'dd/mm/yy' } );

  
  //   // Set fieldname
  //   $.ajaxUploadSettings.name = 'uploadfile';
  //   // Set promptzone
  //   $('#upload_img').ajaxUploadPrompt({
  //       url : '<?php echo base_url() ?>upload.php',
  //       error : function () 
  //       {
  //           alert( 'upload error please try again' )
  //       },
  //       onprogress  : function()
  //       {
  //           $('.wait_loader').show();
  //       },
  //       success : function (data) 
  //       {
  //           $('.wait_loader').hide();
  //           if (data == '' ) { 
  //               alert( 'Upload is error, Please try again' )
  //               return false;
  //           };

  //           // console.log(data);
  //           data = JSON.parse( data );
  //           $('.file_name').html( data.name_img )
  //           $('.value_image').val( data.name_filemid );
  //           $('.show_image').attr('src',  '<?php echo base_url() ?>'+data.name_filemid );


  //       }
  //   });
    
  // });

</script>


<script>
    $(document).ready(function(){

        var status_post = $('.status_post');
        var button = $('#ajxiupload'), interval;
        new AjaxUpload(button,{
            action: '<?php echo base_url() ?>upload.php',
            data : {
                'extra_info' : 'some extra info',
                'sample' : 2,
            },
            name: 'uploadfile',
            onSubmit : function(file, ext){
                
                 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
                    status_post.text('Only pdf, JPG, PNG or GIF files are allowed');
                    return false;
                }else{
                    status_post.text('');
                    $('.loading_img').css('display','block');
                }
                
            },
            onComplete: function(file, response){
                $('.file_name').html( file );

                response = JSON.parse( response );
                $('.value_image').val( response.name_filemid );
                $('.show_image').attr('src',  '<?php echo base_url() ?>'+response.name_filemid );

            }
        });
        
    });

</script>

