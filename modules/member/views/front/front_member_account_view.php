<?php 
if ( empty( $data_account ) ) {
    redirect( site_url('home') );
}


// $this->db->where( 'account_id', $data_account['id'] );
// $query = $this->db->get( 'accounts' );
// $data = $query->row();

// $show_data = array();
// $show_data['image'] = $data->account_avatar;
// $show_data['name_lastname'] = $data->account_fullname;
// $show_data['birthdate'] = $data->account_birthdate;
// $show_data['gender'] = $data->gender;
// $show_data['email'] = $data->account_email;
// $show_data['nickname'] = $data->nickname;

?>

<div class="content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="javascript:void(0)">Member</a></li>
            <li class="active"><a href="javascript:void(0)">Change My Account</a></li>
        </ol>
        <h1 class="page__header">
            <span>Mem</span>ber
        </h1>
        <div class="wrap__content bg--factory">
            <div class="account">
                <div class="account__detail">
                    <h1 class="account__detail--topic">Change My Account</h1>
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
                                        <input type="button" class="btn btn_black sizeL" id="upload_img" value="BROWSE" >
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--# START SMALL BLOCK COMMENT SYSTEN #-->

<!--                         <div style="padding-left: 10em;" >
                            <span id="upload_img" href="#" class="btn btn-mini">เลือกรูปภาพ</span> <span class="text-input-icon"></span>
                            <input class="cover_img_name" type="hidden" name="account_avatar" value="<?php echo $account_avatar = ( ! empty( $show_data->account_avatar ) ) ? $show_data->account_avatar : '' ; ?>">
                            <span class="wait_loader" style="display:none;"> <img src="<?php echo base_url('public/images/icon_loading.gif') ?>" alt=""></span>
                        </div> -->


                        <!--# END SMALL BLOCK COMMENT SYSTEN #-->


                        <div class="form-group">
                            <div class="wrap--label"><label><?php echo lang_get( 'Name LastName' ) ?> :</label></div>
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
                            <div class="wrap--input"><input name="email" value="<?php echo $retVal = ( ! empty( $show_data['email'] ) ) ? $show_data['email'] : '' ; ?>" type="email" ></div>
                        </div>
                        <div class="form-group">
                            <div class="wrap--label"><label><?php echo lang_get('Old Password') ?> :</label></div>
                            <div class="wrap--input"><input name="password" type="password" value=""></div>
                        </div>
                        <div class="form-group">
                            <div class="wrap--label"><label><?php echo lang_get('New Password') ?> :</label></div>
                            <div class="wrap--input"><input name="n_password" type="password" value=""></div>
                        </div>
                        <div class="form-group">
                            <div class="wrap--label"><label><?php echo lang_get('NickName') ?> :</label></div>
                            <div class="wrap--input"><input name="nickname" type="text" value="<?php echo $retVal = ( ! empty( $show_data['nickname'] ) ) ? $show_data['nickname'] : '' ; ?>"></div>
                        </div>
                        <?php $member = $this->account_model->is_member_login(); ?>
                        
                        <?php if (! empty( $member )): ?>
                            
                        <div class="form-group">
                                <div class="wrap--input">
                                    <div class="wrap--btn">
                                        
                                        <button class="btn-gray" style="padding: 0;border: none;" type=""><?php echo lang_get('Confirm') ?></button>
                                    </div>
                                </div>
                            </div>  

                        <?php else: ?>
                            
                            <div class="form-group">
                                <div class="wrap--label"><label><?php echo lang_get('Condition') ?> :</label></div>
                                <div class="wrap--input">
                                    <textarea disabled><?php $this->content_config_model->get( 'member_privacy_policy' , $this_lang ) ?></textarea>
                                    <p><input type="checkbox" name="checkbox" value="1"> <label><?php echo lang_get('Acceptance') ?></label> </p>
                                    <div class="wrap--btn">
                                        <a class="btn-gray"  href="<?php echo current_url() ?>"><?php echo lang_get('Reset') ?></a>
                                        <button class="btn-gray" style="padding: 0;border: none;" type=""><?php echo lang_get('Confirm') ?></button>
                                    </div>
                                </div>
                            </div>  
                        <?php endif ?>


                    </div>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<script>

  jQuery(document).ready(function($) {

    $("#datepicker").datepicker( { dateFormat: 'dd/mm/yy' } );

  
    // Set fieldname
    $.ajaxUploadSettings.name = 'uploadfile';
    // Set promptzone
    $('#upload_img').ajaxUploadPrompt({
        url : '<?php echo base_url() ?>upload.php',
        error : function () 
        {
            alert( 'upload error please try again' )
        },
        onprogress  : function()
        {
            $('.wait_loader').show();
        },
        success : function (data) 
        {
            $('.wait_loader').hide();
            if (data == '' ) { 
                alert( 'Upload is error, Please try again' )
                return false;
            };

            // console.log(data);
            data = JSON.parse( data );
            $('.file_name').html( data.name_img )
            $('.value_image').val( data.name_filemid );
            $('.show_image').attr('src',  '<?php echo base_url() ?>'+data.name_filemid );


        }
    });
    
  });

</script>

