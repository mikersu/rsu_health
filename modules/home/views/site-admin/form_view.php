<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<div class="row-fluid">
   <div class="span12">
    <!-- BEGIN EXTRAS PORTLET-->
    <div class="portlet box blue">
     <div class="portlet-title">
      <h4><i class="icon-reorder"></i>Detail in home <?php echo $language->language_name ?></h4>
  </div>
  <div class="portlet-body form">
      <!-- BEGIN FORM-->

      <?php $attributes = array( 'class' => 'form-horizontal' ); ?>
      <?php echo form_open( '', $attributes); ?>

      <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input name='title' type="text" value="<?php echo $title = ( ! empty( $show_data['title'] ) ) ? $show_data['title'] : '' ; ?>" class="span6 m-wrap" />
        </div>
    </div>


    <div class="control-group user_cover_image">
        <label class="control-label">Cover image upload</label>
        <div class="controls">
            <div class="upload_img_cover" id="upload_cover">

                <?php if ( ! empty( $show_data['image_home'] ) ): ?>

                    <div class="main_c">
                        <div class="tn_c">
                            <a>
                                <img src="<?php echo base_url( $show_data['image_home'] ) ?>" alt="" title="">
                            </a>
                        </div>
                        <input type="hidden" value="<?php echo $show_data['image_home'] ?>" name="image_home">
                    </div>

                <?php endif ?>

            </div>
            <span data-url="<?php echo site_url('filemanager/image') ?>" id="set_upload_file_cover" class="set_upload_file_cover btn green fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>Add files...</span>
            </span>
            <span>ขนาดที่แนะนำ 1140x660</span>
        </div>
    </div>

    <div class="control-group user_cover_image">
        <label class="control-label">Recommended upload</label>
        <div class="controls">
            <div class="upload_img_cover" id="upload_recommended">

                <?php if ( ! empty( $show_data['image_recommended'] ) ): ?>

                    <div class="main_c">
                        <div class="tn_c">
                            <a>
                                <img src="<?php echo base_url( $show_data['image_recommended'] ) ?>" alt="" title="">
                            </a>
                        </div>
                        <input type="hidden" value="<?php echo $show_data['image_recommended'] ?>" name="image_recommended">
                    </div>

                <?php endif ?>

            </div>
            <span data-url="<?php echo site_url('filemanager/image') ?>" id="set_upload_file_recommended" class="set_upload_file_cover btn green fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>Add files...</span>
            </span>
            <span>ขนาดที่แนะนำ 270x170</span>
        </div>
    </div>



    <!-- YOUTUBE COVER -->
    <div class="control-group">
        <label class="control-label">Cover Youtube url</label>
        <div class="controls">
            <input type="text" value="" placeholder="Example : http://www.youtube.com/watch?v=018UMWioeW4" class="span7 m-wrap input_youtube_url_cover" />
            <span class="btn green fileinput-button youtube_url_cover">
                <i class="icon-plus icon-white"></i>
                <span>Add Youtube url...</span>
            </span>   
        </div>
        <div class="show_youtube_cover controls" >

            <?php if ( ! empty( $show_data['youtube_id'] ) ): ?>


                <?php 

                $json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$show_data['youtube_id']."?v=2&alt=jsonc"));

                ?>

                <div class="box_show_youtube">
                    <input type="hidden" value="<?php echo $json->data->id ?>" name="youtube_id">
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








    <div class="form-actions">
        <button type="submit" class="btn blue">Submit</button>
        <input type="hidden" name="language_id" value="<?php echo $language_id ?>" >
        <a class="btn" href="<?php echo site_url('site-admin/home') ?>">Cancel</a>
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
    * set delete image
    *
    **/
    $('.set_bin').live('click', function(event) {
        $(this).parent().remove();
    });
    // end delete image


    // -------------------------------------



    /**
    *
    * Block comment file cover 
    *
    **/
    $('#set_upload_file_cover').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('#upload_cover');

    })

    $('#upload_cover').on( 'getFileCallback' , function( event , file ){

      console.log(event);

      detail_img = '<div class="main_c"> <div class="tn_c"> <a> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_home" value="'+file.path+'"> </div>';

      $(this).html( detail_img );

  } )

    // end file cover 

    /**
    *
    * Block comment file Recommended 
    *
    **/
    $('#set_upload_file_recommended').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('#upload_recommended')

    })

    $('#upload_recommended').on( 'getFileCallback' , function( event , file ){

      console.log(event);

      detail_img = '<div class="main_c"> <div class="tn_c"> <a> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_recommended" value="'+file.path+'"> </div>';

      $(this).html( detail_img );

  } )

    // end file Recommended 
    // end upload file album

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

                html_youtube = '<div class="box_show_youtube" > <input type="hidden" name="youtube_id" value="'+json.data.id+'"> <img class="show_img_youtube hover_video cursor_pointer fancybox.ajax" href="'+base_url+'/popup/youtube_url?data_video='+json.data.player.default+'" src="'+json.data.thumbnail.sqDefault+'" alt=""> <div> <span>Title : '+json.data.title+'</span> <br> </div> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"> <i></i> Remove </span> <div style="clear: both;"></div> </div> ';

                $('.show_youtube_cover').html( html_youtube );

                $('.input_youtube_url_cover').val('');

            });

        }

    });  
    // end youtube url cover  


</script>
















