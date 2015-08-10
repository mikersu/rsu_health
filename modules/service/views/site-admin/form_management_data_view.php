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
                                            <label class="control-label">Title</label>
                                            <div class="controls">
                                                <input name='title[<?php echo $value->id ?>]' type="text" value="<?php echo $title = ( ! empty( $show_data['title'][$value->id] ) ) ? $show_data['title'][$value->id] : '' ; ?>" class="span12 m-wrap" />
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Detail</label>
                                            <div class="controls">
                                                <textarea class="span12 this_ckeditor m-wrap" name="detail[<?php echo $value->id ?>]" rows="6"><?php echo $retVal = ( ! empty( $show_data['detail'][$value->id] ) ) ? $show_data['detail'][$value->id] : '' ; ?></textarea>
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

                                <!-- IMAGE COVER UPLOAD -->
                                <div class="control-group user_cover_image">
                                    <label class="control-label">Cover image upload</label>
                                    <div class="controls">
                                        <div class="upload_img_cover">

                                            <?php if ( ! empty( $show_data['image'] ) ): ?>

                                                <div class="main_c">
                                                    <div class="tn_c">
                                                        <a>
                                                            <img src="<?php echo base_url( $show_data['image'] ) ?>" alt="" title="" style="max-width: 20em;" >
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
                                        <span>ขนาดที่แนะนำ 460x306</span>
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

                <input type="hidden" name="category_id" value="<?php echo $retVal = ( ! empty( $category_id ) ) ? $category_id : '' ; ?>">

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


    $('.date-range-set').daterangepicker(
    { 

    },
    function(start, end, label) {

        date_start = start.toString("dd/MM/yyyy");
        date_end = end.toString("dd/MM/yyyy");

        $('input[name*="start_date"]').val( date_start );
        $('input[name*="end_date"]').val( date_end );

    }
    );



    <?php foreach ( $language as $key => $value ):  ?>

    CKEDITOR.replace('detail[<?php echo $value->id; ?>]', {
        filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
        height:300,
        enterMode: 2,
        toolbar : [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
            // { name: 'templates', items: [  'Templates' ] },
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

    jQuery(document).ready(function($) {
        
        $('.select2_sample1').select2({
            placeholder: "Select an option",
            allowClear: true
        });


    }); 

    
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

        detail_img = '<div class="main_c" style="max-height: none;" > <div class="tn_c"> <a > <img style="max-width: 20em;" title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image" value="'+file.path+'"> </div>';

        $(this).html( detail_img );

    } )

    // end file cover 








</script>
