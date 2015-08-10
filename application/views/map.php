<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

	<!--<script type="text/javascript" src="public/js/jquery-1.7.2.min.js"></script>-->
	<script src="<?php echo $this->theme_path; ?>public/js/jquery.printPage.js"></script>

	<style>
		.btnPrint {
			position: absolute;
			right: 8px;
			bottom: 7px;
		}
	</style>

</head>
<body>

	<script>
		$(function(){
			$('.btnPrint').printPage();
		});
	</script>


	<?php $output['contact_file_map'] = $this->content_config_model->get( 'contact_file_map' ); ?>


	<img src="<?php echo base_url( $output['contact_file_map'] ) ?>" style="width:900px">

	<a class="btnPrint" href="<?php echo base_url( $output['contact_file_map'] ) ?>"><img src="<?php echo $this->theme_path; ?>public/images/icons/print_icon.gif" style="width:37px;"></a>

</body>
</html>