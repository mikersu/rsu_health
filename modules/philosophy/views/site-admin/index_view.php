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

<div class="portlet box blue tabbable">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-reorder"></i>
			<span class="hidden-480">Content Detail</span>
		</div>
	</div>
	<div class="portlet-body form">
		<div class="tabbable portlet-tabs">
			<ul class="nav nav-tabs">
				<?php $active = 'active' ?>
				<?php foreach ( $language as $key => $value ): ?>
					<li class="<?php echo $active ?>" ><a href="#portlet_tab<?php echo $value->id ?>" data-toggle="tab"><?php echo $value->language_name ?></a></li>	
					<?php $active = '' ?>
				<?php endforeach ?>
			</ul>
			<div class="tab-content">

				<?php $active = 'active' ?>
				<?php foreach ( $language as $key => $value ): ?>

				<!--
				#
				##### START BLOCK COMMENT HTML BOX LANGUAGE
				#
				-->
				
				<div class="tab-pane <?php echo $active ?>" id="portlet_tab<?php echo $value->id ?>">
					<h3 class="form-section" >Detail Language <?php echo $value->language_name ?></h3>

					<div class="form-horizontal" >

						<div class="control-group">
							<label class="control-label">Detail Left</label>
							<div class="controls">
								<textarea class="span12 detail_home m-wrap" name="detail_left[<?php echo $value->id ?>]" rows="6"><?php echo $detail_left = ( ! empty( $show_data['detail_left'][$value->id] ) ) ? $show_data['detail_left'][$value->id] : '' ; ?></textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Detail Right</label>
							<div class="controls">
								<textarea class="span12 detail_home m-wrap" name="detail_right[<?php echo $value->id ?>]" rows="6"><?php echo $detail = ( ! empty( $show_data['detail_right'][$value->id] ) ) ? $show_data['detail_right'][$value->id] : '' ; ?></textarea>
							</div>
						</div>

                        <div class="control-group">
                            <label class="control-label">Detail Lightbox</label>
                            <div class="controls">
                                <textarea class="span12 detail_home m-wrap" name="detail_lightbox[<?php echo $value->id ?>]" rows="6"><?php echo $detail = ( ! empty( $show_data['detail_lightbox'][$value->id] ) ) ? $show_data['detail_lightbox'][$value->id] : '' ; ?></textarea>
                            </div>
                        </div>

                        <div class="control-group user_cover_image display_none">
                            <label class="control-label">Image 1 </label>
                            <div class="controls">
                                <div class="upload_img_cover" id="upload_img1<?php echo $value->id ?>">
                    
                                    <?php if ( ! empty( $show_data['image_left'][$value->id] ) ){ ?>
                                        
                                        <div class="main_c">
                                            <div class="tn_c">
                                                <a>
                                                    <img src="<?php echo base_url( $show_data['image_left'][$value->id] ) ?>" alt="" title="">
                                                </a>
                                            </div>
                                            <input type="hidden" value="<?php echo $show_data['image_left'][$value->id] ?>" name="image_left[<?php echo $value->id ?>]">
                                        </div>
                                    <?php }else{ ?>
                    				<input type="hidden" value="" name="image_left[<?php echo $value->id ?>]">
                                    <?php }?>
                                </div>
                                <span data-url="<?php echo site_url('filemanager/image') ?>" id="set_upload_img1<?php echo $value->id ?>"  class="set_upload_file_cover btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files...</span>
                                </span>
                                <span>ขนาดที่แนะนำ 263x190</span>
                            </div>
                        </div>

                        <div class="control-group">
                        <label class="control-label">Youtube Channel</label>
                            <div class="controls">
                                <input class="span7" type="text" name="youtube_channel[<?php echo $value->id ?>]" value="<?php echo $retVal = ( ! empty( $show_data['youtube_channel'][$value->id] ) ) ? $show_data['youtube_channel'][$value->id] : '' ; ?>" placeholder=" Exp: http://www.youtube.com/channel/UClIarZ2jF3qj4mbT7-WXZ7w ">
                            </div>
                        </div>

                        <div class="control-group">
                        <label class="control-label">Text Height</label>
                            <div class="controls">
                                <input class="span12" type="text" name="text_height[<?php echo $value->id ?>]" value="<?php echo $retVal = ( ! empty( $show_data['text_height'][$value->id] ) ) ? $show_data['text_height'][$value->id] : '' ; ?>" placeholder="">
                            </div>
                        </div>

                        <div class="control-group user_cover_image">
                            <label class="control-label">Image Footer</label>
                            <div class="controls">
                                <div class="upload_img_cover" id="upload_img2<?php echo $value->id ?>">
                    
                                    <?php if ( ! empty( $show_data['image_right'][$value->id] ) ){ ?>
                                        
                                        <div class="main_c">
                                            <div class="tn_c">
                                                <a>
                                                    <img src="<?php echo base_url( $show_data['image_right'][$value->id] ) ?>" alt="" title="">
                                                </a>
                                            </div>
                                            <input type="hidden" value="<?php echo $show_data['image_right'][$value->id] ?>" name="image_right[<?php echo $value->id ?>]">
                                        </div>
                    				<?php }else{ ?>
                    				<input type="hidden" value="" name="image_left[<?php echo $value->id ?>]">
                                    <?php }?>
                    
                                </div>
                                <span data-url="<?php echo site_url('filemanager/image') ?>" id="set_upload_img2<?php echo $value->id ?>"  class="set_upload_file_cover btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files...</span>
                                </span>
                                <span>ขนาดที่แนะนำ 565x278</span>
                            </div>
                        </div>

				<div class="control-group">
                    <label class="control-label">Select cover</label>
                    <?php $show_data['select_cover'][$value->id] = ( empty( $show_data['select_cover'][$value->id] ) ) ? 1 : $show_data['select_cover'][$value->id] ; ?>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" class="select_cover<?php echo $value->id ?>" name="select_cover[<?php echo $value->id ?>]" <?php echo $retVal = ( $show_data['select_cover'][$value->id] ==1 ) ? 'checked="checked"' : '' ; ?> value="1" />
                            Cover by youtube url 
                        </label>  
                        <label class="radio">
                            <input type="radio" class="select_cover<?php echo $value->id ?>" name="select_cover[<?php echo $value->id ?>]" <?php echo $retVal = ( $show_data['select_cover'][$value->id] ==2 ) ? 'checked="checked"' : '' ; ?> value="2" />
                            Cover by video 
                        </label>  
                    </div>
                </div>
                
				<!-- YOUTUBE COVER -->
                <div class="control-group set_cover_youtube<?php echo $value->id ?>">
                    <label class="control-label">Cover Youtube url</label>
                    <div class="controls">
                        <input type="text" value="" placeholder="Example : http://www.youtube.com/watch?v=018UMWioeW4" class="span7 m-wrap input_youtube_url_cover<?php echo $value->id ?>" />
                        <span class="btn green fileinput-button youtube_url_cover<?php echo $value->id ?>">
                            <i class="icon-plus icon-white"></i>
                            <span>Add Youtube url...</span>
                        </span>   
                    </div>
                    <div class="show_youtube_cover<?php echo $value->id ?> controls" >
                        <br>

                        <?php if ( ! empty( $show_data['youtube_id'][$value->id] ) ): ?>


                            <?php 

                            $json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$show_data['youtube_id'][$value->id]."?v=2&alt=jsonc"));

                            ?>

                            <div class="box_show_youtube">
                                <input type="hidden" value="<?php echo $json->data->id ?>" name="youtube_id[<?php echo $value->id ?>]">
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
				<!-- VIDEO COVER -->
                <div class="control-group set_cover_video<?php echo $value->id ?>">
                    <label class="control-label">Cover video upload</label>
                        <div class="controls">
                            <span data-url="<?php echo site_url( 'filemanager/video' ) ?>"  class="set_upload_file_video_cover btn green fileinput-button">
                                <i class="icon-plus icon-white"></i>
                                <span>Add files video...</span>
                            </span>
                            <div class="upload_video_cover" id="upload_file_video<?php echo $value->id ?>">
                                
                                <?php if ( ! empty( $show_data['file_video'][$value->id] ) ): ?>
                                    
		                            <div class="box_show_youtube box_show_video">
									<input type="hidden" name="file_video[<?php echo $value->id ?>]" value="<?php echo $show_data['file_video_cover'][$value->id] ?>" >
		                                <img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo base_url() ?>/popup?data_video=<?php echo $show_data['file_video'][$value->id] ?>" alt="" src="<?php echo $this->theme_path ?>image/my_video.png">
		                           		<span class="video_name<?php echo $value->id ?>" ><?php echo $show_data['file_video'][$value->id] ?></span>
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


					</div>
				</div>

				
				<!--# END BLOCK COMMENT HTML BOX LANGUAGE #-->
					<?php $active = '' ?>	
				<?php endforeach ?>

			</div>

			
		</div>
	</div>
