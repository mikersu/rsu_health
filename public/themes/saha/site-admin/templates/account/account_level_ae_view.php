<h1><?php if ( $this->uri->segment(3) == 'add' ) {echo lang( 'account_level_add' );} else {echo lang( 'account_level_edit' );} ?></h1>
<hr>

<?php echo form_open(); ?> 
	<?php if ( isset( $form_status ) ) {echo $form_status;} ?> 
	<div class="page-add-edit">
		<label>
			<span style="width: 6em; display: inline-block;" ><?php echo lang( 'account_level' ); ?>: <span class="txt_require">*</span></span>
			<input type="text" name="level_name" value="<?php if ( isset( $level_name ) ) {echo $level_name;} ?>" maxlength="255" />
		</label>
		<label>
			<span style="width: 6em; display: inline-block;" ><?php echo lang( 'account_level_description' ); ?>:</span>
			<input type="text" name="level_description" value="<?php if ( isset( $level_description ) ) {echo $level_description;} ?>" maxlength="255" />
		</label>
		<button type="submit" class="bb-button standard btn btn-primary"><?php echo lang( 'admin_save' ); ?></button>
	</div>
<?php echo form_close(); ?> 