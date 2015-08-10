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

                                        <div class="form-horizontal" >
                                            <div class="control-group">
                                                <label class="control-label">Name type</label>
                                                <div class="controls">
                                                    <input value="<?php echo $title = ( ! empty( $show_data['title'][$value->id] ) ) ? $show_data['title'][$value->id] : '' ; ?>" class="m-wrap span8" type="text" name="title[<?php echo $value->id ?>]" >
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


				                <div class="control-group">
				                    <label class="control-label">Order Sort</label>
				                    <div class="controls">
				                        <input name='order_sort' type="number" value="<?php echo $order_sort = ( ! empty( $show_data->order_sort ) ) ? $show_data->order_sort : '' ; ?>" class="span1 m-wrap" />
				                    </div>
				                </div>

				                <div class="control-group">
				                    <label class="control-label">Status</label>
				                    <div class="controls">
				                        <div class="basic-toggle-button">
				                            <input name="status" type="checkbox" class="toggle" <?php echo $status = ( ! empty( $show_data->status ) ) ? 'checked="checked"' : '' ; ?> value="1" />
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
                    <a class="btn" href="<?php echo site_url('site-admin/contactus/contact_type') ?>">Cancel</a>
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<!-- END PAGE CONTENT-->   



<script>
    

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

    detail_img = '<div class="main_c"> <div class="tn_c"> <a href="url"> <img title="" alt="" src="'+file.url+'" /> </a> </div> <input type="hidden" name="image" value="'+file.path+'"> </div>';

    $(this).html( detail_img );

} )

// end file cover 

</script>
