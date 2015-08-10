<!-- ECHO ERROR -->
<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<!-- SUCCESS -->
<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>

<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
<?php echo form_open( '', $attributes); ?>


<!--
#
##### START BLOCK COMMENT HTML BOX CONTENT
#
-->

<div class="portlet box blue over-blog-category-gallery">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-reorder"></i>
			<span class="hidden-480"><?php echo $this_title_page ?></span>
		</div>
	</div>
	<div class="portlet-body form">

		<div class="form-horizontal">

            <!-- IMAGE COVER UPLOAD -->
            <div class="control-group user_cover_image">
                <label class="control-label">Cover image upload</label>
                <div class="controls">
                    <div class="upload_img_cover">

                        <?php if ( ! empty( $show_data['image_logo'] ) ): ?>

                            <div class="main_c">
                                <div class="tn_c">
                                    <a>
                                        <img src="<?php echo base_url( $show_data['image_logo'] ) ?>" alt="" title="" style="max-width: 15em;" >
                                    </a>
                                </div>
                                <input type="hidden" value="<?php echo $show_data['image_logo'] ?>" name="image_logo[]">
                            </div>

                        <?php endif ?>

                    </div>
                    <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file_cover btn green fileinput-button">
                        <i class="icon-plus icon-white"></i>
                        <span>Add files...</span>
                    </span>
                    <span>ขนาดที่แนะนำ 50x50</span>
                </div>
            </div>



            <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                    <div class="basic-toggle-button">
                        <input name="status" type="checkbox" class="toggle" <?php echo $status = ( ! empty( $show_data['status'] ) ) ? 'checked="checked"' : '' ; ?> value="1" />
                    </div>
                </div>
            </div>

			<input type="hidden" name="set" >

        </div>


	</div>
</div>

<div class="">
	<button type="submit" class="btn blue">Submit</button>
	<a class="btn" href="<?php echo site_url('site-admin/service') ?>">Cancel</a>
</div>

<!-- END BOX -->

<?php echo form_close(); ?>



<script>
	
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

        detail_img = '<div class="main_c" style="max-height: none;" > <div class="tn_c"> <a > <img style="max-width: 15em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_logo[]" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // end file cover 



    $('body').on('click', '.set_bin', function(event) {
        
        $(this).parent().remove();

    });


</script>



