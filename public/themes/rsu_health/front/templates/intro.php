<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title = ( ! empty( $page_title ) ) ? $page_title : '' ; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<?php echo $meta_tag = ( ! empty( $meta_tag ) ) ? $meta_tag : '' ; ?>
	<meta name="Rating" content="general" />
	<meta name="ROBOTS" content="index, follow" />
	<meta name="GOOGLEBOT" content="index, follow" />
	<meta name="FAST-WebCrawler" content="index, follow" />
	<meta name="Scooter" content="index, follow" />
	<meta name="Slurp" content="index, follow" />
	<meta name="REVISIT-AFTER" content="15 days" />
	<meta name="distribution" content="global" />
	<meta name="copyright" content="Copyright" />
	<meta property="og:image" content="<?php echo $this->theme_path; ?>images/logo.png"/>

	<link rel="image_src" href="<?php echo $this->theme_path; ?>images/logo.png" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->theme_path; ?>images/logo.png">

	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>component/sliderkit/css/sliderkit-core.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>component/selectbox/css/customSelectBox.css" charset="utf-8" />

	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>css/bootstrap-responsive-custom.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>js/fancybox/jquery.fancybox.css" />

	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery.easing-1.3.pack.js"></script>
	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery.placeholder.js"></script>
	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/script.js"></script>


	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

	<script src="public/themes/saha/assets/jwplayer/jwplayer.js"></script>
	<script src="public/themes/saha/assets/jwplayer/jwplayer.html5.js"></script>

    <!--[if lt IE 9]>
    	<script type="text/javascript" src="<?php echo $this->theme_path; ?>js/html5shiv.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>js/respond.min.js"></script>
        <script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
		<![endif]-->
		<script>
			var windowWidth = $(window).width();
			function Reload(){
				if(windowWidth != $(window).width()){
					window.location.href = window.location.href
				}
			}
			window.onresize = Reload;
		</script>
	</head>
	<body style="background: none repeat scroll 0% 0% rgb(0, 0, 0);">

		<!-- BEGIN - VIDEO INTRO PRELOADER -->
		<style>
			#container_logo { display:none; visibility: hidden;}
			.preloader
			{
				padding-top:5em;
				color:#fff;
				top: 0%;
				left: 0%;
				width: 100% !important;
				height: 100% !important;
				background: #000;
				text-align:center;
			}
			.highlight { background-color:#ff0000;}
			.highlight a { background-color:#ff0000;}
			.display_none {display:none;}

			.enter-site {
				left: 0;
				margin: 0 auto;
				padding-top: 1em;
				position: absolute;
				right: 0;
				text-align: center;
				z-index: 2147483647;
			}
			.enter-site ul {
				margin: 0;
				padding:0;
				list-style: none;
			}
			.enter-site li {
				display: inline-block;
				margin-right: 8px;
			}
			.btn-enter-site {
				color:#fff;
				font: normal 14px Arial;
				border: 1px solid #636363;
				padding: 5px 10px;
				background-color: #000;
			}
			.btn-enter-site:hover {
				color:#fff;
				text-decoration: none;
				background-color: #EB1B27;
			}

			@media (max-width:640px){
				.preloader {
					padding-top:100px !important;
				}
				video {
					width: 400px;
				}
				.enter-site {
					position: absolute;
					top: 505px !important;
				}
			}

			@media (max-width:480px){
				.preloader {
					padding-top:75px !important;
					height: 120% !important;
				}
				video {
					width: 300px !important;
				}
				.enter-site {
					position: absolute;
					top: 400px !important;
				}
			}
			
			.box-content img
			{
				display: block;
				height: auto !important;
				max-width: 100%;
				width: auto !important;
			}



		</style>

		<script>

			$(document).ready(function(){

	        	/*$("#preloader").delay(8000).animate({opacity: 0}, 1000, function() {
	            	$("#preloader").attr('style', 'opacity: 0; width:0px !important; height:0px !important; left:-100000000px;');
	            });*/

			// $(".jwplayer").delay(8000).animate({opacity: 0}, 1000);
			if ( <?php echo $data_value->select_cover ?> == 3 ) {
				$(".enter-site").delay(7000).animate({opacity: 1}, 1000);
			}
			else
			{
				$(".enter-site").delay(1).animate({opacity: 1}, 1000);
			}

		});

		</script>


		<div id="preloader" class="preloader" >
			<div id="loading"></div>
			
			<?php echo $data_intro ?>

		</div><!-- .preloader -->


		<div class="enter-site">
			<ul>
				<li><a href="<?php echo site_url( 'home' ) ?>" class="btn-enter-site cursor_pointer go-thai">เข้าสู่เว็บไซต์</a></li>
			</ul>
		</div>

		<script type="text/javascript">

			$('.go-thai').click(function(event) {
				if ( <?php echo $data_value->open_this_page ?> == 1 ) {
					window.location = "<?php echo site_url( 'index/change_language/1/intro' ) ?>";
				} else {
					window.location = "<?php echo site_url( 'index/change_language/1/intro' ) ?>";
				}
			});

			$('.go-eng').click(function(event) {
				if ( <?php echo $data_value->open_this_page ?> == 1 ) {
					window.location = "<?php echo site_url( 'index/change_language/2/intro' ) ?>";
				} else {
					window.location = "<?php echo site_url( 'index/change_language/1/intro' ) ?>";
				}

			});

		</script>

	</body>
	</html>