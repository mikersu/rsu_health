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
												<label class="control-label">Name Type</label>
												<div class="controls">
													<input value="<?php echo $name_type = ( ! empty( $show_data['name_type'][$value->id] ) ) ? $show_data['name_type'][$value->id] : '' ; ?>" class="m-wrap span8" type="text" name="name_type[<?php echo $value->id ?>]" >
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
									<label class="control-label">Status</label>
									<div class="controls">
										<div class="basic-toggle-button">
											<input name="status" type="checkbox" class="toggle" <?php echo $status = ( ! empty( $show_data['status'] ) ) ? 'checked="checked"' : '' ; ?> value="1" />
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
					<a class="btn" href="<?php echo site_url('site-admin/type_setting/table_type/'.$type) ?>">Cancel</a>
				</div>

			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<!-- END PAGE CONTENT-->   








