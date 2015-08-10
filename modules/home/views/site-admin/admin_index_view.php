<!-- ECHO ERROR -->
<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>
<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
<?php echo form_open( '', $attributes); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="tabbable tabbable-custom boxless">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">About Content</a></li>
                <li><a  href="#tab_2" data-toggle="tab">News Content</a></li>
                <li><a  href="#tab_3" data-toggle="tab">Banner Logo</a></li>
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
                                    <li><a href="#portlet_tab_setting" data-toggle="tab">Setting</a></li>    
                                    
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
                                            <label class="control-label">Title</label>
                                            <div class="controls">
                                                <input name='title[<?php echo $value->id ?>]' type="text" value="<?php echo $title = ( ! empty( $show_data['title'][$value->id] ) ) ? $show_data['title'][$value->id] : '' ; ?>" class="span12 m-wrap" />
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">Detail</label>
                                            <div class="controls">
                                                <textarea class="span12 this_ckeditor m-wrap" name="detail[<?php echo $value->id ?>]" rows="6"> <?php echo $detail = ( ! empty( $show_data['detail'][$value->id] ) ) ? $show_data['detail'][$value->id] : '' ; ?> </textarea>
                                            </div>
                                        </div>


                                    </div>
                                    

                                    <!--# END BLOCK COMMENT HTML BOX LANGUAGE #-->
                                        <?php $active = '' ?>   
                                    <?php endforeach ?>


                                    <div class="tab-pane <?php echo $active ?>" id="portlet_tab_setting">
                                        <h3 class="form-section" >About Setting</h3>
   

                                            <div class="control-group user_cover_image">
                                                <label class="control-label">Cover image upload</label>
                                                <div class="controls">
                                                    <div class="upload_img_cover">

                                                        <?php if ( ! empty( $show_data['image'] ) ): ?>

                                                            <div class="main_c" style="max-height: none;" >
                                                                <div class="tn_c">
                                                                    <a >
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
                                                    <span>ขนาดที่แนะนำ 300x300</span>
                                                </div>
                                            </div>        

                                            <div class="control-group">
                                                <label class="control-label">Link</label>
                                                <div class="controls">
                                                    <input type="text" name="link" value="<?php echo $link = ( ! empty( $show_data['link'] ) ) ? $show_data['link'] : '' ; ?>" >
                                                </div>
                                            </div>


                                    </div>

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
                            <div class="caption"><i class="icon-reorder"></i>Select news for show in page home</div>
                        </div>
                        <div class="portlet-body form" style="height: 23em;" >
                            <!-- BEGIN FORM-->
                        
                            <div class="form-horizontal" >

                                    <div class="control-group">
                                        <label class="control-label">Select News</label>
                                        <div class="controls">
                                            <?php $select = ( ! empty( $show_data['id_news_hover'] ) ) ? $show_data['id_news_hover'] : '' ; ?>
                                            <select data-placeholder="Your Favorite Football Team" name="id_news_hover" class="chosen" tabindex="-1" id="selS0V">

                                                <option value="">&nbsp;</option>
                                                <optgroup label="News">
                                                    <?php foreach ( $list_news as $key => $value ): ?>
                                                        <option <?php echo $retVal = ( $value->id == $select ) ? 'selected=""' : '' ; ?> value="<?php echo $value->id ?>" ><?php echo $value->title ?></option>
                                                    <?php endforeach ?>
                                                </optgroup>
                                                <optgroup label="Events">
                                                    <?php foreach ( $list_event as $key => $value ): ?>
                                                        <option <?php echo $retVal = ( $value->id == $select ) ? 'selected=""' : '' ; ?> value="<?php echo $value->id ?>" ><?php echo $value->title ?></option>
                                                    <?php endforeach ?>
                                                </optgroup>
      
                                            </select>
                                        </div>

                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">

                                            <span class="label label-important">NOTE!</span>
                                            <span> Please select a news item for show in home page </span>

                                        </div>
                                    </div>

                            </div>

                            <!-- END FORM--> 
                        </div>
                    </div>
                    
                    <!--# END BLOCK COMMENT HTML BOX CONTENT #-->
                </div>

                <div class="tab-pane" id="tab_3">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="icon-reorder"></i>Select image banner</div>
                        </div>
                        <div class="portlet-body form" style="" >
                            <!-- BEGIN FORM-->
                        
                            <div class="form-horizontal over-banner-logo" >

                                <div class="control-group">
                                    <label class="control-label">Gallery image logo upload</label>
                                    <div class="controls">
                                        <span data-url="<?php echo site_url('filemanager/image') ?>"  class="set_upload_file btn green fileinput-button">
                                            <i class="icon-plus icon-white"></i>
                                            <span>Add files image gallery...</span>
                                        </span>
                                        <span>ขนาดที่แนะนำ 150x150</span>
                                        <div>
                                            <span class="label label-important">NOTE!</span>
                                            <span> Please select image and can use reorder elements in a list using the move image. </span>
                                            
                                        </div>
                                        <hr>
                                        <div class="upload_img">

                                            <ul id="sortable">
                                            <?php if ( ! empty( $show_data['image_name_gallery'] ) ): ?>
                                                <?php foreach ( $show_data['image_name_gallery'] as $key => $value ): ?>
                                                    <li class="over-li-set" >
                                                    <div class="main_c">
                                                        <img class="trash_set set_bin_logo" src="<?php echo $this->theme_path.'image/b_close.png' ?>" alt="">
                                                        <div class="tn_c curser_move">
                                                            <a >
                                                                <img src="<?php echo base_url( $value ) ?>" alt="" title="">
                                                            </a>
                                                        </div>
                                                        <input type="hidden" value="<?php echo $value ?>" name="image_name_gallery[]">
                                                        <input class="box-image" type="text" name="image_title_gallery[]" value="<?php echo $show_data['image_title_gallery'][$key] ?>" >
                                                    </div>
                                                    </li>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            </ul>


                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- END FORM--> 

                        </div>
                    </div>

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

        $('#selS0V_chzn').attr('style', '');

        $( "#sortable , #sortable2" ).sortable();
        // $( "#sortable" ).disableSelection();

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

        detail_img = '<div class="main_c" style="max-height: none;" > <div class="tn_c"> <a > <img style="" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

        $( "#sortable" ).sortable();

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

        console.log( file );

        detail_img = '<li class="over-li-set" ><div class="main_c"> <img class="trash_set set_bin_logo" src="<?php echo $this->theme_path."image/b_close.png" ?>" alt=""> <div class="tn_c curser_move"> <a > <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image_name_gallery[]" value="'+file.path+'"><input class="box-image" type="text" name="image_title_gallery[]" > </div></li>';

        $('.upload_img ul').append( detail_img );    

    } )

    // end upload file album




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

    $('body').on('click', '.set_bin_logo', function(event) {
        
        $(this).parent().parent().remove();

    });


    $(window).load(function(){

        

    })

</script>
