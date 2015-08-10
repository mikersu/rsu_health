<!-- BEGIN PAGE CONTAINER-->            
<div class="container-fluid before_show_log">
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

			<div class="clearfix">
			    <div class="btn-group">
			        <a  class="btn grey" href="<?php echo site_url( 'site-admin/member' ) ?>">
			           <span class="icon-angle-left"></span> back
			        </a>
			    </div>
			</div>
			<br>

            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-edit"></i>Generation Setting</h4>

                </div>
                <div class="portlet-body">


	                    <div class="clearfix">
	                        <div class="btn-group">
	                            <a class="btn green" href="<?php echo site_url( 'site-admin/member/generation_add' ) ?>">
	                                Add New
	                                <i class="icon-plus"></i>
	                            </a>
	                        </div>
	                    </div>
						
	                    <table class="table table-striped table-hover table-bordered dataTable">
	                    	<thead>
	                    		<tr>
	                    			<th style="text-align: center; width: 70%; " >รุ่น </th>
	                    			<th style="text-align: center;" >Status </th>
	                    			<th style="text-align: center;" >Action </th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
	                    		<?php if ( ! empty( $data_list ) ): ?>
	                    			
	                    			<?php foreach ( $data_list as $key => $value ): ?>
			                    		<tr>
			                    				
		                    				<td style="text-align: center;"><?php echo $value->generation_name ?></td>
		                    				<td><?php echo $status = ( $value->status == 1 ) ? '<b class="ON"> ON </b>' : '<b class="OFF"> OFF </b>' ; ?></td>
		                    				<td><a href="<?php echo site_url( 'site-admin/member/generation_edit/'.$value->id ) ?>">Edit Generation</a> | <a data-url="<?php echo site_url( 'site-admin/member/generation_delete/'.$value->id ) ?>" class="delete_data" href="javascript:;">Delete Generation</a></td>

			                    		</tr>
	                    			<?php endforeach ?>
	                    			
	                    		<?php else: ?>
										<tr>
			                    				
		                    				<td colspan="3" style="text-align: center;">ไม่มีข้อมูล</td>

			                    		</tr>

	                    			
	                    		<?php endif ?>
	                    	</tbody>
	                    </table>
						
                </div>


            </div>
            <!-- END EXAMPLE TABLE PORTLET-->



            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <h4><i class="icon-edit"></i>Business Type Setting</h4>

                </div>
                <div class="portlet-body">


	                    <div class="clearfix">
	                        <div class="btn-group">
	                            <a class="btn green" href="<?php echo site_url( 'site-admin/member/business_type_add' ) ?>">
	                                Add New
	                                <i class="icon-plus"></i>
	                            </a>
	                        </div>
	                    </div>
						
	                    <table class="table table-striped table-hover table-bordered dataTable">
	                    	<thead>
	                    		<tr>
	                    			<th style="text-align: center; width: 70%; " >ประเภทธุรกิจ </th>
	                    			<th style="text-align: center;" >Status </th>
	                    			<th style="text-align: center;" >Action </th>
	                    		</tr>
	                    	</thead>
	                    	<tbody>
	                    		<?php if ( ! empty( $data_list_type ) ): ?>
	                    			
	                    			<?php foreach ( $data_list_type as $key => $value ): ?>
			                    		<tr>
			                    				
		                    				<td style="text-align: center;"><?php echo $value->business_type_name ?></td>
		                    				<td><?php echo $status = ( $value->status == 1 ) ? '<b class="ON"> ON </b>' : '<b class="OFF"> OFF </b>' ; ?></td>
		                    				<td><a href="<?php echo site_url( 'site-admin/member/business_type_edit/'.$value->id ) ?>">Edit Type</a> | <a data-url="<?php echo site_url( 'site-admin/member/business_type_delete/'.$value->id ) ?>" class="delete_data" href="javascript:;">Delete Type</a></td>

			                    		</tr>
	                    			<?php endforeach ?>
	                    			
	                    		<?php else: ?>
										<tr>
			                    				
		                    				<td colspan="3" style="text-align: center;">ไม่มีข้อมูล</td>

			                    		</tr>

	                    			
	                    		<?php endif ?>
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


<script>
	

jQuery(document).ready(function($) {
	

    $('.table a.delete_data').live('click', function (e) {
        
        e.preventDefault();


        if (confirm("Are you sure to delete this row ? ") == false) 
        {
            return;
        }

        set_url = window.location.origin;

        data_url = $(this).attr( 'data-url' );

        var c_this = $(this);

        $.ajax({
            type: "GET",
            url: data_url,
            success: function(data) 
            {  
                if ( data == 1 ) 
                {
                    c_this.parent().parent().fadeOut('slow');  	                 
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



});

</script>

