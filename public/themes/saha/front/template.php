<?php include( dirname(__FILE__).'/functions.php' ); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
	<head>
		<meta charset="<?php echo strtolower( config_item( 'charset' ) ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title><?php echo $page_title; ?></title>
		<meta name="viewport" content="width=device-width" />
		<?php if ( isset( $page_meta ) ) {echo $page_meta;} ?> 
		<!--[if lt IE 9]>
			<script src="<?php echo $this->theme_path; ?>share-js/html5.js"></script>
		<![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/nivo-slider.css"/> 	
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/jquery.qtip.css"/> 
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/jquery.captify.css"/> 
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/jquery.jScrollPane.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/fancybox/jquery.fancybox.css"/> 			
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/base.css"/> 
        <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>style/page.css"/> 
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Share" />

		<link rel="stylesheet" type="text/css" media="screen and (min-width:0px) and (max-width:959px)" href="<?php echo $this->theme_path; ?>style/responsive/width-0-959.css"/> 
		<link rel="stylesheet" type="text/css" media="screen and (min-width:0px) and (max-width:767px)" href="<?php echo $this->theme_path; ?>style/responsive/width-0-767.css"/> 
		<link rel="stylesheet" type="text/css" media="screen and (min-width:480px) and (max-width:959px)" href="<?php echo $this->theme_path; ?>style/responsive/width-480-959.css"/> 
		
		<link rel="stylesheet" type="text/css" media="screen and (min-width:768px) and (max-width:959px)" href="<?php echo $this->theme_path; ?>style/responsive/width-768-959.css"/> 
		<link rel="stylesheet" type="text/css" media="screen and (min-width:480px) and (max-width:767px)" href="<?php echo $this->theme_path; ?>style/responsive/width-480-767.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (min-width:0px) and (max-width:479px)" href="<?php echo $this->theme_path; ?>style/responsive/width-0-479.css"/> 
	
		<?php if ( isset( $page_link ) ) {echo $page_link;} ?> 
		
		<script type="text/javascript">
			var mainURL='/Cascade/Template/';
		</script>
		
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/linkify.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.easing.js"></script>
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.isotope.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.captify.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.blockUI.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.qtip.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.fancybox.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.ba-bqq.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.jScrollPane.js"></script>
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.nivo.slider.pack.js"></script>
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.infieldlabel.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>script/jquery.carouFredSel.packed.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>   

        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/script.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>script/cascade.js"></script>	
		
		<?php if ( isset( $page_script ) ) {echo $page_script;} ?> 
		
		<script type="text/javascript">
			// declare variable for use in .js file
			var base_url = '<?php echo $this->base_url; ?>';
			var site_url = '<?php echo site_url(); ?>/';
			var csrf_name = '<?php echo config_item( 'csrf_token_name' ); ?>';
			var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';
		</script>
		
		<?php if ( isset( $in_head_elements ) ) {echo $in_head_elements;} ?> 
		<?php echo $this->modules_plug->do_action( 'front_html_head' ); ?> 
	</head>
	<body class="background-carbon" >
		
        <!-- Header -->
		<div class="header-wrapper">
			
			<div class="header main box-center clear-fix">

				<div class="layout-4060 clear-fix">

					<div class="layout-4060-left">	
						<h1><a href="#!main">Anna Brown</a> </h1>
						<h5><a href="#!main">professional photographer &amp; web developer</a></h5>	
					</div>

					<div class="layout-4060-right">
						<ul class="no-list header-menu clear-fix">
							<!-- <li class="header-menu-download"><a href="#">Download my vCard</a></li> -->
							<li class="header-menu-phone">088-888-8888</li>
							<li class="header-menu-mail"><a href="#">abstractcodify@gmail.com</a></li>
						</ul>
					</div>			

				</div>

			</div>
		</div>
        <!-- /Header -->


        <!-- Content -->
        <div class="content main box-center">

            <!-- Cascade -->
            <div class="cascade preloader">

                <!-- Box menu -->
                <ul class="cascade-menu">
                    <li id="tab-1" class="blue-info">
                        <a href="#!about">
                            <span class="title">About</span>
                            <span class="subtitle">About Me</span>
                        </a>
                    </li>
                    <li id="tab-2" class="lime-camera">
                        <a href="#!portfolio">
                            <span class="title">Portfolio</span>
                            <span class="subtitle">My Works</span>
                        </a>
                    </li>
                    <li id="tab-3" class="yellow-document">		
                        <a href="#!resume">
                            <span class="title">Resume</span>
                            <span class="subtitle">Personal Profile</span>
                        </a>
                    </li>
                    <li id="tab-4" class="green-people">		
                        <a href="#!interests">
                            <span class="title">My Interests</span>
                            <span class="subtitle">Free time</span>
                        </a>
                    </li>
                    <li id="tab-5" class="red-mail">		
                        <a href="#!contact">
                            <span class="title">Contact</span>
                            <span class="subtitle">Get In Touch</span>
                        </a>
                    </li>
                </ul>
                <!-- /Box menu -->

                <!-- Window -->
                <div class="cascade-window">

                    <!-- Close bar -->
                    <div class="cascade-window-close-bar">
                        <a href="#!main"></a>
                    </div>
                    <!-- /Close bar -->

                    <!-- Page content -->
                    <div class="cascade-window-content">
						<div class="cascade-page clear-fix"></div>
					</div>
                    <!-- /Page content -->

                    <!-- Footer -->
                    <div class="cascade-window-footer"></div>
                    <!-- /Footer -->

                </div>
                <!-- /Window -->

                <!-- Navigation -->
                <a href="#" class="cascade-navigation cascade-navigation-prev"></a>
                <a href="#" class="cascade-navigation cascade-navigation-next"></a>
				<a href="#" class="cascade-navigation cascade-navigation-slider-prev"></a>
                <a href="#" class="cascade-navigation cascade-navigation-slider-next"></a>
                <!-- /Navigation -->

            </div>
            <!-- /Cascade -->

        </div>
        <!-- /Content -->


        <!-- Footer -->
        <div class="footer">

            <hr class="footer-line" />

            <div class="main box-center layout-7030 clear-fix">

                <!-- Latest tweets -->
                <div class="layout-7030-left latest-tweets">
                    <div id="latest-tweets"></div>
                </div>
                <!-- /Latest tweets -->

                <!-- Social icons -->
                <div class="layout-7030-right">

                    <ul class="no-list social-list-1">
                        <li>Connect</li>
                        <li><a href="#" class="social-rss"></a></li>
                        <li><a href="#" class="social-facebook"></a></li>
                        <li><a href="#" class="social-twitter"></a></li>
                        <li><a href="#" class="social-google"></a></li>
                        <li><a href="#" class="social-skype"></a></li>
                    </ul>
                    
                </div>
                <!-- /Social icons -->

            </div>

        </div>
        <!-- /Footer -->

		<script type="text/javascript">
			
			var page=	{	"about":{
									"js":"page-1.js",
									"tab":"tab-1",
									"html":"about",
									"main":1,
									"title":"Cascade - Personal vCard Template - About Page"
									},
							"portfolio":{
									"js":"page-2.js",
									"tab":"tab-2",
									"html":"protfolio",
									"main":1,
									"title":"Cascade - Personal vCard Template - Portfolio Page"
									},
							"resume":{
									"js":"page-3.js",
									"tab":"tab-3",
									"html":"resume",
									"main":1,
									"title":"Cascade - Personal vCard Template - Resume Page"},
							"interests":{
									"js":"page-4.js",
									"tab":"tab-4",
									"html":"interests",
									"main":1,
									"title":"Cascade - Personal vCard Template - Interests Page"},
							"contact":{
									"js":"page-5.js",
									"tab":"tab-5",
									"html":"contact",
									"main":1,
									"title":"Cascade - Personal vCard Template - Contact Page"}
						};
			var options={"openStart":"","title":"Cascade - Personal vCard Template","meta":{"keywords":"black, clean, creative, curriculum, curriculum vitae, cv, dark, minimalist, personal, personal profile, personal vcard, portfolio, resume, vcard, virtual card","description":"Cascade is a minimalist personal vCard template based on four vertical menu tabs. The first tab is a typical descriptive about page with slider, the second is a gallery with build-in lightbox, next tab is a personal info page and the last tab is the contact page with working form."},"twitter":{"name":"quanticalabs","count":10}};
			var request='';
			
			$(document).ready(function() 
			{
				$('.cascade').cascade(page,options,request);
			});
			
		</script>
		
		
	</body>
</html>
