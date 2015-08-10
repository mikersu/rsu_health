<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>
<div class="row-fluid">
	<div class="span12">
		<div class="tabbable tabbable-custom boxless">
			<ul class="nav nav-tabs">
				<?php foreach ( $language as $key => $value ): ?>
					<li <?php echo $action = ( $key == 0 ) ? 'class="active"' : '' ; ?> ><a href="#tab_<?php echo $value->id ?>" data-toggle="tab"><?php echo $value->language_name ?></a></li>
				<?php endforeach ?>
			</ul>
			<div class="tab-content">
				
				<?php foreach ( $language as $key_lang => $value_lang ): ?>
					
					<div class="tab-pane <?php echo $action = ( $key_lang == 0 ) ? 'active' : '' ; ?>" id="tab_<?php echo $value_lang->id ?>">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>Data Table Form Language <?php echo $value_lang->language_name ?></div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->

					            <?php $attributes = array( 'class' => 'form_intro_page' , 'title' => "table-content" ); ?>
					            <?php echo form_open( site_url('site-admin/philosophy/mark_sort_category') , $attributes); ?>

				                <div class="portlet-body">
				                    <div class="clearfix">
				                        <div class="btn-group">
				                            <a class="btn green" href="<?php echo site_url( 'site-admin/philosophy/add_category/'.$value_lang->id ) ?>"> 
				                                Add New <i class="icon-plus"></i>
				                            </a>

				                            <button name="mark_sort" value="sort" type="submit" style="display:none" class="btn red over_set_mark_sort mark_sort_<?php echo $value_lang->id ?>" > 
				                                Mark Sort <i class="icon-plus"></i>
				                            </button>

				                        </div>
				                    </div>
				                    <table class="table table-striped table-hover table-bordered" id="mark_sort_<?php echo $value_lang->id ?>">
				                        <thead>
				                            <tr>
				                                <th style="display:none" >id</th>
				                                <th>Name</th>
				                                <th>Action</th>
				                                <th>Status</th>
				                                <td>Sort</td>
				                            </tr>
				                        </thead>
				                        <tbody>

				                            <!-- // setting value -->    
				                            <?php $data_list[$value_lang->id] = ( ! empty( $data_list[$value_lang->id] ) ) ? $data_list[$value_lang->id] : array() ; ?>  
				                            <?php $index_id = 1 ?>
				                            <?php foreach ( $data_list[$value_lang->id] as $key => $value ): ?>
											<tr class="">
				                                    <td style="display:none" ><?php echo $value->order_sort ?></td>
				                                   	<td style="width: 25em;"> 
														<?php echo $value->title;?>
				                                   	</td>
				                                    <td style="width: 3em;">
				                                    	
				                                        <a title="Edit" class="btn mini purple" href="<?php echo site_url( 'site-admin/philosophy/add_category/'.$value_lang->id.'/'.$value->id ) ?>">
				                                            <i class="icon-edit"></i>
				                                            Edit
				                                        </a>

														<a data-url="<?php echo site_url( 'site-admin/philosophy/del_category/'.$value->id ) ?>" class="delete_data btn mini black" href="javascript:;">
				                                            <i class="icon-trash"></i>
															Delete
				                                        </a>

				                                    </td>
				                                    <td style="width: 1em;">
															<?php  

															if ( $value->status == 1 ) 
															{
																echo '<b class="ON"> ON </b>';
															} 
															else if ( $value->status == 2 ) 
															{
																echo '<b class="ON"> ON ( TIME )</b>';
															}
															else 
															{
																echo '<b class="OFF"> OFF </b>';
															}
															
															?>
				                                    </td>    
				                                    <td style="width: 1em;" class="dragHandle"> <input type="hidden" class="array_id" name="id[]" value="<?php echo $value->id ?>"> </td>
				                                </tr>

				                                <!-- // set index value -->
				                                <?php $index_id++ ?>

				                            <?php endforeach ?>

				                        </tbody>
				                    </table>
				                </div>

								<?php echo form_close(); ?>


								<!-- END FORM--> 
							</div>
						</div>
					</div>

				<?php endforeach ?>

			</div>
		</div>
	</div>
</div>





<script type="text/javascript" >

$(function() {



	<?php foreach ( $language as $key => $value ): ?>
		
	    var table = document.getElementById('mark_sort_<?php echo $value->id ?>');
	    var tableDnD = new TableDnD();
	    tableDnD.init(table);

	    tableDnD.onDrop = function( table , row ) {
	        $('.mark_sort_<?php echo $value->id ?>').show();
	    }

	    tableDnD.serialize('array_id');


    var oTable_<?php echo $value->id ?> = $('#mark_sort_<?php echo $value->id ?>').dataTable( {
            "aoColumns": [
                { "sWidth": "1%" },
                { "sWidth": "25em" },
                { "sWidth": "10em" },
                { "sWidth": "1em" },
                { "sWidth": "1em" }
            ],
            "bSort": false,
    } );


	<?php endforeach ?>


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


    <?php foreach ( $language as $key => $value ): ?>

    $('.table#mark_sort_<?php echo $value->id ?> a.delete_data').live('click', function (e) {
        
        e.preventDefault();

        if (confirm("Are you sure to delete this row ? ") == false) 
        {
            return;
        }

        set_url = window.location.origin;

        data_url = $(this).attr( 'data-url' );

        var c_this = $(this);

        // var nRow = c_this.parents('tr')[0];
        // oTable_<?php echo $value->id ?>.fnDeleteRow(nRow);

        $.ajax({
            type: "GET",
            url: data_url,
            success: function(data) 
            {  
                if ( data == 1 ) 
                {
                    var nRow = c_this.parents('tr')[0];

                    oTable_<?php echo $value->id ?>.fnDeleteRow(nRow);                    
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

	<?php endforeach ?>


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





