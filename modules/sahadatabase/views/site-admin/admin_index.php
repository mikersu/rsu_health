<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
<!-- BEGIN PAGE CONTAINER-->            
<div class="container-fluid">
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-edit"></i>Saha Database Data Table</h4>

                </div>
                <div class="portlet-body">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a class="btn green" href="<?php echo site_url('site-admin/sahadatabase/sahadatabase_add') ?>"> 
                                Add New <i class="icon-plus"></i>
                            </a>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered" id="">
                        <thead>
                            <tr>
                                <th>Cover image</th>
                                <th>Title Name</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>hilight</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ( $data_list as $key => $value ): ?>
                                
                                <tr class="">
                                    <td class="list_cover">

                                        <?php if ( $value->select_cover == 1 ): ?>
                                            
                                            <div class="main_c">
                                                <div class="tn_c">
                                                    <a >
                                                        <img title="" alt="" src="<?php echo base_url( $value->data_cover ) ?>" />
                                                    </a>
                                                </div>
                                            </div>  
                                            <img class="logo_list_show" src="<?php echo $this->theme_path.'image/image.png' ?>" alt="">

                                        <?php else: ?>

                                            <?php $json = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$value->data_cover."?v=2&alt=jsonc")); ?>
                                            
                                            <div class="main_c">
                                                <div class="tn_c">
                                                    <a >
                                                        <img title="" alt="" src="<?php echo $json->data->thumbnail->sqDefault ?>" />
                                                    </a>
                                                </div>
                                            </div>  
                                            <img class="logo_list_show" src="<?php echo $this->theme_path.'image/youtube.png' ?>" alt="">

                                        <?php endif ?>

                                    </td>
                                    <td>
                                        <?php echo $value->title ?>
                                    </td>
                                    <td>
                                        <?php echo date( 'd-m-Y' , $value->date ) ?>
                                    </td>
                                    <td>
                                        <?php echo $retVal = ( $value->type == 1 ) ? 'ภาพยนต์ไทย' : 'ภาพยนต์ต่างประเทศ' ; ?>
                                    </td>
                                    <th>
                                        <?php $retVal = ( $value->highlight == 1 ) ? 'ON' : 'OFF' ; ?>
                                        <b class="<?php echo $retVal; ?>" >
                                            <?php echo $retVal; ?>
                                        </b>
                                    </th>
                                    <th>
                                        <?php $retVal = ( $value->status == 1 ) ? 'ON' : 'OFF' ; ?>
                                        <b class="<?php echo $retVal; ?>" >
                                            <?php echo $retVal; ?>
                                        </b>
                                    </th>
                                    <td><a class="" href="<?php echo site_url('site-admin/sahadatabase/sahadatabase_edit/'.$value->id) ?>">Edit</a></td>
                                    <td><a data-url="<?php echo site_url( 'site-admin/sahadatabase/sahadatabase_delete/'.$value->id ) ?>" class="delete_data" href="javascript:;">Delete</a></td>
                                </tr>

                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER-->


<script type="text/javascript" >
    

    var oTable =   $('.table').dataTable( {
                                "aoColumns": [
                                    { "sWidth": "12%" },
                                    { "sWidth": "45%" },
                                    { "sWidth": "7%" },
                                    { "sWidth": "6%" },
                                    { "sWidth": "7%" },
                                    { "sWidth": "7%" },
                                    { "sWidth": "7%" },
                                    { "sWidth": "7%" }
                                ]
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
                    $('.before_show_log').before( html );    
                }
                else
                {
                    alert("Deleted Error ! , Please try again.");
                }


            }
        });

    });  

</script>