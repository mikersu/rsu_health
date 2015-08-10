<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXTRAS PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<h4><i class="icon-reorder"></i>Detail in Saha Database</h4>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->

				<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
				<?php echo form_open( '', $attributes); ?>

				<div class="control-group">
					<label class="control-label">Title</label>
					<div class="controls">
						<input name='title' type="text" value="<?php echo $title = ( ! empty( $show_data['title'] ) ) ? $show_data['title'] : '' ; ?>" class="span10 m-wrap" />
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Link url</label>
					<div class="controls">
						<input name='link_url' type="text" value="<?php echo $link_url = ( ! empty( $show_data['link_url'] ) ) ? $show_data['link_url'] : '' ; ?>" class="span10 m-wrap" />
					</div>
				</div>

                <div class="control-group">
                    <label class="control-label">Option open page</label>
                    <?php $show_data['open_this_page'] = ( empty( $show_data['open_this_page'] ) ) ? 1 : $show_data['open_this_page'] ; ?>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" class='open_this_page' name="open_this_page" <?php echo $retVal = ( $show_data['open_this_page'] == 1 ) ? 'checked="checked"' : '' ; ?> value="1" />
                            Open this page
                        </label>
                        <label class="radio">
                            <input type="radio" class='open_this_page' name="open_this_page" <?php echo $retVal = ( $show_data['open_this_page'] == 2 ) ? 'checked="checked"' : '' ; ?> value="2" />
                            Open new page
                        </label>  
                    </div>
                </div>



				<div class="control-group">
                    <label class="control-label">Select cover</label>
                    <?php $show_data['select_cover'] = ( empty( $show_data['select_cover'] ) ) ? 1 : $show_data['select_cover'] ; ?>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" class='select_cover' name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] == 1 ) ? 'checked="checked"' : '' ; ?> value="1" />
                            Cover by image
                        </label>
                        <label class="radio">
                            <input type="radio" class='select_cover' name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] == 2 ) ? 'checked="checked"' : '' ; ?> value="2" />
                            Cover by youtube url 
                        </label>  
                        <label class="radio">
                            <input type="radio" class='select_cover' name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] == 3 ) ? 'checked="checked"' : '' ; ?> value="3" />
                            Cover by video 
                        </label>  
						<label class="radio">
                            <input type="radio" class='select_cover' name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] == 4 ) ? 'checked="checked"' : '' ; ?> value="4" />
                            Cover by Text 
                        </label> 
                    </div>
                </div>

				<!-- YOUTUBE COVER -->
                <div class="control-group set_cover_youtube">
                    <label class="control-label">Cover Youtube url</label>
                    <div class="controls">
                        <input type="text" value="" placeholder="Example : http://www.youtube.com/watch?v=018UMWioeW4" class="span7 m-wrap input_youtube_url_cover" />
                        <span class="btn green fileinput-button youtube_url_cover">
                            <i class="icon-plus icon-white"></i>
                            <span>Add Youtube url...</span>
                        </span>   
                    </div>
                    <div class="show_youtube_cover controls" >

                        <?php if ( ! empty( $show_data['youtube_id_cover'] ) ): ?>


                            <?php 

                            $json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$show_data['youtube_id_cover']."?v=2&alt=jsonc"));

                            ?>

                            <div class="box_show_youtube">
                                <input type="hidden" value="<?php echo $json->data->id ?>" name="youtube_id_cover">
                                <img class="show_img_youtube hover_video cursor_pointer fancybox.ajax" alt="" href="<?php echo site_url( 'popup/youtube_url?data_video='.$json->data->player->default ) ?>" src="<?php echo $json->data->thumbnail->sqDefault ?>">
                                <div>
                                    <span>Title : <?php echo $json->data->title ?></span>
                                    <br>
                                </div>
                                <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box">
                                    <i></i>
                                    Remove
                                </span>
                                <div style="clear: both;"></div>
                            </div>   

                        <?php endif ?>

                    </div>
                </div>                    
				<!-- END YOUTUBE COVER -->

				<!-- IMAGE COVER -->
                <div class="control-group set_cover_image">
                    <label class="control-label">Cover image upload</label>
                        <div class="controls">
                            <span data-url="<?php echo site_url( 'filemanager/image' ) ?>"  class="set_upload_file_cover btn green fileinput-button">
                                <i class="icon-plus icon-white"></i>
                                <span>Add files image...</span>
                            </span>
                            <div class="upload_img_cover">
                                
                                <?php if ( ! empty( $show_data['image_name_cover'] ) ): ?>
                                    
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a>
                                                <img class="hover_image" src="<?php echo base_url( $show_data['image_name_cover'] ) ?>" href="<?php echo base_url( $show_data['image_name_cover'] ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $show_data['image_name_cover'] ?>" name="image_name_cover">
                                    </div>

                                <?php endif ?>
                            </div>
                        </div>
                </div>
				<!-- END IMAGE COVER -->

				<!-- VIDEO COVER -->
                <div class="control-group set_cover_video">
                    <label class="control-label">Cover video upload</label>
                        <div class="controls">
                            <span data-url="<?php echo site_url( 'filemanager/video' ) ?>"  class="set_upload_file_video_cover btn green fileinput-button">
                                <i class="icon-plus icon-white"></i>
                                <span>Add files video...</span>
                            </span>
                            <div class="upload_video_cover">
                                
                                <?php if ( ! empty( $show_data['file_video_cover'] ) ): ?>
                                    
		                            <div class="box_show_youtube box_show_video">
		                            	<input type="hidden" name="file_video_cover" value="<?php echo $show_data['file_video_cover'] ?>" >
		                                <img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo base_url() ?>/popup?data_video=<?php echo $show_data['file_video_cover'] ?>" alt="" src="<?php echo $this->theme_path ?>image/my_video.png">
		                           		<span class="video_name" ><?php echo $show_data['file_video_cover'] ?></span>
		                                <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box">
		                                    <i></i>
		                                    Remove
		                                </span>
		                                <div style="clear: both;"></div>
		                            </div>  

                                <?php endif ?>
                            </div>
                        </div>
                </div>
				<!-- END VIDEO COVER -->
				
				<!-- TEXT COVER -->			

				<div class="control-group set_cover_text">
					<label class="control-label">Intro Text</label>
					<div class="controls">
						<textarea class="span12 detail_home m-wrap" name="intro_text" rows="6"><?php echo $detail = ( ! empty( $show_data['intro_text']) ) ? $show_data['intro_text'] : '' ; ?></textarea>
					</div>
				</div>
				<!-- END TEXT COVER -->

				<div class="control-group">
					<label class="control-label">Advance Date Ranges</label>
					<div class="controls">
						<div id="form-date-range" class="btn">
							<i class="icon-calendar"></i>
							&nbsp;
							<span>
								<?php if ( ! empty( $show_data['start_date'] ) OR ! empty( $show_data['end_date'] ) ): ?>
									<?php echo $start_date = date( 'd-m-Y' , $show_data['start_date'] ) ?> To <?php echo $end_date = date( 'd-m-Y' , $show_data['end_date'] )  ?>
								<?php endif ?>
							</span> 
							<b class="caret"></b>
						</div>
						<span id='input_date_range' style="display:none;" >
							<input type="hidden" value="<?php echo $start_date = ( ! empty( $start_date ) ) ? reset_format_date( $start_date , '-' , '/' , 'd-m-y' , 'd-m-y' ) : '' ; ?>" name="start_date">
							<input type="hidden" value="<?php echo $end_date = ( ! empty( $end_date ) ) ? reset_format_date( $end_date , '-' , '/' , 'd-m-y' , 'd-m-y' ) : '' ; ?>" name="end_date">
						</span>
					</div>
				</div>

				<div class="control-group display_none">
					<label class="control-label">Product sort</label>
					<div class="controls">
						<input name='order_sort' type="text" value="<?php echo $title = ( ! empty( $show_data['order_sort'] ) ) ? $show_data['order_sort'] : '0' ; ?>" class="span2 m-wrap" />
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

				<div class="form-actions">
					<button type="submit" class="btn blue">Submit</button>
					<a class="btn" href="<?php echo site_url('site-admin/intro_page') ?>">Cancel</a>
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

	$('.set_upload_file').click(function(){

		set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

		set_open.target_object = $('.upload_img')

	})

	$('.upload_img').on( 'getFileCallback' , function( event , file ){

		console.log( file );

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_cover" value="'+file.name+'"> </div>';

        $(this).html( detail_img );

	})


    // $('input[name=daterangepicker_start] , input[name=daterangepicker_end]').on('click', function(event) {
    //     $('.daterangepicker .calendar').show();
    // });

    // $('.daterangepicker .range_inputs .btn-danger').on('click', function(event) {
    //     $('.daterangepicker .calendar').hide();
    // });


    // GET DATA COVER NOT EMPTY AND USE FOR CHECK VALUE IN NEXT PROCESS
    data_cover = $('.select_cover:checked').val();

    // auto set show and hide content auto
    if ( data_cover == 1 ) 
    {
        $('.set_cover_image').show( 'slow' );
        $('.set_cover_video').hide( 'fast' );
        $('.set_cover_youtube').hide( 'fast' );
		$('.set_cover_text').hide( 'fast' );
    } 
    else if ( data_cover == 2 )
    {
        $('.set_cover_youtube').show( 'slow' );
        $('.set_cover_video').hide( 'fast' );
        $('.set_cover_image').hide( 'fast' );
		$('.set_cover_text').hide( 'fast' );
    }
    else if ( data_cover == 3 )
    {
        $('.set_cover_youtube').hide( 'fast' );
        $('.set_cover_image').hide( 'fast' );
        $('.set_cover_video').show( 'slow' );
		$('.set_cover_text').hide( 'fast' );

    }
	else if ( data_cover == 4 )
    {
        $('.set_cover_youtube').hide( 'fast' );
        $('.set_cover_image').hide( 'fast' );
        $('.set_cover_video').hide( 'fast' );
		$('.set_cover_text').show( 'slow' );
    };
    
    // set cover show and hide content on click
    $('.select_cover').change(function(event) {
	    if ( $(this).val() == 1 ) 
	    {
	        $('.set_cover_image').show( 'slow' );
	        $('.set_cover_video').hide( 'fast' )
	        $('.set_cover_youtube').hide( 'fast' );
			$('.set_cover_text').hide( 'fast' );
	    } 
	    else if ( $(this).val() == 2 )
	    {
	        $('.set_cover_youtube').show( 'slow' );
	        $('.set_cover_video').hide( 'fast' );
	        $('.set_cover_image').hide( 'fast' );
			$('.set_cover_text').hide( 'fast' );
	    }
	    else if ( $(this).val() == 3 )
	    {
	        $('.set_cover_youtube').hide( 'fast' );
	        $('.set_cover_image').hide( 'fast' );
	        $('.set_cover_video').show( 'slow' );
			$('.set_cover_text').hide( 'fast' );
	    }
		else if ( $(this).val() == 4 )
	    {
	        $('.set_cover_youtube').hide( 'fast' );
	        $('.set_cover_image').hide( 'fast' );
	        $('.set_cover_video').hide( 'fast' );
			$('.set_cover_text').show( 'slow' );
	    };
    });



    /**
    *
    * set youtube url cover
    *
    **/
    $('.youtube_url_cover').click(function(event) {
        
        url_youtube = $('.input_youtube_url_cover').val();

        var parts = url_youtube.match( /[\\?\\&]v=([^\\?\\&]+)/ );

        if ( parts == null ) 
        {
            alert('Alerts : Please check syntax url youtube again')
            return false;
        }
        else
        {

            $.getJSON("http://gdata.youtube.com/feeds/api/videos/ "+ parts[1] +" ?v=2&alt=jsonc&callback=?", function(json){

            	console.log( json );

                html_youtube = '<div class="box_show_youtube" > <input type="hidden" name="youtube_id_cover" value="'+json.data.id+'"> <img class="show_img_youtube hover_video cursor_pointer fancybox.ajax" href="'+base_url+'/popup/youtube_url?data_video='+json.data.player.default+'" src="'+json.data.thumbnail.sqDefault+'" alt=""> <div> <span>Title : '+json.data.title+'</span> <br> </div> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"> <i></i> Remove </span> <div style="clear: both;"></div> </div> ';

                $('.show_youtube_cover').html( html_youtube );

                $('.input_youtube_url_cover').val('');

            });

        }

    });  
    // end youtube url cover  


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

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_name_cover" value="'+file.path+'"> </div>';

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




    // /**
    // *
    // * Call show video 
    // *
    // **/
    // $('.call_show_video').on('click', function(event) {
    	
    // 	var url = $(this).attr('data-url');

    // 	$.ajax({
    // 	    url: '<?php echo site_url("popup") ?>' ,
    // 	    type: "POST" ,
    // 	    processData: true ,
    // 	    data: {param1: 'value1'} ,
    // 	    success: function( data ) 
    // 	    { 
    // 			//run..
    // 	    }
    // 	});

    	
    // });


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
	

jQuery(document).ready(function($) {
    CKEDITOR.replace('intro_text', {
        filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
        height:300,
        enterMode: 2,
        toolbar : [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'netclub', items: [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ,'Font','FontSize','TextColor','BGColor'] },
            { name: 'tools', items: [ 'Maximize' ] },
            { name: 'others', items: [ '-' ] },
            { name: 'career', items: [ 'career' ] }
        ]
    });
});


</script>











