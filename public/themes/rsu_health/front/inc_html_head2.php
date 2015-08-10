<?php 
$company_name = $this->content_config_model->get( 'company_name' ); 
$company_name = ( ! empty( $company_name ) ) ? $company_name : 'APE' ;
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en-US" class="ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en-US" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title = ( ! empty( $page_title ) ) ? $page_title : $company_name ; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="business" />
    <meta property="og:url" content="" />
    <meta property="og:image" content=""/>
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="Rating" content="general" /> 
    <meta name="ROBOTS" content="index, follow" /> 
    <meta name="GOOGLEBOT" content="index, follow" /> 
    <meta name="FAST-WebCrawler" content="index, follow" /> 
    <meta name="Scooter" content="index, follow" /> 
    <meta name="Slurp" content="index, follow" /> 
    <meta name="REVISIT-AFTER" content="7 days" /> 
    <meta name="distribution" content="global" />
    <meta name="copyright" content="" /> 
    <?php echo $meta_tag = ( ! empty( $meta_tag ) ) ? $meta_tag : '' ; ?>

    <?php 
        $logo_company_ico = $this->content_config_model->get( 'logo_company_ico' ); 
        $logo_company_ico = ( ! empty( $logo_company_ico ) ) ? $logo_company_ico : '' ;
    ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url( $logo_company_ico ) ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/non-responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>components/selectbox/css/customSelectBox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>components/scrollbar/css/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>components/selectbox/css/customSelectBox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>components/sliderkit/css/sliderkit-core.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>components/fancyBox/css/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/front.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/front_dev_less.css" />
    <?php if ( isset( $page_link ) ) {echo $page_link;} ?> 
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>components/selectbox/js/SelectBox.js"></script>   
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>components/sliderkit/js/jquery.sliderkit.1.9.2.pack.js"></script>  
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>components/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>  
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>components/fancyBox/js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/carousel.js"></script> 
    <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/script.js"></script>   
    <?php if ( isset( $page_script ) ) {echo $page_script;} ?>  
    <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/html5shiv.js"></script>
    <![endif]-->
    <script>
    // declare variable for use in .js file
    var base_url = '<?php echo $this->base_url; ?>';
    var site_url = '<?php echo site_url(); ?>/';
    var csrf_name = '<?php echo config_item( 'csrf_token_name' ); ?>';
    var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';    

    jQuery(document).ready(function($) {
        $("select.custom").each(function() {

            var sb = new SelectBox({
                selectbox: $(this),
                changeCallback: function(val) {
                    
                    window.location = '<?php echo site_url( "index/change_language" ) ?>'+'/'+val;

                 }

            });
        });        
    });
    </script>

</head>
<body class="<?php echo $retVal = ( ! empty( $class_page ) ) ? $class_page : '' ; ?>">
<?php 
$logo_company_header = $this->content_config_model->get( 'logo_company_header' ); 
$logo_company_header = base_url().call_image_site( $logo_company_header , 147 , 74 );
?>

    <header>
        <div class="header">
            <div class="container">
                <a href="<?php echo site_url( 'home' ) ?>" class="header__logo"><img src="<?php echo $logo_company_header ?>"/></a>
                <div class="header__wrap">
                    <div class="header__wg">
                        <div class="header__wg--text">
                            <?php $image_company_name = $this->content_config_model->get( 'image_company_name' ); ?>
                            <?php if ( ! empty( $image_company_name ) ): ?>
                                <img style="width: 375px; height: 26px;" src="<?php echo base_url( $image_company_name ) ?>"/>
                            <?php endif ?>
                        </div>
                        <?php echo form_open( site_url( 'search' ), array('class' => 'form_class set-search', 'id' => 'form_id' , 'method'=>'get') ); ?>
                        <div class="header__wg--search">
                            <input type="text" name="str" placeholder="<?php echo lang_get('Search') ?>">
                            <input type="button" onclick="$('.set-search').submit()" class="hoverOpa">
                        </div>
                        <?php echo form_close(); ?>

                        <?php if ( ! empty( $data_account ) ): ?>
                            <div class="header__wg--register">
                                <a href="<?php echo site_url( 'member/detail' ) ?>" title="<?php echo $data_account['fullname'] ?>" class="hoverOpa"><?php echo limit_text( $data_account['fullname'] , 6 , '..' ) ?></a>
                            </div>
                            <div class="header__wg--login">
                                <a href="<?php echo site_url( 'account/logout' ) ?>" class="hoverOpa"><?php echo lang_get( 'Logout' ) ?></a>
                            </div>
                        <?php else: ?>                            
                            <div class="header__wg--register">
                                <a href="<?php echo site_url( 'account/register/new_account' ) ?>" class="hoverOpa"><?php echo lang_get( 'Register' ) ?></a>
                            </div>
                            <div class="header__wg--login">
                                <a href="<?php echo site_url( 'account/login' ) ?>" class="hoverOpa"><?php echo lang_get( 'Login' ) ?></a>
                            </div>
                        <?php endif ?>

                        <div class="header__wg--lang">
                            <select class="custom" name="countriesFlag">
                            <?php
                            foreach ( $language as $key => $value ){
                                if($this->session->userdata( 'lang' ) == $value->id)
                                echo '<option class="'.strtolower($value->language_code).'" selected="selected" value="'.$value->id.'" data-image="'.$this->theme_path.'public/img/ico-'.strtolower( $value->language_code ).'.png">'.ucwords( strtolower( $value->language_name ) ).'</option>'."\n";
                                else
                                echo '<option class="'.strtolower($value->language_code).'" value="'.$value->id.'" data-image="'.$this->theme_path.'public/img/ico-'.strtolower( $value->language_code ).'.png">'.ucwords( strtolower( $value->language_name ) ).'</option>'."\n";
                            } 
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="header__menu">
                        <ul>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'home' ) ? 'class="active"' : '' ; ?>  ><a href="<?php echo site_url('home') ?>"><?php echo lang_get('Home') ?></a></li>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'products' ) ? 'class="active"' : '' ; ?> ><a href="<?php echo site_url( 'products' ) ?>"><?php echo lang_get('Products') ?></a></li>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'engineering-service' ) ? 'class="active"' : '' ; ?> ><a href="<?php echo site_url('engineering-service') ?>"><?php echo lang_get('Engineering Service') ?></a></li>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'aboutus' ) ? 'class="active"' : '' ; ?> ><a href="<?php echo site_url( 'aboutus' ) ?>"><?php echo lang_get('About Us') ?></a></li>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'news-event' ) ? 'class="active"' : '' ; ?> ><a href="<?php echo site_url('news-event') ?>"><?php echo lang_get('News &amp; Event') ?></a></li>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'webboard' ) ? 'class="active"' : '' ; ?> ><a href="<?php echo site_url('webboard') ?>"><?php echo lang_get('Webboard') ?></a></li>
                            <li <?php echo $retVal = ( $this->uri->segment(1) == 'contactus' ) ? 'class="active"' : '' ; ?> ><a href="<?php echo site_url('contactus') ?>"><?php echo lang_get('Contact Us') ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <article>