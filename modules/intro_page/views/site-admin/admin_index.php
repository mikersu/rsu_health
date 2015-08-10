<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>

<!-- BEGIN PAGE CONTAINER-->            
<div class="container-fluid before_show_log">
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <!-- Start form mark sort -->
            <?php $attributes = array( 'class' => 'form_intro_page' , 'title' => "table-content" ); ?>
            <?php echo form_open( site_url('site-admin/intro_page/mark_sort') , $attributes); ?>

            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-edit"></i>Intro Page Data Table</h4>
                </div>
                <div class="portlet-body">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a class="btn green" href="<?php echo site_url('site-admin/intro_page/intro_page_add') ?>"> 
                                Add New <i class="icon-plus"></i>
                            </a>

                            <button name="mark_sort" value="sort" type="submit" style="display:none" class="btn red mark_sort" > 
                                Mark Sort <i class="icon-plus"></i>
                            </button>

                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="mark_sort">
                        <thead>
                            <tr>
                                <th style="display:none" >id</th>
                                <th>Image</th>
                                <th>Title Name</th>
                                <th>Action</th>
                                <th>Status</th>
                                <td>Sort</td>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- // setting value -->
                            <?php $index_id = 1 ?>
                            <?php foreach ( $data_list as $key => $value ): ?>
            

                                <tr class="">
                                    <td style="display:none" ><?php echo $value->order_sort ?></td>
                                    <td id='call_cover_image_home'>
                                        <?php  

                                                switch ( $value->select_cover ) 
                                                {
                                                    case '1': // image
                                                                
                                                        echo $html = '
                                                                <div class="main_c">
                                                                    <div class="tn_c">
                                                                        <a>
                                                                            <img class="show_img_youtube hover_video cursor_pointer" href="'.base_url( $value->image_name_cover ).'" src="'.base_url( $value->image_name_cover ).'" alt="" title="">
                                                                        </a>
                                                                    </div>
                                                                </div>';
                                                        $icon = '<div class="call_image" ></div>';             
                                                        break;
                                                    case '2': // youtube

                                                        $json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$value->youtube_id_cover."?v=2&alt=jsonc"));
                                                    
                                                        echo $html = '
                                                                <div class="main_c">
                                                                    <div class="tn_c">
                                                                        <a>
                                                                            <img class="show_img_youtube hover_video cursor_pointer fancybox.ajax" href="'.site_url( 'popup/youtube_url?data_video='.rawurlencode( $json->data->player->default ) ).'" src="'.$json->data->thumbnail->sqDefault.'" alt="" title="">
                                                                        </a>
                                                                    </div>
                                                                </div>';    

                                                        $icon = '<div class="call_youtube" ></div>';     

                                                        break;
                                                    case '3': // video

                                                        echo $html = '
                                                                <div class="main_c">
                                                                    <div class="tn_c">
                                                                        <a>
                                                                            <img class="show_img_youtube hover_video cursor_pointer fancybox.ajax" href="'.base_url( 'popup?data_video='.$value->file_video_cover ).'" src="'.$this->theme_path.'image/my_video.png" alt="" title="">
                                                                        </a>
                                                                    </div>
                                                                </div>';   

                                                        $icon = '<div class="call_video" ></div>'; 

                                                        break;        
                                                    
                                                    default:
                                                        $icon = '( Textediter )';
                                                        break;
                                                }




                                        ?>


                                    </td>
                                    <td><?php echo $icon ?><span class="call_text_icon"><?php echo $value->title ?></span></td>
                                    <td>
                                        <a href="<?php echo site_url( 'site-admin/intro_page/intro_page_edit/'.$value->id ) ?>" class="btn mini purple" title="Edit">
                                            <i class="icon-edit"></i>
                                            Edit
                                        </a>
                                                      
                                        <a href="javascript:;" class="delete_data btn mini black" data-url="<?php echo site_url( 'site-admin/intro_page/intro_page_delete/'.$value->id ) ?>">
                                            <i class="icon-trash"></i>
                                            Delete
                                        </a>
                                    </td>
                                    <td>
                                        <?php $retVal = ( $value->status == 1 ) ? 'ON' : 'OFF' ; ?>
                                        <b class="<?php echo $retVal ?>"> <?php echo $retVal ?> </b>
                                    </td>    
                                    <td class="dragHandle"> <input type="hidden" class="array_id" name="id[]" value="<?php echo $value->id ?>"> </td>
                                </tr>

                                <!-- // set index value -->
                                <?php $index_id++ ?>

                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER-->

<script type="text/javascript" >

$(document).ready(function() {

    var table = document.getElementById('mark_sort');
    var tableDnD = new TableDnD();
    tableDnD.init(table);

    // tableDnD.onDrop = function( table , row ) {
    //     $('.mark_sort').show();
    // }

    tableDnD.serialize('array_id');

});

$(function() {

    window.data_change = true;

    window.input_change = false;

    // check input change has change value
    $('input[name*="slug"]').keyup(function () { 
        window.input_change = true;
    });
    $('input[name*="tag_keywords"]').keyup(function () { 
        window.input_change = true;
    });
    $('input[name*="tag_description"]').keyup(function () { 
        window.input_change = true;
    });
    // end check input


    $('.mark_change').click(function(event) {
        window.data_change = false;
    });


    
    var oTable = $('.table').dataTable( {
            "aoColumns": [
                { "sWidth": "1%" },
                { "sWidth": "10%" },
                { "sWidth": "50%" },
                { "sWidth": "15%" },
                { "sWidth": "5%" },
                { "sWidth": "5%" }
            ],
            "bSort": false,


    } );

    $('.table a.delete_data').live('click', function (e) {
        
        e.preventDefault();

        if (confirm("Are you sure to delete this row ? ") == false) 
        {
            return;
        }

        set_url = window.location.origin;

        data_url = $(this).attr( 'data-url' );

        var c_this = $(this);

        var nRow = c_this.parents('tr')[0];
        oTable.fnDeleteRow(nRow);

        $.ajax({
            type: "GET",
            url: data_url,
            success: function(data) 
            {  
                if ( data == 1 ) 
                {
                    var nRow = c_this.parents('tr')[0];
                    oTable.fnDeleteRow(nRow);                    
                    // alert("Deleted Success !");
                    html = ''; 
                    html += '<div class="alert alert-success">';
                    html += '<button class="close" data-dismiss="alert"></button>';
                    html += '<strong>Success! </strong>';
                    html += 'The page has been save success.';
                    html += '</div>';
                    $('.portlet.box.blue').before( html );    
                }
                else
                {
                    alert("Deleted Error ! , Please try again.");
                }


            }
        });

    });  


/*-----  End of Section comment datatable  ------*/

    $('.hover_video').fancybox({
        
            padding: 0,
            openEffect : 'elastic',
            openSpeed  : 150,
            scrolling : "no",
            closeEffect : 'elastic',
            closeSpeed  : 150,

    });


});

</script>