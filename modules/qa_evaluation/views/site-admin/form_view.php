<!-- ECHO ERROR -->
<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
<?php echo form_open( '', $attributes); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="tabbable tabbable-custom boxless">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Content</a></li>
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

                                    <div class="control-group display_none">
                                        <label class="control-label">QA_Evaluation Date</label>

                                        <div class="controls">
                                            <input class="m-wrap m-ctrl-medium date-picker" type="text" value="<?php echo $qa_evaluation_date = ( ! empty( $show_data['qa_evaluation_date'] ) ) ? $show_data['qa_evaluation_date'] : '' ; ?>" size="16" readonly="" name="qa_evaluation_date">
                                        </div>
                                    </div>

                                    <!--SEO setting Start -->

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

                                    <!--SEO setting End -->

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

        <div class="control-group">
            <label class="control-label">Status</label>
            <div class="controls">
                <div class="basic-toggle-button">
                    <input name="status" type="checkbox" class="toggle" <?php echo $status = ( ! empty( $show_data['status'] ) ) ? 'checked="checked"' : '' ; ?> value="1" />
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
    });

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
    
    
    $('body').on('click', '.set_bin', function(event) {

        $(this).parent().remove();

    });
    

</script>
