<!-- ECHO ERROR -->
<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
<?php echo form_open( '', $attributes); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="tabbable tabbable-custom boxless">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Content</a></li>
                <li><a  href="#tab_2" data-toggle="tab">Other setting</a></li>
            </ul>
            <div class="tab-content">



                <div class="tab-pane active" id="tab_1">

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

                                    <div class="control-group">
                                        <label class="control-label">Sub Menu</label>
                                        <div class="controls">
                                            <input name='submenu[<?php echo $value->id ?>]' type="text" value="<?php echo $submenu = ( ! empty( $show_data['submenu'][$value->id] ) ) ? $show_data['submenu'][$value->id] : '' ; ?>" class="span12 m-wrap" />
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label">Title</label>
                                        <div class="controls">
                                            <input name='title[<?php echo $value->id ?>]' type="text" value="<?php echo $title = ( ! empty( $show_data['title'][$value->id] ) ) ? $show_data['title'][$value->id] : '' ; ?>" class="span12 m-wrap" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">URI</label>
                                        <div class="controls">
                                            <input name='slug' type="text" value="<?php echo $slug = ( ! empty( $show_data['slug'] ) ) ? $show_data['slug'] : '' ; ?>" class="span12 m-wrap input_slug" />
                                        </div>
                                    </div>


                                    <div class="control-group display_none" >
                                        <label class="control-label">Description</label>
                                        <div class="controls">
                                            <input name='description[<?php echo $value->id ?>]' type="text" value="<?php echo $description = ( ! empty( $show_data['description'][$value->id] ) ) ? $show_data['description'][$value->id] : '' ; ?>" class="span12 m-wrap" />
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label">Detail</label>
                                        <div class="controls">
                                            <textarea class="span12 this_ckeditor m-wrap" name="detail[<?php echo $value->id ?>]" rows="6"> <?php echo $detail = ( ! empty( $show_data['detail'][$value->id] ) ) ? $show_data['detail'][$value->id] : '' ; ?> </textarea>
                                        </div>
                                    </div>



                                    <div class="portlet-title-more">
                                        <h4><i class="icon-reorder"></i>SEO setting</h4>
                                    </div>

                                    <div class="form-horizontal" >

                                        <h3 class="form-section">SEO Language <?php echo $value->language_name ?></h3>

                                        <div class="control-group">
                                            <label class="control-label">Tag Title</label>
                                            <div class="controls">
                                                <input class="span12 detail_home m-wrap" name="seotag[<?php echo $value->id ?>][title]" value="<?php echo $retVal = ( ! empty( $show_data['seotag'][$value->id]['title'] ) ) ? $show_data['seotag'][$value->id]['title'] : '' ; ?>" >
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Tag Description</label>
                                            <div class="controls">
                                                <input class="span12 detail_home m-wrap" name="seotag[<?php echo $value->id ?>][description]" value="<?php echo $retVal = ( ! empty( $show_data['seotag'][$value->id]['description'] ) ) ? $show_data['seotag'][$value->id]['description'] : '' ; ?>" >
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Tag Keyword</label>
                                            <div class="controls">
                                                <input class="span12 detail_home m-wrap" name="seotag[<?php echo $value->id ?>][keywords]" value="<?php echo $retVal = ( ! empty( $show_data['seotag'][$value->id]['keywords'] ) ) ? $show_data['seotag'][$value->id]['keywords'] : '' ; ?>" >
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!--# END BLOCK COMMENT HTML BOX LANGUAGE #-->
                                <?php $active = '' ?>   
                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
            </div>

            <!--# END BLOCK COMMENT HTML BOX CONTENT #-->

        </div>

        <div class="tab-pane" id="tab_2">

                    <!--
                    #
                    ##### START BLOCK COMMENT HTML BOX CONTENT
                    #
                -->

                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>Setting</div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <div class="form-horizontal" >

                            <div class="control-group user_cover_image display_none" >
                                <label class="control-label">Image backgroud</label>
                                <div class="controls">
                                    <div class="upload_img_cover">

                                        <?php if ( ! empty( $show_data['image'] ) ): ?>

                                            <div class="main_c">
                                                <div class="tn_c">
                                                    <a>
                                                        <img src="<?php echo base_url( $show_data['image'] ) ?>" alt="" title="">
                                                    </a>
                                                </div>
                                                <input type="hidden" value="<?php echo $show_data['image'] ?>" name="image">
                                            </div>

                                        <?php endif ?>

                                    </div>
                                    <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file_cover btn green fileinput-button">
                                        <i class="icon-plus icon-white"></i>
                                        <span>Add files...</span>
                                    </span>
                                    <span>ขนาดที่แนะนำ 735x500</span>
                                </div>
                            </div>

                            <!-- START GALLERY IMAGE UPLOAD -->
                            <div class="control-group"> 
                                <label class="control-label">Gallery image upload</label>
                                <div class="controls">
                                    <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file btn green fileinput-button">
                                        <i class="icon-plus icon-white"></i>
                                        <span>Add files image gallery...</span>
                                    </span>
                                    <span>ขนาดที่แนะนำ 554x350</span>
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
                            </div> <!-- END GALLERY IMAGE UPLOAD -->
                            <div class="control-group display_none" >
                                <label class="control-label">Select cover</label>
                                <?php $show_data['select_cover'] = ( empty( $show_data['select_cover'] ) ) ? 1 : $show_data['select_cover'] ; ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" class="select_cover" name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] ==1 ) ? 'checked="checked"' : '' ; ?> value="1" />
                                        Cover by youtube url 
                                    </label>  
                                    <label class="radio">
                                        <input type="radio" class="select_cover" name="select_cover" <?php echo $retVal = ( $show_data['select_cover'] ==2 ) ? 'checked="checked"' : '' ; ?> value="2" />
                                        Cover by video 
                                    </label>  
                                </div>
                            </div>


                            <!-- VIDEO COVER -->
                            <div class="control-group set_cover_video">
                                <label class="control-label">Cover video upload</label>
                                <div class="controls">
                                    <span data-url="<?php echo site_url( 'filemanager/video' ) ?>"  class="set_upload_file_video_cover btn green fileinput-button">
                                        <i class="icon-plus icon-white"></i>
                                        <span>Add files video...</span>
                                    </span>
                                    <div class="upload_video_cover" id="upload_file_video">

                                        <?php if ( ! empty( $show_data['file_video'] ) ): ?>

                                            <div class="box_show_youtube box_show_video">
                                                <input type="hidden" name="file_video" value="<?php echo $show_data['file_video_cover'] ?>" >
                                                <img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo base_url() ?>/popup?data_video=<?php echo $show_data['file_video'] ?>" alt="" src="<?php echo $this->theme_path ?>image/my_video.png">
                                                <span class="video_name" ><?php echo $show_data['file_video'] ?></span>
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
                            <div class="control-group display_none">
                                <label class="control-label">About Date</label>

                                <div class="controls">
                                    <input class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php echo $about_date = ( ! empty( $show_data['about_date'] ) ) ? $show_data['about_date'] : '' ; ?>" size="16" readonly="" name="about_date">
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

                        </div>

                        <!-- END FORM--> 
                    </div>
                </div>

                <!--# END BLOCK COMMENT HTML BOX CONTENT #-->

            </div>


            <div class="">
                <button type="submit" class="btn blue">Submit</button>
                <a class="btn cursor_pointer" onclick="history.go(-1);" >Cancel</a>
            </div>

        </div>
    </div>
