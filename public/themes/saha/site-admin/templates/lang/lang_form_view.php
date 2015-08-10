<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<div class="row-fluid">
   <div class="span12">
	  <!-- BEGIN EXTRAS PORTLET-->
	  <div class="portlet box blue">
		 <div class="portlet-title">
			<h4><i class="icon-reorder"></i>Detail in language</h4>
		 </div>
		 <div class="portlet-body form">
			<!-- BEGIN FORM-->
			
            <?php $attributes = array( 'class' => 'form-horizontal' ); ?>
			<?php echo form_open( '', $attributes); ?>

			<div class="control-group">
				<label class="control-label">language Name</label>
				<div class="controls">
					<input name='language_name' type="text" value="<?php echo $language_name = ( ! empty( $show_data->language_name ) ) ? $show_data->language_name : '' ; ?>" class="span6 m-wrap" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">language Code</label>
				<div class="controls">
				<input name='language_code' type="text" value="<?php echo $language_code = ( ! empty( $show_data->language_code ) ) ? $show_data->language_code : '' ; ?>" class="span6 m-wrap" />
				</div>
			</div>

			<div class="control-group">
			    <label class="control-label">language Default</label>
			    <div class="controls">
			        <div class="basic-toggle-button">
			            <input name="language_default" type="checkbox" class="toggle" <?php echo $lang_hover = (  $this->lang_model->get_lang_default() == $id ) ? 'checked="checked"' : '' ; ?>  value="<?php echo $id ?>" />
			        </div>
			    </div>
			</div>

			<div class="control-group">
			    <label class="control-label">Status</label>
			    <div class="controls">
			        <div class="basic-toggle-button">
			            <input name="status" type="checkbox" class="toggle" <?php echo $account_status = ( ! empty( $show_data->status ) ) ? 'checked="checked"' : '' ; ?> value="1" />
			        </div>
			    </div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn blue">Submit</button>
				<a class="btn" href="<?php echo site_url('site-admin/lang') ?>">Cancel</a>
			</div>
			<?php echo form_close(); ?>
			<!-- END FORM-->
		 </div>
	  </div>
	  <!-- END EXTRAS PORTLET-->
   </div>
</div>

















