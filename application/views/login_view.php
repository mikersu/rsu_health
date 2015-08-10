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
        .mid {
            position: relative;
            top: -16px;
            background: url(<?php echo $this->theme_path; ?>public/img/lightbox-login.png) 0 0 no-repeat;
            width: 364px;
            height: 208px;
        }
        .mid ul {
            margin: 12px 19px 5px 31px;
            padding: 76px 0 0 0;
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
            top: 18px;
            left: 25px;
        }
        .title h1 {
            display: inline-block;
            padding-left: 10px;
            font-size: 28px;
            color: #fff;
            font-family: HelvethaicaXCond;
            position: relative;
            top: -3px;
        }
        input[type="text"],
        input[type="password"],
        textarea {
            padding: 0 10px 0 10px;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="password"] {
            background: url(<?php echo $this->theme_path; ?>public/img/login-box-input.png) 0 0 no-repeat;
            width: 194px;
            height: 25px;
            border: 0;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            background: url(<?php echo $this->theme_path; ?>public/img/login-box-input-active.png) 0 0 no-repeat;
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
            left: 187px;
            top: -26px;
            z-index: 5;
        }
        button.submit:hover {
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
            width: 387px !important;
        }
        .fancybox-inner {
            overflow: hidden !important;
            height: auto !important;
            width: 366px !important;
        }
        .fancybox-skin {
            color: #fff;
            background-color: transparent;
            padding: 0;
        }
        .fancybox-close {
            top: 30px;
            right: 24px;
            background: url(<?php echo $this->theme_path; ?>public/img/ico-close.png) 0 0 no-repeat;
            width: 27px;
            height: 27px;
        }
        .fancybox-close:hover {
            background: url(<?php echo $this->theme_path; ?>public/img/ico-close-active.png) 0 0 no-repeat;
        }
        .forgot-pass {
            color: #BDBDBD !important;
            font: normal 18px HelvethaicaXCond !important;
            text-decoration: underline;
        }
        .forgot-pass:hover {
            color: #fff !important;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="mid">
            <?php echo form_open(); ?> 
                <?php if ( isset( $form_status ) ) {echo $form_status;} ?> 
                <ul>
                    <li class="title">
                        <i class="ico-lock-big"></i><h1> Login เข้าระบบสมาชิก</h1>
                        <a href="#" class="ico-close"></a>
                    </li>
                    <li>
                        <label for="">อีเมล์</label>
                        <input type="text" class="lm36" name="account_username" value="<?php if ( isset( $account_username ) ) {echo $account_username;} ?>" maxlength="255" />
                    </li>
                    <li>
                        <label for="">รหัสผ่าน</label>
                        <input class="lm19" type="password" name="account_password" maxlength="255" />
                    </li>

                    <?php if ( isset( $show_captcha ) && $show_captcha == true ): ?> 
                    <label class="form-label captcha-field">
                        <?php echo lang( 'account_captcha' ); ?>:<br />
                        <img src="<?php echo $this->base_url; ?>public/images/securimage_show.php" alt="securimage" class="captcha" />
                        <a href="#" onclick="$('.captcha').attr( 'src', '<?php echo $this->base_url; ?>public/images/securimage_show.php?' + Math.random() ); return false" tabindex="-1"><img src="<?php echo $this->base_url; ?>public/images/reload.gif" alt="" /></a>
                        <input type="text" name="captcha" value="<?php if ( isset( $captcha ) ) {echo $captcha;} ?>" class="input-captcha" autocomplete="off" />
                    </label>
                    <?php endif; ?> 

                    <li class="tm10 lm12">
                        <a href="<?php echo site_url( 'account/forgotpw/get_mail' ) ?>" class="fancybox fancybox.ajax forgot-pass">Forgot Password ?</a>
                        <button type="submit" class="submit"></button>
                    </li>
                </ul>
            <?php echo form_close(); ?> 
        </div><!-- .mid -->
    </div><!-- .container -->

</body>
</html>