</div>
</div>
<?php echo form_close(); ?>
<!-- END PAGE CONTENT-->   


<script>

    jQuery(document).ready(function($) {
        $('input[name*="slug"]').change(function(event) {
            a = $(this).val();
            $('input[name*="slug"]').val( a );
        });
    });




    CKEDITOR.config.contentsCss = [ 
    '<?php echo $this->theme_path."../ape/css/reset.css" ?>' ,
    '<?php echo $this->theme_path."../ape/css/font.css" ?>' ,
    '<?php echo $this->theme_path."../ape/css/about_editer.css" ?>' ,
    '<?php echo $this->theme_path."../ape/css/default.css" ?>', 
    ];
    
    // CKEDITOR.config.contentsJs = "http://localhost/ape_html/public/css/front.js";   //ok use

    <?php foreach ( $language as $key => $value ):  ?>

    CKEDITOR.replace('detail[<?php echo $value->id; ?>]', {
        filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
        height:300,
        enterMode: 2,
        toolbar : [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
        { name: 'templates', items: [  'Templates' ] },
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

<?php endforeach ?>

    /**
    *
    *** START CHECK STATUS 
    *
    **/
    a_set = parseInt( $('input[name="status"]:checked').val() );

    if ( a_set == 2 ) 
    {
        $('.advance_time').show('slow');
    }
    else
    {
        $('.advance_time').hide('slow');
    }
    
    $('input[name="status"]').click(function(event) {
        a = parseInt( $(this).val() );
        if ( a == 2 ) 
        {
            $('.advance_time').show('slow');
        }
        else
        {
            $('.advance_time').hide('slow');
        }

    });
    
    /** END CHECK STATUS  **/
    
    // -------------------------------------


    
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

        detail_img = '<div class="main_c" style="max-height: none;" > <div class="tn_c"> <a > <img style="max-width: 41em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // end file cover 

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

        detail_img = '<div class="main_c"> <img class="trash_set set_bin" src="<?php echo $this->theme_path."image/b_close.png" ?>" alt=""> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="name_image[]" value="'+file.path+'"> </div>';

        $(this).append( detail_img );    

    } )


    /**
    *
    * Block comment file video cover 
    *
    **/
    $('.set_upload_file_video_cover').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object =$('#upload_file_video');

    });

    $('#upload_file_video').on( 'getFileCallback' , function( event , file ){

        detail_video = '<div class="box_show_youtube box_show_video"><input type="hidden" name="file_video" value="'+rawurlencode( file.path )+'" ><img class="show_img_youtube call_show_video cursor_pointer hover_video fancybox.ajax" href="<?php echo site_url("popup") ?>?data_video='+rawurlencode( file.path )+'" alt="" src="<?php echo $this->theme_path ?>image/my_video.png"> <span class="video_name" >name video</span> <span class="glyphicons no-js bin cursor_pointer set_bin" title="Remove this box"><i></i>Remove</span><div style="clear: both;"></div></div>';

        $(this).html( detail_video );
        $('.video_name').html( file.name )


    } );

    // end file cover  

    /**
    *
    *** START CHECK STATUS 
    *
    **/
    a_set = parseInt( $('input[name="status"]:checked').val() );

    if ( a_set == 2 ) 
    {
        $('.advance_time').show('slow');
    }
    else
    {
        $('.advance_time').hide('slow');
    }
    
    $('input[name="status"]').click(function(event) {
        a = parseInt( $(this).val() );
        if ( a == 2 ) 
        {
            $('.advance_time').show('slow');
        }
        else
        {
            $('.advance_time').hide('slow');
        }

    });
    
    /** END CHECK STATUS  **/
    
    // -------------------------------------


    data_cover = $('.select_cover:checked').val();

    // auto set show and hide content auto
    switch(data_cover){
        case '2':
        $('.set_cover_video').show( 'fast' );
        $('.set_cover_youtube').hide( 'fast' );
        break;
        default:
        $('.set_cover_video').hide( 'fast' );
        $('.set_cover_youtube').show( 'fast' );
    }

    // set cover show and hide content on click
    $('.select_cover').change(function(event) {
        switch($(this).val()){
            case '2':
            $('.set_cover_video').show( 'slow' );
            $('.set_cover_youtube').hide( 'fast' );
            break;
            default:
            $('.set_cover_video').hide( 'fast' );
            $('.set_cover_youtube').show( 'slow' );
        }
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


    $('body').on('click', '.set_bin', function(event) {

        $(this).parent().remove();

    });
    

</script>
