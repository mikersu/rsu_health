<!-- ECHO ERROR -->
<?php echo $error = ( ! empty( $error ) ) ? $error : '' ; ?>

<!-- SUCCESS -->
<?php echo $form_status = ( ! empty( $form_status ) ) ? $form_status : '' ; ?>

<?php $attributes = array( 'class' => 'form-horizontal' ); ?>
<?php echo form_open( '', $attributes); ?>


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
							<label class="control-label">Privacy Policy</label>
							<div class="controls">
								<textarea class="span12 detail_home m-wrap" name="member_privacy_policy[<?php echo $value->id ?>]" rows="6"><?php echo $member_privacy_policy = ( ! empty( $show_data['member_privacy_policy'][$value->id] ) ) ? $show_data['member_privacy_policy'][$value->id] : '' ; ?></textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Text Page Register</label>
							<div class="controls">
								<textarea class="span12 detail_home m-wrap" name="member_text_page[<?php echo $value->id ?>]" rows="6"><?php echo $member_text_page = ( ! empty( $show_data['member_text_page'][$value->id] ) ) ? $show_data['member_text_page'][$value->id] : '' ; ?></textarea>
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

<div class="">
	<button type="submit" class="btn blue">Submit</button>
	<a class="btn" href="<?php echo current_url() ?>">Reset</a>
</div>

<!-- END BOX -->

<?php echo form_close(); ?>




<script>
	

jQuery(document).ready(function($) {
	
<?php foreach ( $language as $key => $value ): ?>

		
    CKEDITOR.replace('member_privacy_policy[<?php echo $value->id; ?>]', {
        filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
        height:300,
        enterMode: 2,
        toolbar : [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
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


    CKEDITOR.replace('member_text_page[<?php echo $value->id; ?>]', {
        filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
        height:300,
        enterMode: 2,
        toolbar : [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
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




<?php endforeach ?>

});


</script>




