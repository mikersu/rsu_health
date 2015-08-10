<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
	<head>
		<meta charset="<?php echo strtolower( config_item( 'charset' ) ); ?>">
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<title><?php echo $page_title = ( ! empty( $page_title ) ) ? $page_title : '' ; ?></title>
		<meta name="viewport" content="width=device-width">
		<?php if ( isset( $page_meta ) ) {echo $page_meta;} ?> 
		
		<!-- FAVICON -->
	    <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon" > -->

        <!--[if lt IE 9]>
            <script src="<?php echo $this->theme_path; ?>share-js/html5.js"></script>
        <![endif]-->     

        <!-- Load javascripts at bottom, this will reduce page load time -->
        <script src="<?php echo $this->theme_path; ?>assets/js/jquery-1.8.3.min.js"></script>   
        <script src="<?php echo $this->theme_path; ?>assets/ckeditor/ckeditor.js" type="text/javascript" ></script>  
        <script src="<?php echo $this->theme_path; ?>assets/breakpoints/breakpoints.js"></script>       
        <script src="<?php echo $this->theme_path; ?>assets/bootstrap/js/bootstrap.min.js"></script>   
        <script src="<?php echo $this->theme_path; ?>assets/bootstrap-fileupload/bootstrap-fileupload.js" type="text/javascript" ></script>
        <script src="<?php echo $this->theme_path; ?>assets/js/jquery.blockui.js"></script>
        <script src="<?php echo $this->theme_path; ?>assets/js/jquery.cookie.js"></script>
        <!-- ie8 fixes -->
        <!--[if lt IE 9]>
        <script src="<?php echo $this->theme_path; ?>assets/js/excanvas.js"></script>
        <script src="<?php echo $this->theme_path; ?>assets/js/respond.js"></script>
        <![endif]-->
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/jquery-tags-input/jquery.tagsinput.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/clockface/js/clockface.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-daterangepicker/date.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-daterangepicker/daterangepicker.js"></script> 
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>  
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/data-tables/DT_bootstrap.js"></script>   
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/js/jquery.autosize-min.js"></script>    
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/js/app.js"></script> 		  
		

		<script type="text/javascript" src="<?php echo $this->theme_path; ?>plugins/multiple-select/jquery.multiple.select.js"></script> 
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>plugins/select2/select2.min.js"></script>

		<script type="text/javascript" src="<?php echo $this->theme_path; ?>script/form-components.js"></script> 

		<script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/fancybox/source/jquery.fancybox.js"></script>
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/jwplayer/jwplayer.js"></script>  
        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/jwplayer/jwplayer.html5.js"></script>   


        <script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/js/edit_datatable.js"></script>  
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/js/tablednd.js"></script>  
		<script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/js/saha.js"></script>  
 		<script type="text/javascript" src="<?php echo $this->theme_path; ?>assets/js/jquery-ui-1.10.3.custom.min.js"></script>

		<?php if ( isset( $page_script ) ) {echo $page_script;} ?> 

        <script>
          jQuery(document).ready(function() {       
             // initiate layout and plugins
             App.setPage("table_editable");
             App.init();
          });
        </script>

		
		<?php if ( isset( $page_link ) ) {echo $page_link;} ?> 

		<link rel="stylesheet" href="<?php echo $this->theme_path; ?>plugins/multiple-select/multiple-select.css">
		<link rel="stylesheet" href="<?php echo $this->theme_path; ?>plugins/select2/select2.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/css/metro.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/css/style.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/css/style_responsive.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/css/style_default.css" rel="stylesheet" id="style_color" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/gritter/css/jquery.gritter.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/chosen-bootstrap/chosen/chosen.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/jquery-tags-input/jquery.tagsinput.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/clockface/css/clockface.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/glyphicons/css/glyphicons.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-datepicker/css/datepicker.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-timepicker/compiled/timepicker.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-colorpicker/css/colorpicker.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/data-tables/DT_bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/bootstrap-daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/uniform/css/uniform.default.css" />
	   	<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>assets/fancybox/source/jquery.fancybox.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>site-admin/admin_style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>site-admin/admin_less.css" />
	

		
		<!--.js up to page.-->
		<?php if ( $this->uri->segment(2) == 'article' || $this->uri->segment(2) == 'page' ) { ?> 
		<script src="<?php echo $this->theme_path; ?>share-js/jquery.textarea.js"></script>
		<?php } ?> 
		<?php if ( $this->uri->segment(2) == 'category' || $this->uri->segment(2) == 'menu' ) { ?> 
		<!-- // <script type="text/javascript" src="<?php echo $this->theme_path; ?>share-js/jquery.mjs.nestedSortable.js"></script> -->
		<?php } ?> 
		
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
	
	<body class="fixed-top">

