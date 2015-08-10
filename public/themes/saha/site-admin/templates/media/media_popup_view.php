<?php $this->load->view( 'site-admin/inc_html_head' ); ?> 




<div class="cmds">
	<div class="cmd-left">
		<?php echo anchor( 'site-admin/media/popup', sprintf( lang( 'admin_total' ), $list_item['total'] ) ); ?> 
		| <?php echo anchor( 'site-admin/media/popup?orders='.$orders.'&amp;sort='.$cur_sort.'&amp;filter=f.account_id&amp;filter_val='.$my_account_id, lang( 'media_my_file_only' ) ); ?> 
		| <span class="ico16-reload" onclick="window.location.reload();"><?php echo lang( 'media_reload' ); ?></span>
		
		
		<?php if ( $this->account_model->check_admin_permission( 'media_perm', 'media_upload_perm' ) ): ?> 
		<?php echo form_open_multipart( 'site-admin/media/upload', array( 'class' => 'media-upload-form', 'id' => 'form-upload', 'target' => 'upload_target', 'onsubmit' => 'return silent_upload()' ) ); ?> 
			<div id="upload-msg"></div>
			
			<input type="file" name="file" id="file-selector" />
			<button type="submit" class="bb-button media-upload-button btn btn-primary" id="upload-button"><?php echo lang( 'media_upload' ); ?></button>
			
			<span class="txt_comment">&lt; <?php echo ini_get('upload_max_filesize'); ?></span>
			
			<iframe id="upload_target" name="upload_target" src="" style="border: none; height: 0; width: 0;"></iframe>
		<?php echo form_close(); ?> 
		<?php endif; ?> 
		
		
	</div>
	<div class="cmd-right">
		<form method="get" class="search">
			<input type="hidden" name="filter" value="<?php echo $filter; ?>" />
			<input type="hidden" name="filter_val" value="<?php echo $filter_val; ?>" />
			<input type="text" name="q" value="<?php echo $q; ?>" maxlength="255" />
			<button type="submit" class="bb-button search-button btn"><?php echo lang( 'media_search' ); ?></button>
		</form>
	</div>
	<div class="clear"></div>
</div>

<div class="list-items-placeholder">
	<?php $this->load->view( 'site-admin/templates/media/media_popup_ajax_list_view' ); ?> 
</div>

<div class="cmds">
	<div class="cmd-right">
		<?php if ( isset( $pagination ) ) {echo $pagination;} ?>
	</div>
	<div class="clear"></div>
</div>

<script type="text/javascript" src="<?php echo $this->theme_path; ?>share-js/tiny_mce/tiny_mce_custom_popup.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		// remove tinymce class and stylesheet
		$('html, body').removeClass( 'forceColors' );
		var styleSheets = document.styleSheets;
		var href = '<?php echo $this->theme_path; ?>share-js/tiny_mce/themes/advanced/skins/default/dialog.css';
		for (var i = 0; i < styleSheets.length; i++) {
			if (styleSheets[i].href == href) {
				// go away tinymce stylesheet.
				styleSheets[i].disabled = true;
				break;
			}
		}
		// end remove tinymce class and stylesheet
	});// jquery
	
	
	function clear_status() {
		$('#upload-msg').html('');
		// reload list
		$.get( site_url+'site-admin/media/popup', function(data) {
			$('.list-items-placeholder').html(data);
		});
	}// clear_status
	
	
	function silent_upload() {
		if ( $('#file-selector').val() == '' ) {
			return false;
		}
		$('#upload-msg').html('<img src="<?php echo $this->theme_path; ?>site-admin/images/loading.gif" alt="" />');
		$('#upload-button').attr('disabled', 'disabled');
		return true;
	}// silent_upload
	
	
	function upload_status(msg) {
		$('#upload-msg').html(msg);
		$('#upload-button').removeAttr('disabled');
		setTimeout('clear_status()', '3000');
		// reset input file
		$('#file-selector').val('');
		$('#file-selector').replaceWith($('#file-selector').clone(true));// for ie
		$('#upload-button').removeAttr('disabled');
	}// upload_status
	
	
</script>




<?php $this->load->view( 'site-admin/inc_html_foot' ); ?> 