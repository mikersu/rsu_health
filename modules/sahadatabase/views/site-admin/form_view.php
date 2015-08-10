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
              <label class="control-label">Type</label>
              <div class="controls">
                 <select name="type" class="span6 chosen" data-placeholder="Choose.." tabindex="1">
                    <option value="1">ภาพยนต์ไทย</option>
                    <option value="2">ภาพยนต์ต่างประเทศ</option>
                 </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Director</label>
              <div class="controls">
                    <input data-items = '4' autocomplete="off" name='director' data-provide="typeahead" data-source='[ <?php echo $director_list = ( ! empty( $director_list ) ) ? $director_list : '' ; ?> ]' type="text" value="<?php echo $director = ( ! empty( $show_data['director'] ) ) ? $show_data['director'] : '' ; ?>" class="span6 m-wrap" />
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">Title</label>
              <div class="controls">
                 <input name='title' type="text" value="<?php echo $title = ( ! empty( $show_data['title'] ) ) ? $show_data['title'] : '' ; ?>" class="span6 m-wrap" />
              </div>
            </div>

            <div class="control-group">
                <label class="control-label">Date</label>
                <div class="controls">
                    <div class="input-append date date-picker" data-date="" data-date-format="dd/mm/yyyy" data-date-viewmode="years">
                        <input name="date" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="<?php echo $date = ( ! empty( $show_data['date'] ) ) ? $show_data['date'] : '' ; ?>" /><span class="add-on"><i class="icon-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="control-group">
              <label class="control-label">Synopsis</label>
              <div class="controls">
                 <textarea class="span12 ckeditor this_ckeditor m-wrap" name="synopsis" rows="6"><?php echo $synopsis = ( ! empty( $show_data['synopsis'] ) ) ? $show_data['synopsis'] : '' ; ?></textarea>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">Detail</label>
              <div class="controls">
                 <textarea class="span12 ckeditor this_ckeditor m-wrap" name="detail" rows="6"><?php echo $detail = ( ! empty( $show_data['detail'] ) ) ? $show_data['detail'] : '' ; ?></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Available</label>
              <div class="controls">
                 <textarea class="span12 ckeditor this_ckeditor m-wrap" name="available" rows="6"><?php echo $available = ( ! empty( $show_data['available'] ) ) ? $show_data['available'] : '' ; ?></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Activity</label>
              <div class="controls">
                 <textarea class="span12 ckeditor this_ckeditor m-wrap" name="activity" rows="6"><?php echo $activity = ( ! empty( $show_data['activity'] ) ) ? $show_data['activity'] : '' ; ?></textarea>
              </div>
            </div>    
                
                <div class="portlet-title-more green">
                    <h4><i class="icon-reorder"></i>Image & VDO Youtube setting</h4>
                </div>

                <div class="portlet-body-more">

                    <div class="control-group">
                        <label class="control-label">Select cover</label>
                        <?php $show_data['select_cover'] = ( empty( $show_data['select_cover'] ) ) ? '1' : $show_data['select_cover'] ; ?>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" class='select_cover' name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] == 1 ) ? 'checked="checked"' : '' ; ?> value="1" />
                                Cover by image
                            </label>
                            <label class="radio">
                                <input type="radio" class='select_cover' name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] == 2 ) ? 'checked="checked"' : '' ; ?> value="2" />
                                Cover by youtube url 
                            </label>  
                        </div>
                    </div>

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
                                    <img class="show_img_youtube" alt="" src="<?php echo $json->data->thumbnail->sqDefault ?>">
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

                    <div class="control-group set_cover_image">
                        <label class="control-label">Cover image upload</label>
                            <div class="controls">
                                <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file_cover btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files...</span>
                                </span>
                                <div class="upload_img_cover">
                                    <?php if ( ! empty( $show_data['image_name_cover'] ) ): ?>
                                        
                                        <div class="main_c">
                                            <div class="tn_c">
                                                <a href="url">
                                                    <img src="<?php echo base_url( $show_data['image_name_cover'] ) ?>" alt="" title="">
                                                </a>
                                            </div>
                                            <input type="hidden" value="<?php echo $show_data['image_name_cover'] ?>" name="image_name_cover">
                                        </div>

                                    <?php endif ?>
                                </div>
                            </div>
                    </div>

                    <hr>

                    <div class="control-group">
                        <label class="control-label">Poster</label>
                        <div class="controls">
                            <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_poster btn green fileinput-button">
                                <i class="icon-plus icon-white"></i>
                                <span>Add files...</span>
                            </span>
                            <div class="upload_img_poster">

                                <?php if ( ! empty( $show_data['name_image_poster'] ) ): ?>
                                    
                                    <?php foreach ( $show_data['name_image_poster'] as $key => $value ): ?>

                                    <div class="main_c">
                                        <img class="trash_set set_bin" src="<?php echo $this->theme_path.'image/b_close.png' ?>" alt="">
                                        <div class="tn_c">
                                            <a href="url">
                                                <img src="<?php echo base_url( $value ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $value ?>" name="name_image_poster[]">
                                    </div>

                                    <?php endforeach ?>

                                <?php endif ?>                                

                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Promotion</label>
                        <div class="controls">
                            <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_promotion btn green fileinput-button">
                                <i class="icon-plus icon-white"></i>
                                <span>Add files...</span>
                            </span>
                            <div class="upload_img_promotion">
                               
                                <?php if ( ! empty( $show_data['name_image_promotion'] ) ): ?>
                                    
                                    <?php foreach ( $show_data['name_image_promotion'] as $key => $value ): ?>

                                    <div class="main_c">
                                        <img class="trash_set set_bin" src="<?php echo $this->theme_path.'image/b_close.png' ?>" alt="">
                                        <div class="tn_c">
                                            <a href="url">
                                                <img src="<?php echo base_url( $value ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $value ?>" name="name_image_promotion[]">
                                    </div>

                                    <?php endforeach ?>

                                <?php endif ?>    

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="control-group">
                        <label class="control-label">Gallery image upload</label>
                            <div class="controls">
                                <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files...</span>
                                </span>
                                <div class="upload_img">

                                    <?php if ( ! empty( $show_data['name_image'] ) ): ?>
                                        
                                        <?php foreach ( $show_data['name_image'] as $key => $value ): ?>
                                            
                                            <div class="main_c">
                                                <img class="trash_set set_bin" src="<?php echo $this->theme_path.'image/b_close.png' ?>" alt="">
                                                <div class="tn_c">
                                                    <a >
                                                        <img src="<?php echo base_url( $value ) ?>" alt="" title="">
                                                    </a>
                                                </div>
                                                <input type="hidden" value="<?php echo $value ?>" name="name_image[]">
                                            </div>

                                        <?php endforeach ?>

                                    <?php endif ?>                                        
                                
                                </div>
                            </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label">Youtube url</label>
                        <div class="controls">
                            <input type="text" value="" placeholder="Example : http://www.youtube.com/watch?v=018UMWioeW4" class="span7 m-wrap input_youtube_url" />
                            <span class="btn green fileinput-button youtube_url">
                                <i class="icon-plus icon-white"></i>
                                <span>Add Youtube url...</span>
                            </span>                            
                        </div>
      
                        <div class="show_youtube controls" >

                            <?php if ( ! empty( $show_data['id_youtube'] ) ): ?>
                                
                                <?php foreach ( $show_data['id_youtube'] as $key => $value ): ?>
                                    
    
                                <?php 

                                    $json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$value."?v=2&alt=jsonc"));
                          
                                ?>

                                <div class="box_show_youtube">
                                    <input type="hidden" value="<?php echo $json->data->id ?>" name="id_youtube[]">
                                    <img class="show_img_youtube" alt="" src="<?php echo $json->data->thumbnail->sqDefault ?>">
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

                                <?php endforeach ?>

                            <?php endif ?>


                        </div>

                    </div>

                </div>

                <div class="portlet-title-more">
                    <h4><i class="icon-reorder"></i>SEO setting</h4>
                </div>
                
                <div class="portlet-body-more">

                    <div class="control-group">
                      <label class="control-label">Url slug</label>
                      <div class="controls">
                         <input name='slug' type="text" value="<?php echo $slug = ( ! empty( $show_data['slug'] ) ) ? $show_data['slug'] : '' ; ?>" class="span6 m-wrap" />
                      </div>
                   </div>

                   <div class="control-group">
                      <label class="control-label">Tag keywords</label>
                      <div class="controls">
                         <input name='tag_keywords' type="text" value="<?php echo $tag_keywords = ( ! empty( $show_data['tag_keywords'] ) ) ? $show_data['tag_keywords'] : '' ; ?>" class="span6 m-wrap" />
                      </div>
                   </div>

                   <div class="control-group">
                      <label class="control-label">Tag description</label>
                      <div class="controls">
                         <input name='tag_description' type="text" value="<?php echo $tag_description = ( ! empty( $show_data['tag_description'] ) ) ? $show_data['tag_description'] : '' ; ?>" class="span6 m-wrap" />
                      </div>
                   </div>

                </div>  

                <div class="portlet-title-more orange">
                    <h4><i class="icon-reorder"></i>Other setting</h4>
                </div>
                
                <div class="portlet-body-more">

                    <div class="control-group bb">
                        <label class="control-label">Background image upload</label>
                            <div class="controls">
                                <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_backgroud_image btn green fileinput-button">
                                    <i class="icon-plus icon-white"></i>
                                    <span>Add files...</span>
                                </span>
                                <div class="upload_backgroud_image">
                                    
                                <?php if ( ! empty( $show_data['backgroud_image'] ) ): ?>
                                    
                                    <div class="main_c">
                                        <div class="tn_c">
                                            <a href="url">
                                                <img src="<?php echo base_url( $show_data['backgroud_image'] ) ?>" alt="" title="">
                                            </a>
                                        </div>
                                        <input type="hidden" value="<?php echo $show_data['backgroud_image'] ?>" name="backgroud_image">
                                    </div>

                                <?php endif ?>   

                                </div>
                            </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Tab Color</label>
                        <div class="controls set_tab_color">
                            <div class="input-append color colorpicker-default" data-color="<?php echo $tab_color = ( ! empty( $show_data['tab_color'] ) ) ? $show_data['tab_color'] : '' ; ?>" data-color-format="rgba">
                                <input class="input_tab_color" name="tab_color" type="text" class="m-wrap" value="<?php echo $tab_color = ( ! empty( $show_data['tab_color'] ) ) ? $show_data['tab_color'] : '' ; ?>" />
                                <span class="add-on"><i style="background-color: <?php echo $tab_color = ( ! empty( $show_data['tab_color'] ) ) ? $show_data['tab_color'] : '' ; ?>;"></i></span>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="control-group">
                        <label class="control-label">Sort product</label>
                        <div class="controls">
                            <input name="order_sort" type="text" class="m-wrap span2" value="<?php echo $order_sort = ( ! empty( $show_data['order_sort'] ) ) ? $show_data['order_sort'] : '' ; ?>" />
                        </div>
                    </div>


                    <div class="control-group">
                      <label class="control-label">Hot highlight</label>
                        <div class="controls">
                            <div class="basic-toggle-button">
                                <input name="highlight" type="checkbox" class="toggle" <?php echo $highlight = ( ! empty( $show_data['highlight'] ) ) ? 'checked="checked"' : '' ; ?> />
                            </div>
                        </div>
                   </div>

                   <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <div class="basic-toggle-button">
                                <input name="status" type="checkbox" class="toggle" <?php echo $status = ( ! empty( $show_data['status'] ) ) ? 'checked="checked"' : '' ; ?> />
                            </div>
                        </div>
                   </div>

                </div>  

               <div class="form-actions">
                  <button type="submit" class="btn blue">Submit</button>
                  <a class="btn" href="<?php echo site_url('site-admin/sahadatabase') ?>">Cancel</a>
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

    // set autocomplete
    $('.typeahead').typeahead()

    // set tab color input
    $('.input_tab_color').change(function(event) {
        c = $(this).val();
        $('.set_tab_color .colorpicker-default .add-on i').css( 'background-color', c );
    });

    /**
    *
    * set delete all 
    *
    **/
    $('.set_bin').live('click', function(event) {
        $(this).parent().remove();
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

                html_youtube = '<div class="box_show_youtube" > <input type="hidden" name="youtube_id_cover" value="'+json.data.id+'"> <img class="show_img_youtube" src="'+json.data.thumbnail.sqDefault+'" alt=""> <div> <span>Title : '+json.data.title+'</span> <br> </div> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"> <i></i> Remove </span> <div style="clear: both;"></div> </div> ';

                $('.show_youtube_cover').html( html_youtube );

                $('.input_youtube_url_cover').val('');

            });

        }

    });  
    // end youtube url cover  

    /**
    *
    * Block comment file image cover 
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

    // end file image cover 

    /**
    *
    * Block comment upload file album
    *
    **/
    $('.set_upload_file').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img')

    })

    $('.upload_img').on( 'getFileCallback' , function( event , file ){

        console.log( file );

        detail_img = '<div class="main_c"> <img class="trash_set set_bin" src="<?php echo $this->theme_path."image/b_close.png" ?>" alt=""> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="name_image[]" value="'+file.path+'"> </div>';

        $(this).append( detail_img );    

    } )

    // end upload file album


    /**
    *
    * set youtube url
    *
    **/
    $('.youtube_url').click(function(event) {
        
        url_youtube = $('.input_youtube_url').val();

        var parts = url_youtube.match( /[\\?\\&]v=([^\\?\\&]+)/ );

        if ( parts == null ) 
        {
            alert('Alerts : Please check syntax url youtube again')
            return false;
        }
        else
        {

            $.getJSON("http://gdata.youtube.com/feeds/api/videos/ "+ parts[1] +" ?v=2&alt=jsonc&callback=?", function(json){

                html_youtube = '<div class="box_show_youtube" > <input type="hidden" name="id_youtube[]" value="'+json.data.id+'"> <img class="show_img_youtube" src="'+json.data.thumbnail.sqDefault+'" alt=""> <div> <span>Title : '+json.data.title+'</span> <br>  </div> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"> <i></i> Remove </span> <div style="clear: both;"></div> </div> ';

                $('.show_youtube').append( html_youtube );

                $('.input_youtube_url').val('');

            });

        }

    });
    // end youtube url        



    /**
    *
    * Block comment upload image poster album
    *
    **/
    $('.set_upload_poster').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_poster')

    })

    $('.upload_img_poster').on( 'getFileCallback' , function( event , file ){

        console.log( file );

        detail_img = '<div class="main_c"> <img class="trash_set set_bin" src="<?php echo $this->theme_path."image/b_close.png" ?>" alt=""> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="name_image_poster[]" value="'+file.path+'"> </div>';

        $(this).append( detail_img );    

    } )

    // end upload image poster album



    /**
    *
    * Block comment upload image poster album
    *
    **/
    $('.set_upload_promotion').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_img_promotion')

    })

    $('.upload_img_promotion').on( 'getFileCallback' , function( event , file ){

        console.log( file );

        detail_img = '<div class="main_c"> <img class="trash_set set_bin" src="<?php echo $this->theme_path."image/b_close.png" ?>" alt=""> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="name_image_promotion[]" value="'+file.path+'"> </div>';

        $(this).append( detail_img );    

    } )

    // end upload image poster album    



    /**
    *
    * Block comment Background image upload
    *
    **/
    $('.set_upload_backgroud_image').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.upload_backgroud_image')

    })

    $('.upload_backgroud_image').on( 'getFileCallback' , function( event , file ){

        detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="backgroud_image" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // Background image upload 

       
    CKEDITOR.replace('activity', {
                filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
                width: 650,
                height:300,
                enterMode: 2,
                toolbar : [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
                    '/',
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                    { name: 'netclub', items: [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                    '/',
                    { name: 'styles', items: [ 'Styles', 'Format' ,'Font','FontSize','TextColor','BGColor'] },
                    { name: 'tools', items: [ 'Maximize' ] },
                    { name: 'others', items: [ '-' ] },
                    { name: 'about', items: [ 'About' ] }
                ]
                
    });   


    CKEDITOR.replace('synopsis', {
                filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
                width: 650,
                height:300,
                enterMode: 2,
                toolbar : [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
                    '/',
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                    { name: 'netclub', items: [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                    '/',
                    { name: 'styles', items: [ 'Styles', 'Format' ,'Font','FontSize','TextColor','BGColor'] },
                    { name: 'tools', items: [ 'Maximize' ] },
                    { name: 'others', items: [ '-' ] },
                    { name: 'about', items: [ 'About' ] }
                ]
                
    });   

    CKEDITOR.replace('available', {
                filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
                width: 650,
                height:300,
                enterMode: 2,
                toolbar : [
                    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
                    '/',
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                    { name: 'netclub', items: [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                    '/',
                    { name: 'styles', items: [ 'Styles', 'Format' ,'Font','FontSize','TextColor','BGColor'] },
                    { name: 'tools', items: [ 'Maximize' ] },
                    { name: 'others', items: [ '-' ] },
                    { name: 'about', items: [ 'About' ] }
                ]
                
    });   

    data_cover = $('.select_cover:checked').val();

    // auto set show and hide content auto
    if ( data_cover == 1 ) 
    {
        $('.set_cover_image').show( 'slow' );
        $('.set_cover_youtube').hide( 'fast' );
    } 
    else if ( data_cover == 2 )
    {
        $('.set_cover_youtube').show( 'slow' );
        $('.set_cover_image').hide( 'fast' );
    };
    
    // set cover show and hide content on click
    $('.select_cover').change(function(event) {
        if ( $(this).val() == 1 ) 
        {
            $('.set_cover_image').show( 'slow' );
            $('.set_cover_youtube').hide( 'fast' );
        } 
        else
        {
            $('.set_cover_youtube').show( 'slow' );
            $('.set_cover_image').hide( 'fast' );
        };
    });


});   


</script>












