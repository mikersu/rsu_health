<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>

<!-- BEGIN PAGE CONTAINER-->			
<div class="container-fluid before_show_log">
	<!-- BEGIN PAGE CONTENT-->
	<div class="row-fluid">
		<div class="span12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<h4><i class="icon-edit"></i>language Data Table</h4>

				</div>

				<div class="portlet-body">
					<div class="clearfix">
						<div class="btn-group">
							<a class="btn green" href="<?php echo site_url('site-admin/lang/lang_form') ?>"> 
								Add New <i class="icon-plus"></i>
							</a> 
						</div>
					</div>

					<table class="table table-striped table-hover table-bordered" id="">

						<thead>
							<tr>
								<th>id</th>
								<th>language</th>
								<th>Action</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ( $show_data as $key => $value ): ?>
								
								<tr>
									<td><?php echo $key+1 ?></td>
									<td><?php echo $value->language_name.' - '.$value->language_code ?> <?php echo $default = ( $this->lang_model->get_lang_default() == $value->id ) ? '( default )' : '' ; ?> </td>
									<td>  
										<a href="<?php echo site_url( 'site-admin/lang/lang_form/'.$value->id ) ?>">EDIT</a> &nbsp; | &nbsp;
										<a class="delete_data" href="<?php echo site_url( 'site-admin/lang/delete_lang/'.$value->id ) ?>">DELETE</a>
									</td>
									<td>

										<?php  

										if ( $value->status == 1 ) 
										{
											echo '<b class="ON"> ON </b>';
										} 
										else 
										{
											echo '<b class="OFF"> OFF </b>';
										}
										
										?>	

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


<script>
	

jQuery(document).ready(function($) {
	
	$('.delete_data').click(function(event) {

		var link_url = $(this).attr( 'href' );
		var this_object = $(this);
		
		if ( confirm( 'Are you sure to delete this row ?' ) ) 
		{
			$.ajax({
			    url: link_url ,
			    type: "GET" ,
			    processData: true ,
			    success: function( data ) 
			    { 
			    	if (data == '1') 
			    		{
							this_object.parent().parent().fadeOut('slow');	
			    		}
			    		else
			    		{
			    			alert( "Can't delete language default, Please select another language" )
			    		}
			    }
			});
		}


		return false;

	});



});



</script>




