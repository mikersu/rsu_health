<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>

<!-- BEGIN PAGE CONTAINER-->            
<div class="container-fluid before_show_log">
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-edit"></i>Member Data Table</h4>

                </div>
                <div class="portlet-body">

                    <div class="clearfix">
                        <div class="btn-group">
                            <a class="btn green" href="<?php echo site_url( 'site-admin/member/member_add' ) ?>">
                                Add New
                                <i class="icon-plus"></i>
                            </a>
                        </div>

                    </div>

                    <table class="table table-striped table-hover table-bordered" id="mark_sort">
                        <thead>
                            <tr>
                                <th>Name & Lastname</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th style="with:2em;" >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ( $data_list as $key => $value ): ?>
                                
                            <tr class="">
                                <td><?php echo $value->account_fullname ?> </td>
                                <td><?php echo $value->account_email ?></td>
                                <td><?php echo $status = ( $value->account_status == 1 ) ? '<b class="ON"> ON </b>' : '<b class="OFF"> OFF </b>' ; ?></td>
                                <td>
                                    

                                    <?php  

                                    $url_edit = ( ! empty( $over_admin ) ) ? $over_admin.'/'.$value->account_id : site_url( 'site-admin/member/member_edit/'.$value->account_id ) ;


                                    ?>

                                    <a class="btn mini purple" title="Edit" href="<?php echo $url_edit ?>">
                                        <i class="icon-edit"></i>Edit 
                                    </a>

                                    <a class="delete_data btn mini black" data-url="<?php echo site_url( 'site-admin/member/member_delete/'.$value->account_id ) ?>" href="javascript:;">
                                        <i class="icon-trash"></i>Delete
                                    </a>

                                </td>
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
    

/*=============================================
=            Section comment datatable            =
=============================================*/

    var oTable = $('.table').dataTable( {
                        "aoColumns": [
                            { "sWidth": "25%" },
                            { "sWidth": "20%" },
                            { "sWidth": "5%" },
                            { "sWidth": "10%" }
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
                    $('.before_show_log').before( html );    
                }
                else
                {
                    alert("Deleted Error ! , Please try again.");
                }


            }
        });

    });  


/*-----  End of Section comment datatable  ------*/



</script>