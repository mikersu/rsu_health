<div class="content page_login">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li class="active"><a href="javascript:void(0)">Member</a></li>
        </ol>
        <h1 class="page__header">
            <span>Mem</span>ber
        </h1>
        <div class="wrap__content member">
            <div class="member__head">
                <h1 class="member__head--topic">Login</h1>
                <div class="member__head--sub">Advanced Power Equipment (Thailand) Co.,Ltd</div>
            </div>
            <?php echo $retVal = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
            <div class="member__register">
                <div class="member__register--head"><?php echo lang_get('Account Login') ?></div>
                <div class="member__register--wrap">
                    <?php echo $member_text_page ?>
                </div>
                <div class="member__register--btn">
                    <a href="<?php echo site_url( 'account/register/new_account' ) ?>" class="btn-gray"><?php echo lang_get('Register') ?></a>
                </div>
            </div>
            <?php echo form_open(); ?> 
            <div class="member__login">
                <div class="member__login--head">Sign in</div>
                <div class="member__login--wrap">
                    <div class="form">
                        <div class="form-group">
                            <div class="wrap--label"><label>E-mail :</label></div>
                            <div class="wrap--input"><input name="account_username" value="<?php echo $retVal = ( ! empty( $show_data['account_username'] ) ) ? $show_data['account_username'] : '' ; ?>" type="email"></div>
                        </div>
                        <div class="form-group">
                            <div class="wrap--label"><label>Password :</label></div>
                            <div class="wrap--input">
                                <input name="account_password" type="password">
                                <a href="<?php echo site_url('member/set_password') ?>" class="forgot">Forgot Password</a>

                            </div>
                        </div>
                        <div class="wrap--btn">
                            <button type="" class="btn--login" >LOGIN</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>