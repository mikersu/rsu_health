<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>
<?php echo $retVal = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXTRAS PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<h4><i class="icon-reorder"></i>Setting Detail Config</h4>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->

				<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
				<?php echo form_open( '', $attributes); ?>

				<div class="control-group">
					<label class="control-label">Company Name</label>
					<div class="controls">
						<input name='company_name' type="text" value="<?php echo $company_name = ( ! empty( $show_data['company_name'] ) ) ? $show_data['company_name'] : '' ; ?>" class="span10 m-wrap" />
					</div>
				</div>

                <hr>
                <!-- IMAGE COVER -->
                <div class="control-group">
                    <label class="control-label">Logo ICO</label>
                        <div class="controls">
                            <div class="upload_img_ico">
                                <span data-url="<?php echo site_url( 'filemanager/image' ) ?>"  class="ico_logo btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files image...</span>
                                </span>
                                <p></p>
                                
                                <?php if ( ! empty( $show_data['logo_company_ico'] ) ): ?>
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a>
                                                <img style="width: 16px; padding-bottom: 1em; height: 16px;" class="hover_image" src="<?php echo base_url( $show_data['logo_company_ico'] ) ?>" href="<?php echo base_url( $show_data['logo_company_ico'] ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $show_data['logo_company_ico'] ?>" name="logo_company_ico">
                                    </div>

                                <?php endif ?>
                            </div>
                        </div>
                </div>
                <!-- END IMAGE COVER -->   


                <hr>
                <!-- IMAGE COVER -->
                <div class="control-group">
                    <label class="control-label">Image Company Name</label>
                        <div class="controls">
                            <div class="upload_img_company_name">
                                <span data-url="<?php echo site_url( 'filemanager/image' ) ?>"  class="image_company_name btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files image...</span>
                                </span>
                                <p></p>
                                
                                <?php if ( ! empty( $show_data['image_company_name'] ) ): ?>
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a>
                                                <img style="padding-bottom: 1em;" class="hover_image" src="<?php echo base_url( $show_data['image_company_name'] ) ?>" href="<?php echo base_url( $show_data['image_company_name'] ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $show_data['image_company_name'] ?>" name="image_company_name">
                                    </div>

                                <?php endif ?>
                            </div>
                        </div>
                </div>
                <!-- END IMAGE COVER -->   



				<hr>
                <!-- IMAGE COVER -->
                <div class="control-group">
                    <label class="control-label">Logo Company Header</label>
                        <div class="controls">
                            <div class="upload_img_big">
                                <span data-url="<?php echo site_url( 'filemanager/image' ) ?>"  class="big_logo btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files image...</span>
                                </span>
                                <p></p>
                                
                                <?php if ( ! empty( $show_data['logo_company_header'] ) ): ?>
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a>
                                                <img style="width: 10em; padding-bottom: 1em;" class="hover_image" src="<?php echo base_url( $show_data['logo_company_header'] ) ?>" href="<?php echo base_url( $show_data['logo_company_header'] ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $show_data['logo_company_header'] ?>" name="logo_company_header">
                                    </div>

                                <?php endif ?>
                            </div>
                        </div>
                </div>
				<!-- END IMAGE COVER -->	

                <hr>
                <!-- IMAGE COVER -->
                <div class="control-group">
                    <label class="control-label">Logo Company Footer</label>
                        <div class="controls">
                            <div class="upload_img_small">
                                <span data-url="<?php echo site_url( 'filemanager/image' ) ?>"  class="small_logo btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files image...</span>
                                </span>
                                <p></p>
                                <?php if ( ! empty( $show_data['logo_company_footer'] ) ): ?>
                                    
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a>
                                                <img style="width: 5em; padding-bottom: 1em;" class="hover_image" src="<?php echo base_url( $show_data['logo_company_footer'] ) ?>" href="<?php echo base_url( $show_data['logo_company_footer'] ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $show_data['logo_company_footer'] ?>" name="logo_company_footer">
                                    </div>

                                <?php endif ?>
                            </div>
                        </div>
                </div>
                <!-- END IMAGE COVER -->    



				<div class="form-actions">
					<button type="submit" class="btn blue">Submit</button>
					<a class="btn" href="<?php echo current_url() ?>">Cancel</a>
				</div>

				<?php echo form_close(); ?>
				<!-- END FORM-->
			</div>
		</div>
		<!-- END EXTRAS PORTLET-->
	</div>
</div>




<script type="text/javascript" >
	
$(function() {


    /**
    *
    * set delete all youtube url
    *
    **/
    $('.set_bin').live('click', function(event) {
        $(this).parent().remove();
    });
    // end delete all youtube url


    $('.image_company_name').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_company_name')

    })

    $('.upload_img_company_name').on( 'getFileCallback' , function( event , file ){

        console.log( file );

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img style="padding-bottom: 1em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_company_name" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    })






    $('.ico_logo').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_ico')

    })

    $('.upload_img_ico').on( 'getFileCallback' , function( event , file ){

        console.log( file );

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img style="width: 16px; padding-bottom: 1em; height: 16px;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="logo_company_ico" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    })




	$('.big_logo').click(function(){

		set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

		set_open.target_object = $('.upload_img_big')

	})

	$('.upload_img_big').on( 'getFileCallback' , function( event , file ){

		console.log( file );

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img style="width: 10em; padding-bottom: 1em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="logo_company_header" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

	})



    /**
    *
    * Block comment file cover 
    *
    **/
    $('.small_logo').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_small')

    })

    $('.upload_img_small').on( 'getFileCallback' , function( event , file ){

        console.log( file );

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img style="width: 5em; padding-bottom: 1em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="logo_company_footer" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // end file cover 


    /**
    *
    * Block comment file video cover 
    *
    **/
    $('.set_upload_file_video_cover').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_video_cover')

    })

    $('.upload_video_cover').on( 'getFileCallback' , function( event , file ){

        detail_video = '<div class="box_show_youtube box_show_video"><input type="hidden" name="file_video_cover" value="'+rawurlencode( file.path )+'" ><img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo site_url("popup") ?>?data_video='+rawurlencode( file.path )+'" alt="" src="<?php echo $this->theme_path ?>image/my_video.png"> <span class="video_name" >name video</span> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"><i></i>Remove</span><div style="clear: both;"></div></div>';

        $(this).html( detail_video );
        $('.video_name').html( file.name )


    } )

    // end file cover 




	$('.hover_video').fancybox({
		
			padding: 0,
			openEffect : 'elastic',
			openSpeed  : 150,
			scrolling : "no",
			closeEffect : 'elastic',
			closeSpeed  : 150,

	});

    $('.hover_image').fancybox({
        
            padding: 0,
            openEffect : 'elastic',
            openSpeed  : 150,
            scrolling : "no",
            closeEffect : 'elastic',
            closeSpeed  : 150,

    });

});   



</script>











