<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<div class="row-fluid">
   <div class="span12">
	  <!-- BEGIN EXTRAS PORTLET-->
	  <div class="portlet box blue">
		 <div class="portlet-title">
			<h4><i class="icon-reorder"></i>Detail in Category <?php echo $language->language_name ?></h4>
		 </div>
		 <div class="portlet-body form">
			<!-- BEGIN FORM-->
			
            <?php $attributes = array( 'class' => 'form-horizontal' ); ?>
			<?php echo form_open( '', $attributes); ?>

			<input type="hidden" name="language_id" value="<?php echo $language_id = ( ! empty( $language_id ) ) ? $language_id : 0 ; ?>" >

			<div class="control-group">
				<label class="control-label">Title</label>
				<div class="controls">
					<input name='title' type="text" value="<?php echo $title = ( ! empty( $show_data['title'] ) ) ? $show_data['title'] : '' ; ?>" class="span6 m-wrap" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">Description</label>
				<div class="controls">
					<textarea class="span12 detail_home m-wrap" name="description" rows="6"><?php echo $description = ( ! empty( $show_data['description'] ) ) ? $show_data['description'] : '' ; ?></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Status</label>
				<?php $show_data['status'] = ( ! isset( $show_data['status'] ) ) ? '1' : $show_data['status'] ; ?>
				<div class="controls">
					<label class="radio">
						<input type="radio" class='select_cover' name="status" <?php echo $retVal = ( $show_data['status'] == 0 ) ? 'checked="checked"' : '' ; ?> value="0" />
						OFF
					</label>
					<label class="radio">
						<input type="radio" class='select_cover' name="status" <?php echo $retVal = ( $show_data['status'] == 1 ) ? 'checked="checked"' : '' ; ?> value="1" />
						ON
					</label>  
				</div>
			</div>	
			<div class="portlet-title-more">
				<h4><i class="icon-reorder"></i>SEO setting</h4>
			</div>
			
			<div class="form-horizontal" >

				<div class="control-group">
					<label class="control-label">Tag Title</label>
					<div class="controls">
						<input class="span12 detail_home m-wrap" name="seotag[<?php echo $language->id ?>][title]" value="<?php echo $seotag = ( ! empty( $show_data['seotag'][$language->id]['title'] ) ) ? $show_data['seotag'][$language->id]['title'] : '' ; ?>" >
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Tag Description</label>
					<div class="controls">
						<input class="span12 detail_home m-wrap" name="seotag[<?php echo $language->id ?>][description]" value="<?php echo $seotag = ( ! empty( $show_data['seotag'][$language->id]['description'] ) ) ? $show_data['seotag'][$language->id]['description'] : '' ; ?>" >
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Tag Keyword</label>
					<div class="controls">
						<input class="span12 detail_home m-wrap" name="seotag[<?php echo $language->id ?>][keywords]" value="<?php echo $seotag = ( ! empty( $show_data['seotag'][$language->id]['keywords'] ) ) ? $show_data['seotag'][$language->id]['keywords'] : '' ; ?>" >
					</div>
				</div>

			</div>


			<div class="form-actions">
				<button type="submit" class="btn blue">Submit</button>
				<a class="btn" href="<?php echo site_url('site-admin/philosophy') ?>">Cancel</a>
			</div>
			<?php echo form_close(); ?>
			<!-- END FORM-->
		 </div>
	  </div>
	  <!-- END EXTRAS PORTLET-->
   </div>
</div>
















