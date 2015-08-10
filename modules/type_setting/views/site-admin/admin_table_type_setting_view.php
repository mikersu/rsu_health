<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>

<!-- BEGIN PAGE CONTAINER-->            
<div class="container-fluid before_show_log">
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <!-- Start form mark sort -->
            <?php $attributes = array( 'class' => 'form_intro_page' , 'title' => "table-content" ); ?>
            <?php echo form_open( site_url('site-admin/type_setting/mark_sort_type/'.$type) , $attributes); ?>

            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-edit"></i><?php echo $overset_sub_menu = ( ! empty( $overset_sub_menu ) ) ? $overset_sub_menu : '' ; ?> Data Table</h4>
                </div>
                <div class="portlet-body">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a class="btn green" href="<?php echo site_url('site-admin/type_setting/add_type/'.$type) ?>"> 
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
                                    <td>
                                        <?php if ( ! empty( $value->name_type ) ): ?>

                                        <?php foreach ( $value->name_type as $key_title => $value_title ): ?>
                                            <p><?php echo $value_title ?></p>
                                        <?php endforeach ?>
                                        
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <a title="Edit" class="btn mini purple" href="<?php echo site_url( 'site-admin/type_setting/edit_type/'.$type.'/'.$value->id ) ?>">
                                            <i class="icon-edit"></i>
                                            Edit
                                        </a>

                                        <a data-url="<?php echo site_url( 'site-admin/type_setting/type_setting_delete/'.$value->id ) ?>" class="delete_data btn mini black" href="javascript:;">
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