</div>

<div class="">
	<button type="submit" class="btn blue">Submit</button>
	<a class="btn" href="<?php echo site_url('site-admin/philosophy') ?>">Reset</a>
</div>

<!-- END BOX -->

<?php echo form_close(); ?>




<script>
	

jQuery(document).ready(function($) {
	
<?php foreach ( $language as $key => $value ): ?>
// GET DATA COVER NOT EMPTY AND USE FOR CHECK VALUE IN NEXT PROCESS
    data_cover = $('.select_cover<?php echo $value->id; ?>:checked').val();

    // auto set show and hide content auto
	switch(data_cover){
		case '2':
			$('.set_cover_video<?php echo $value->id; ?>').show( 'fast' );
			$('.set_cover_youtube<?php echo $value->id; ?>').hide( 'fast' );
		break;
		default:
			$('.set_cover_video<?php echo $value->id; ?>').hide( 'fast' );
			$('.set_cover_youtube<?php echo $value->id; ?>').show( 'fast' );
	}
    
    // set cover show and hide content on click
    $('.select_cover<?php echo $value->id; ?>').change(function(event) {
		switch($(this).val()){
			case '2':
				$('.set_cover_video<?php echo $value->id;?>').show( 'slow' );
				$('.set_cover_youtube<?php echo $value->id; ?>').hide( 'fast' );
			break;
			default:
				$('.set_cover_video<?php echo $value->id; ?>').hide( 'fast' );
				$('.set_cover_youtube<?php echo $value->id; ?>').show( 'slow' );
		}
    });
		
    CKEDITOR.replace('detail_left[<?php echo $value->id; ?>]', {
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


    CKEDITOR.replace('detail_right[<?php echo $value->id; ?>]', {
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


    CKEDITOR.replace('detail_lightbox[<?php echo $value->id; ?>]', {
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

	/**
    *
    * Block comment file upload_img1
    *
    **/
    $('#set_upload_img1<?php echo $value->id; ?>').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('#upload_img1<?php echo $value->id; ?>')

    });

    $('#upload_img1<?php echo $value->id; ?>').on( 'getFileCallback' , function( event , file ){

      //console.log(event);

        detail_img = '<div class="main_c"> <div class="tn_c"> <a> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_left[<?php echo $value->id; ?>]" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    });
    // end file upload_img1 
	/**
    *
    * Block comment file upload_img2
    *
    **/
    $('#set_upload_img2<?php echo $value->id; ?>').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('#upload_img2<?php echo $value->id; ?>')

    });

    $('#upload_img2<?php echo $value->id; ?>').on( 'getFileCallback' , function( event , file ){

      console.log(event);

        detail_img = '<div class="main_c"> <div class="tn_c"> <a> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_right[<?php echo $value->id; ?>]" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    });
    // end file upload_img2	//upload_file_video
	
	/**
    *
    * set youtube url cover
    *
    **/
    $('.youtube_url_cover<?php echo $value->id; ?>').click(function(event) {
        
        url_youtube = $('.input_youtube_url_cover<?php echo $value->id; ?>').val();

        var parts = url_youtube.match( /[\\?\\&]v=([^\\?\\&]+)/ );

        if ( parts == null ) 
        {
            alert('Alerts : Please check syntax url youtube again')
            return false;
        }
        else
        {

            $.getJSON("http://gdata.youtube.com/feeds/api/videos/ "+ parts[1] +" ?v=2&alt=jsonc&callback=?", function(json){

            	// console.log( json );

                html_youtube = '<br><div class="box_show_youtube" > <input type="hidden" name="youtube_id[<?php echo $value->id ?>]" value="'+json.data.id+'"> <img class="show_img_youtube hover_video cursor_pointer fancybox.ajax" href="'+base_url+'/popup/youtube_url?data_video='+json.data.player.default+'" src="'+json.data.thumbnail.sqDefault+'" alt=""> <div> <span>Title : '+json.data.title+'</span> <br> </div> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"> <i></i> Remove </span> <div style="clear: both;"></div> </div> ';

                $('.show_youtube_cover<?php echo $value->id; ?>').html( html_youtube );

                $('.input_youtube_url_cover<?php echo $value->id; ?>').val('');

            });

        }

    });  
    // end youtube url cover  	


    /**
    *
    * Block comment file video cover 
    *
    **/
    $('.set_cover_video<?php echo $value->id ?>').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object =$('#upload_file_video<?php echo $value->id ?>');

    });

    $('#upload_file_video<?php echo $value->id ?>').on( 'getFileCallback' , function( event , file ){

        detail_video = '<div class="box_show_youtube box_show_video"><input type="hidden" name="file_video[<?php echo $value->id ?>]" value="'+rawurlencode( file.path )+'" ><img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo site_url("popup") ?>?data_video='+rawurlencode( file.path )+'" alt="" src="<?php echo $this->theme_path ?>image/my_video.png"> <span class="video_name" >name video</span> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"><i></i>Remove</span><div style="clear: both;"></div></div>';

        $(this).html( detail_video );
        $('.video_name<?php echo $value->id ?>').html( file.name )


    } );

    // end file cover 

<?php endforeach ?>




    $('body').on('click', '.set_bin', function(event) {
        
        $(this).parent().remove();

    });


});


</script>




