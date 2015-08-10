
<?php echo $error_validation = ( ! empty( $error_validation ) ) ? $error_validation : '' ; ?>

<div class="row-fluid">
   <div class="span12">
	  <!-- BEGIN EXTRAS PORTLET-->
	  <div class="portlet box blue">
		 <div class="portlet-title">
			<h4><i class="icon-reorder"></i>Business Type</h4>
		 </div>
		 <div class="portlet-body form">
			<!-- BEGIN FORM-->
			
            <?php $attributes = array( 'class' => 'form-horizontal' ); ?>
			<?php echo form_open( '', $attributes); ?>


				<div class="control-group">
					<label class="control-label">Business Type</label>
					<div class="controls">
						<input name='business_type_name' type="text" value="<?php echo $business_type_name = ( ! empty( $show_data->business_type_name ) ) ? $show_data->business_type_name : '' ; ?>" class="span6 m-wrap" />
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Order Sort</label>
					<div class="controls">
						<input name='order_sort' type="number" value="<?php echo $order_sort = ( ! empty( $show_data->order_sort ) ) ? $show_data->order_sort : '' ; ?>" class="span1 m-wrap" />
					</div>
				</div>


				<div class="control-group">
				    <label class="control-label">Status</label>
				    <div class="controls">
				        <div class="basic-toggle-button">
				            <input name="status" type="checkbox" class="toggle" <?php echo $status = ( ! empty( $show_data->status ) ) ? 'checked="checked"' : '' ; ?> value="1" />
				        </div>
				    </div>
				</div>
				

			   <div class="form-actions">
				  <button type="submit" class="btn blue">Submit</button>
                  <a class="btn" href="<?php echo site_url('site-admin/member/other_setting') ?>">Cancel</a>
			   </div>
			<?php echo form_close(); ?>
			<!-- END FORM-->
		 </div>
	  </div>
	  <!-- END EXTRAS PORTLET-->
   </div>
</div>


<script>
	
$(document).ready(function() {
	
    /**
    *
    * Block comment file cover 
    *
    **/
    $('.set_upload_file_cover').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_cover')

    })

    $('.upload_img_cover').on( 'getFileCallback' , function( event , file ){

    	console.log(event);

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_name_cover" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // end file cover 


});


</script>














