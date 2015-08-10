<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo $this->theme_path; ?>public/css/font.css">
    <style>
        /* Remove IE dotted outline */
        a:active, a:focus {
            outline:none;
        }
        /* Remove Chrome orange outline */
        *:focus {
            outline: none;
        }
        /* Remove Firefox's dotted outline .*/
        a:focus, a:active,
        button::-moz-focus-inner,
        select::-moz-focus-inner,
        input[type="reset"]::-moz-focus-inner,
        input[type="button"]::-moz-focus-inner,
        input[type="submit"]::-moz-focus-inner,
        input[type="file"] > input[type="button"]::-moz-focus-inner {
            border: 0;
            outline : 0;
        }
        body {
            color: #fff;
            font-family: HelvethaicaXCond !important;
        }
        .container {
            position: relative;
        }
        .top {
            background: url(<?php echo $this->theme_path; ?>public/img/lightbox-top.png) 0 0 no-repeat;
            width: 494px;
            height: 69px;
        }
        .mid {
            position: relative;
            top: -16px;
            background: url(<?php echo $this->theme_path; ?>public/img/lightbox-mid.png) 0 0 repeat-y;
            width: 494px;
        }
        .mid ul {
            margin: 12px 28px 5px 30px;
            padding: 12px 0 0 0;
        }
        .bottom {
            position: relative;
            top: -50px;
            background: url(<?php echo $this->theme_path; ?>public/img/lightbox-bottom.png) 0 0 no-repeat;
            width: 494px;
            height: 69px;
        }
        ul {
            list-style: none;
        }
        li {
        }
        .ico-note {
            background: url(<?php echo $this->theme_path; ?>public/img/ico-note.png) 0 0 no-repeat;
            width: 23px;
            height: 23px;
            display: inline-block;
        }
        .title {
            position: absolute;
            top: -45px;
        }
        .title h1 {
            display: inline-block;
            padding-left: 10px;
            font-size: 28px;
            color: #fff;
            font-family: HelvethaicaXCond;
            position: relative;
            top: -4px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            padding: 0 10px 0 10px;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            background: url(<?php echo $this->theme_path; ?>public/img/input-02.png) 0 0 no-repeat;
            width: 271px;
            height: 25px;
            border: 0;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            background: url(<?php echo $this->theme_path; ?>public/img/input-02-active.png) 0 0 no-repeat;
        }
        textarea {
            background: url(<?php echo $this->theme_path; ?>public/img/textarea.png) 0 0 no-repeat;
            width: 306px;
            height: 76px;
            resize: none;
            border: 0;
            overflow-y: hidden;
        }
        textarea:focus {
            background: url(<?php echo $this->theme_path; ?>public/img/textarea-active.png) 0 0 no-repeat;
        }
        label {
            color: #fff;
            font-size: 20px;
        }
        label:before {
            content: "•";
            padding-right: 7px;
            font-size: 30px;
        }
        button.submit {
            display: block;
            border: 0;
            background: url(<?php echo $this->theme_path; ?>public/img/btn-submit.png) 0 0 no-repeat;
            width: 94px;
            height: 35px;
            cursor: pointer;
            position: relative;
            right: -330px;
            top: 10px;
            z-index: 5;
        }
        button.submit:hover {
            background: url(<?php echo $this->theme_path; ?>public/img/btn-submit-active.png) 0 0 no-repeat;
        }

        .over_button {
            display: block;
            border: 0;
            background: url(<?php echo $this->theme_path; ?>public/img/btn-submit.png) 0 0 no-repeat;
            width: 94px;
            height: 35px;
            cursor: pointer;
            position: relative;
            right: -330px;
            top: 10px;
            z-index: 5;
        }
        .over_button:hover {
            background: url(<?php echo $this->theme_path; ?>public/img/btn-submit-active.png) 0 0 no-repeat;
        }

        .agreement {
            font-size: 28px;
        }
        .agreement-box {
            background: url(<?php echo $this->theme_path; ?>public/img/agreement-box.png) 0 0 no-repeat;
            width: 408px;
            height: 144px;
            overflow-y: scroll;
            color: #222;
            font-size: 18px;
            padding: 10px 10px;
        }
        .select-container {
            background: url(<?php echo $this->theme_path; ?>public/img/form02-select.png) 0 0 no-repeat;
            width: 289px;
            height: 25px;
            display: inline-block;
        }
        .select-container .select-wrap {
            background: transparent;
            width: 257px;
            height: 25px;
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            text-indent: 0.01px;
            text-overflow: '';
            line-height: 1;
            border-radius: 0;
            border: 0;
            color: #fff;
            position: relative;
            left: 10px;
        }
        .select-container select {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: window;
            outline : none;
            overflow : hidden;
            text-indent : 0.01px;
            text-overflow : '';
            font-family: HelvethaicaXCond;
            font-size: 18px;
            padding-top: 2px;
        }
        .select-container .select-wrap option {
            color: #fff;
            background-color: #505050;
        }
        .select-container select::-ms-expand {
            display: none;
        }
        /* */
        .fancybox-wrap {
            width: 474px !important;
        }
        .fancybox-inner {
            overflow: hidden !important;
            height: auto !important;
            width: 495px !important;
        }
        .fancybox-skin {
            color: #fff;
            background-color: transparent;
            padding: 0;
        }
        .fancybox-close {
            top: 33px;
            background: url(<?php echo $this->theme_path; ?>public/img/ico-close.png) 0 0 no-repeat;
            width: 27px;
            height: 27px;
        }
        .fancybox-close:hover {
            background: url(<?php echo $this->theme_path; ?>public/img/ico-close-active.png) 0 0 no-repeat;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="top"></div>
        <div class="mid">

            <?php echo form_open( '', array( 'class' => 'form-horizontal' ) ); ?> 
                <div class="form-status-placeholder"><?php if ( isset( $form_status ) ) {echo $form_status;} ?></div>
                <ul>
                    <li class="title">
                        <i class="ico-note"></i><h1>สมัครสมาชิก</h1>
                        <a href="#" class="ico-close"></a>
                    </li>
                    <li>
                        <label for="" class="relative" style="top:-7px">ประเภทสมาชิก</label>
                        <div class="select-container lm13">
                            <select name="member_type" class="select-wrap">
                                
                                <?php foreach ( $type_list as $key => $value ): ?>
                                    
                                    <option value="<?php echo $value->ref_id_config ?>"><?php echo $value->name_type ?></option>
                                    
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                    </li>
                    <li>
                        <label for="">ชื่อผู้ติดต่อ</label>
                        <input type="text" name="name" class="lm32">
                    </li>
                    <li>
                        <label for="">โทรศัพท์</label>
                        <input type="text" name="phone" class="lm43">
                    </li>
                    <li>
                        <label for="">ที่อยู่</label>
                        <textarea name="address" class="lm63"></textarea>
                    </li>
                    <li>
                        <label for="" class="relative" style="top:-7px">สมัครแพ็คเกจ</label>
                        <div class="select-container lm16">
                            <select name="package_type" class="select-wrap">
                                <?php foreach ( $package_list as $key => $value ): ?>
                                    
                                    <option value="<?php echo $value->ref_id_config ?>"><?php echo $value->name_type ?></option>
                                    
                                <?php endforeach ?>
                            </select>
                        </div>
                    </li>
                    <li>
                        <label for="">อีเมล์</label>
                        <input class="lm60" type="email" name="account_email" value="<?php if ( isset( $account_email ) ) {echo $account_email;} ?>" maxlength="255" id="account_email" />
                    </li>

                    <li>
                        <label for="">รหัสผ่าน</label>
                        <input class="lm43" type="password" name="account_password" value="" maxlength="255" id="account_password" />
                    </li>

                    <li>
                        <label for="">ยืนยันรหัสผ่าน</label>
                        <input class="lm13" type="password" name="account_confirm_password" value="" maxlength="255" id="account_confirm_password" />
                    </li>

                    <li class="tm15">
                        <label for="" class="agreement">ระเบียบการเป็นสมาชิก</label><br>
                        <!--<textarea name="" class="" readonly="readonly">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.Minima, temporibus, quas, excepturi recusandae in adipisci necessitatibus accusantium ipsum tempore at saepe itaque quisquam est? Asperiores, sapiente quae odio quisquam quibusdam.
                        </textarea>-->
                        <div class="agreement-box scroll-box tm5">
                            Lorem ipsum dolor sit amet consectetur adpiscing elit. Nulla quam
                            velit, vul putate eu pharetra necter mattis ac neque. Duis vul putate
                            commodo lectus, ac blandit elit tincidunt id. Sed elit rhoncus tortor
                            serd elefend tris teque tortor, mauris molest ed lacnia ipsum quam
                            nec dui. Quique nec mauris amet elit ser culs pretium sit amet quis
                            magna. Aenan velit odio, element um in tempus sit ut, vehicula eu
                            rhoncus diam. Vulputate eu pharetra necter mattis ac neque.Lorem ipsum dolor sit amet consectetur adpiscing elit. Nulla quam
                            velit, vul putate eu pharetra necter mattis ac neque. Duis vul putate
                            commodo lectus, ac blandit elit tincidunt id. Sed elit rhoncus tortor
                            serd elefend tris teque tortor, mauris molest ed lacnia ipsum quam
                            nec dui. Quique nec mauris amet elit ser culs pretium sit amet quis
                            magna. Aenan velit odio, element um in tempus sit ut, vehicula eu
                            rhoncus diam. Vulputate eu pharetra necter mattis ac neque.Lorem ipsum dolor sit amet consectetur adpiscing elit. Nulla quam
                            velit, vul putate eu pharetra necter mattis ac neque. Duis vul putate
                            commodo lectus, ac blandit elit tincidunt id. Sed elit rhoncus tortor
                            serd elefend tris teque tortor, mauris molest ed lacnia ipsum quam
                            nec dui. Quique nec mauris amet elit ser culs pretium sit amet quis
                            magna. Aenan velit odio, element um in tempus sit ut, vehicula eu
                            rhoncus diam. Vulputate eu pharetra necter mattis ac neque.
                        </div>
                        <!--<img src="<?php echo $this->theme_path; ?>public/img/textarea-placeholder.png" class="tm5">-->
                        <br>
                        <p class="text-right rp15 mtm15"><input type="checkbox" name="agree" ><span style="font-size:18px"> &nbsp;ยอมรับข้อตกลง</span></p>
                    </li>
                    <li>

                        <div class="control-group">
                            <?php if ( $plugin_captcha != null ) {
                                echo $plugin_captcha;
                            } else { ?> 
                            <label class="control-label captcha-field" for="captcha">
                                <?php echo lang_get( 'Captcha' ); ?>:
                            </label>
                            <div class="controls">
                                <img src="<?php echo $this->base_url; ?>public/images/securimage_show.php" alt="securimage" class="captcha" />
                                <a class="click_captcha" href="#" onclick="$('.captcha').attr( 'src', '<?php echo $this->base_url; ?>public/images/securimage_show.php?' + Math.random() ); return false" tabindex="-1"><img src="<?php echo $this->base_url; ?>public/images/reload.gif" alt="" /></a>
                                <div>
                                    <input type="text" name="captcha" value="<?php if ( isset( $captcha ) ) {echo $captcha;} ?>" class="input-captcha" autocomplete="off" id="captcha" />
                                </div>
                            </div>
                            <?php } ?> 
                        </div>

                    </li>
                    <li>
                        <span class="over_button" ></span>
                        <!-- <button type="submit" class="submit"></button> -->
                    </li>
                </ul>
            <?php echo form_close(); ?> 
        </div><!-- .mid -->
        <div class="bottom"></div>
    </div><!-- .container -->

</body>
</html>



<script>
    

jQuery(document).ready(function($) {
    
    $('.over_button').click(function(event) {
        
        a = $('.form-horizontal').serialize();

        // ๏

        $.ajax({
            url: '<?php echo site_url( "account/register/check_register" ) ?>' ,
            type: "POST" ,
            data: a ,
            success: function( data ) 
            { 
                if ( data != 'true' ) 
                {
                    alert( data );
                    $('.click_captcha').click();

                }
                else
                {
                    $('.form-horizontal').submit();
                }
                
            }
        });        


    });


});

</script>

