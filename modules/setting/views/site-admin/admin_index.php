<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>
<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXTRAS PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <h4><i class="icon-reorder"></i>Setting other</h4>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->


                <?php $attributes = array( 'class' => 'form-horizontal' ); ?>
                <?php echo form_open( '', $attributes); ?>

                <input type="hidden" name="overset">
                <div class="control-group">
                    <label class="control-label" style="padding-top: 0;" >List Folder</label>
                        <div class="controls">
                            <?php foreach ( $list_file as $key => $value ): ?>
                                <?php echo $value; ?>
                            <?php endforeach ?>
                        </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn blue">Delete Cache</button>
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


    $('.set_upload_file_header').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.public_header_image')

    })


    $('.public_header_image').on( 'getFileCallback' , function( event , file ){

      html = '<img src="'+file.url+'" class="thm_show_image overset_ico_logo" alt=""> <input type="hidden" name="setting_ico_logo" value="'+file.path+'"> <br> <span class="glyphicons no-js bin cursor_pointer" title="Remove this box"> <i></i> Remove </span>';
      $(this).html( html );

    } )



    $('.set_upload_file_body').click(function(){

        set_open = window.open($(this).attr('data-url'),'popup','directories=no,titlebar=no,toolbar=no,location=on,status=no,menubar=no,scrollbars=yes,resizable=no,width=820,height=620');

        set_open.target_object = $('.public_body_backgroud')

    })

    $('.public_body_backgroud').on( 'getFileCallback' , function( event , file ){
      
      html = '<img src="'+file.url+'" class="thm_show_image bb" alt=""> <input type="hidden" name="setting_image_intro" value="'+file.path+'"> <br> <span class="glyphicons no-js bin cursor_pointer" title="Remove this box"> <i></i> Remove </span>';
      $(this).html( html );

    } )    


    $('.controls').on('click', '.bin', function(event) {
      $(this).parent().html('')
    });

});   


</script>












