<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" href="<?php echo base_url() ?>/public/script_404/css/main.css" type="text/css" media="screen, projection" /> <!-- main stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>/public/script_404/css/tipsy.css" /> <!-- Tipsy implementation -->

<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url() ?>css/ie8.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo base_url() ?>/public/script_404/scripts/jquery-1.7.2.min.js"></script> <!-- uiToTop implementation -->
<script type="text/javascript" src="<?php echo base_url() ?>/public/script_404/scripts/custom-scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/public/script_404/scripts/jquery.tipsy.js"></script> <!-- Tipsy -->

<script type="text/javascript">

$(document).ready(function(){
			
	universalPreloader();
						   
});

$(window).load(function(){

	//remove Universal Preloader
	universalPreloaderRemove();
	
	rotate();
    dogRun();
	dogTalk();
	
	//Tipsy implementation
	$('.with-tooltip').tipsy({gravity: $.fn.tipsy.autoNS});
						   
});

</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>404 - Not found</title>
</head>

<body>

<!-- Universal preloader -->
<div id="universal-preloader">
    <div class="preloader">
        <img src="<?php echo base_url() ?>/public/script_404/images/universal-preloader.gif" alt="universal-preloader" class="universal-preloader-preloader"/>
    </div>
</div>
<!-- Universal preloader -->

<div id="wrapper">
<!-- 404 graphic -->
	<div class="graphic"></div>
<!-- 404 graphic -->
<!-- Not found text -->
	<div class="not-found-text">
    	<!-- <h1 class="not-found-text">File not found  </h1>
        <br /> -->
        <h1 class="not-found-text" >Go to.. <a href="<?php echo site_url() ?>" class="with-tooltip" title="Return to the home page">Home Page</a></h1>
    </div>
<!-- Not found text -->

<!-- search form -->
<div class="search">
	<form name="search" method="get" action="//www.google.co.th/search?">
        <input type="text" name="q" value="Search ..." />
        <input class="with-tooltip" title="Search!" type="submit" name="submit" value="" />
    </form>
</div>
<!-- search form -->

<!-- top menu -->
<div class="top-menu">
    <span>Page error file not found.. </span>
    <!-- <a href="#" class="with-tooltip" title="Return to the home page">Home</a> | <a href="#" class="with-tooltip" title="Navigate through our sitemap">Sitemap</a> | <a href="#" class="with-tooltip" title="Contact us!">Contact</a> | <a href="#" class="with-tooltip" title="Request additional help">Help</a> -->
</div>
<!-- top menu -->

<div class="dog-wrapper">
<!-- dog running -->
	<div class="dog"></div>
<!-- dog running -->
	
<!-- dog bubble talking -->
	<div class="dog-bubble">
    	
    </div>
    
    <!-- The dog bubble rotates these -->
    <div class="bubble-options">
    	<p class="dog-bubble">
        	Hello world
        </p>
    	<p class="dog-bubble">
	        <br />
        	Arf! Arf!
        </p>
        <p class="dog-bubble">
        	<br />
        	Don't worry! I'm on it!
        </p>
        <p class="dog-bubble">
        	I wish I had a cookie<br /><img style="margin-top:8px" src="<?php echo base_url() ?>/public/script_404/images/cookie.png" alt="cookie" />
        </p>
        <p class="dog-bubble">
        	<br />
        	Free Time error
        </p>
        <p class="dog-bubble">
        	<br />
        	Am I getting close?
        </p>
        <p class="dog-bubble">
        	Or am I just going in circles? Nah...
        </p>
        <p class="dog-bubble">
        	<br />
            OK, I'm officially lost now...
        </p>
        <p class="dog-bubble">
        	I think I saw a <br /><img style="margin-top:8px" src="<?php echo base_url() ?>/public/script_404/images/cat.png" alt="cat" />
        </p>
        <p class="dog-bubble">
        	What are we supposed to be looking for, anyway? @_@
        </p>
    </div>
    <!-- The dog bubble rotates these -->
<!-- dog bubble talking -->
</div>

<!-- planet at the bottom -->
	<div class="planet"></div>
<!-- planet at the bottom -->
</div>

</body>
</html>
