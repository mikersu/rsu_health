<!-- ECHO ERROR -->
<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
<?php echo form_open( '', $attributes); ?>

<div class="row-fluid">
	<div class="span12">
		<div class="tabbable tabbable-custom boxless">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Content</a></li>
			</ul>
			<div class="tab-content">

				<div class="control-group">
					<label class="control-label">Detail</label>
					<div class="controls">
						<textarea class="span12 this_ckeditor m-wrap" id="detail" name="detail" rows="6"> </textarea>
					</div>
				</div>

			</div>

			<div class="">
				<button type="submit" class="btn blue">Submit</button>
				<a class="btn cursor_pointer" onclick="history.go(-1);" >Cancel</a>
			</div>

		</div>
	</div>
</div>
</div>
<?php echo form_close(); ?>
<!-- END PAGE CONTENT-->   


<script>

    CKEDITOR.replace('detail', {
    	filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
    	height:300,
    	enterMode: 2,
    	toolbar : [
    	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
    	{ name: 'templates', items: [  'Templates' ] },
    	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
    	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
    	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
    	{ name: 'netclub', items: [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
    	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
    	{ name: 'styles', items: [ 'Styles', 'Format' ,'Font','FontSize','TextColor','BGColor'] },
    	{ name: 'tools', items: [ 'Maximize' ] },
    	{ name: 'others', items: [ '-' ] },
    	{ name: 'career', items: [ 'career' ] }
    	]
    });
</script>