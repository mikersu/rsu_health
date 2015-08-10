<?php  

$data_account = $this->account_model->get_account_cookie( 'member' );

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>ARM CLUB : Advanced Retail Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="title" content="#" />
        <meta name="description" content="#" />
        <meta name="Rating" content="general" /> 
        <meta name="ROBOTS" content="index, follow" /> 
        <meta name="GOOGLEBOT" content="index, follow" /> 
        <meta name="FAST-WebCrawler" content="index, follow" /> 
        <meta name="Scooter" content="index, follow" /> 
        <meta name="Slurp" content="index, follow" /> 
        <meta name="REVISIT-AFTER" content="15 days" /> 
        <meta name="distribution" content="global" />
        <meta name="copyright" content="Copyright" /> 
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->theme_path; ?>public/images/icons/favicon.ico">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/bootstrap.css" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/bootstrap-responsive.css" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/front.css" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/reset.css" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/css/bootstrap-responsive-custom.css" charset="utf-8" />
     
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/component/selectbox/css/customSelectBox.css" charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>public/component/selectbox/css/jquery.jscrollpane.css" charset="utf-8" />
 


        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/jquery.easing-1.3.pack.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/cufon-yui.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/web-font.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/js/script.js"></script>
        
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/selectbox/js/jScrollPane.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/selectbox/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>public/component/selectbox/js/SelectBox.js"></script>
   

        <!--[if IE]>
            <script type="text/javascript" src="../public/js/PIE.js"></script>
        <![endif]-->

        <script type="text/javascript">
            // declare variable for use in .js file
            var base_url = '<?php echo $this->base_url; ?>';
            var site_url = '<?php echo site_url(); ?>/';
            <?php //if ( config_item( 'csrf_protection' ) == true ): ?> 
            var csrf_name = '<?php echo config_item( 'csrf_token_name' ); ?>';
            var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
            <?php //endif; ?> 
        </script>
        <?php echo $this->modules_plug->do_action( 'admin_html_head' ); ?> 
        
    </head>




<body id="layout_login">
    <header>
        <div class="header">
            <div class="container"><a href="<?php echo site_url(); ?>" class="logo"><img src="<?php echo $this->theme_path; ?>public/images/logo.png"></a></div>
        </div>
    </header>
    
    <section>

        <div class="wrap">

            <?php $attri = array( 'class' => 'form' , 'id' => 'main_content' ) ?>

            <?php echo form_open( '' , $attri ); ?> 
                <?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>
                <h3>Reset Password</h3>

                <?php if ( isset( $form_status ) ) {echo $form_status;} ?> 

                <?php echo $account_error = $this->session->flashdata( 'account_error' ) ?>

            	<div class="row-fluid"><input name="password" type="password" placeholder="NEW PASSWORD"></div>
                <div class="row-fluid"><input name="confirm_password" type="password" placeholder="CONFIRM PASSWORD"></div>
                <div class="row-fluid"><input type="submit" value="CHANGE PASSWORD" ></div>

                <div class="row-fluid text-center"><span class="text_footer">ARM CLUB</span></div>
            <?php echo form_close(); ?> 
        </div>
    </section>


</body>
</html>


