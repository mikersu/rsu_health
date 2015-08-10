<h1><?php echo lang( 'config_global' ); ?></h1>

<?php echo form_open(); ?>
	<?php if ( isset( $form_status ) ) {echo $form_status;} ?>
	<div id="tabs" class="page-tabs config-tabs">
		<ul>
			<li><a href="#tabs-1"><?php echo lang( 'config_site' ); ?></a></li>
			<li><a href="#tabs-2"><?php echo lang( 'config_member' ); ?></a></li>
			<li><a href="#tabs-3"><?php echo lang( 'config_email' ); ?></a></li>
			<li><a href="#tabs-4"><?php echo lang( 'config_content' ); ?></a></li>
			<li><a href="#tabs-media"><?php echo lang( 'config_media' ); ?></a></li>
			<li><a href="#tabs-comment"><?php echo lang( 'config_comment' ); ?></a></li>
		</ul>

		
		<div id="tabs-1">
			<label><?php echo lang( 'config_sitename' ); ?>: <span class="txt_require">*</span><input type="text" name="site_name" value="<?php if ( isset( $site_name ) ) {echo $site_name;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_page_title_separator' ); ?>:<input type="text" name="page_title_separator" value="<?php if ( isset( $page_title_separator ) ) {echo $page_title_separator;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_timezone' ); ?>:<?php echo timezone_menu((isset($site_timezone) ? $site_timezone : '')); ?></label>
		</div>
		
		
		<div id="tabs-2">
			<label><input type="checkbox" name="member_allow_register" value="1"<?php if ( isset( $member_allow_register ) && $member_allow_register == '1' ) {echo ' checked="checked"';} ?> /> <?php echo lang( 'config_member_allow_register' ); ?></label>
			<label><input type="checkbox" name="member_register_notify_admin" value="1"<?php if ( isset( $member_register_notify_admin ) && $member_register_notify_admin == '1' ) {echo 'checked="checked"';} ?> /> <?php echo lang( 'config_member_register_notify_admin' ); ?>
				<span class="txt_comment">(<?php echo lang( 'config_member_force_notify_if_verify_admin' ); ?> )</span>
			</label>
			<label><?php echo lang( 'config_member_verification' ); ?>: 
				<select name="member_verification">
					<option value="1"<?php if ( isset( $member_verification ) && $member_verification == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_member_verify_email' ); ?></option>
					<option value="2"<?php if ( isset( $member_verification ) && $member_verification == '2' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_member_verify_admin' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_member_admin_verify_emails' ); ?>: <span class="txt_require">*</span><input type="text" name="member_admin_verify_emails" value="<?php if ( isset( $member_admin_verify_emails ) ) {echo $member_admin_verify_emails;} ?>" maxlength="255" /></label>
			<label><input type="checkbox" name="duplicate_login" value="1"<?php if ( isset( $duplicate_login ) && $duplicate_login == '1' ) {echo ' checked="checked"';} ?> /> <?php echo lang( 'config_duplicate_login' ); ?></label>
			<label><input type="checkbox" name="allow_avatar" value="1"<?php if ( isset( $allow_avatar ) && $allow_avatar == '1' ) {echo ' checked="checked"';} ?> /> <?php echo lang( 'config_allow_avatar' ); ?></label>
			<label><?php echo lang( 'config_avatar_size' ); ?>:
				<input type="text" name="avatar_size" value="<?php if ( isset( $avatar_size ) ) {echo $avatar_size;} ?>" maxlength="255" />
				<span class="txt_comment"><?php echo lang( 'config_avatar_size_comment' ); ?></span>
			</label>
			<label><?php echo lang( 'config_avatar_allowed_types' ); ?>:
				<input type="text" name="avatar_allowed_types" value="<?php if ( isset( $avatar_allowed_types ) ) {echo $avatar_allowed_types;} ?>" maxlength="255" />
				<span class="txt_comment">gif|jpg|png</span>
			</label>
		</div>
		
		
		<div id="tabs-3">
			<label><?php echo lang( 'config_mail_protocol' ); ?>:
				<select name="mail_protocol">
					<option value="mail"<?php if ( isset( $mail_protocol ) && $mail_protocol == 'mail' ) {echo ' selected="selected"';} ?>>Mail function</option>
					<option value="sendmail"<?php if ( isset( $mail_protocol ) && $mail_protocol == 'sendmail' ) {echo ' selected="selected"';} ?>>Sendmail function</option>
					<option value="smtp"<?php if ( isset( $mail_protocol ) && $mail_protocol == 'smtp' ) {echo ' selected="selected"';} ?>>SMTP</option>
				</select>
			</label>
			<label><?php echo lang( 'config_mail_mailpath' ); ?>:<input type="text" name="mail_mailpath" value="<?php if ( isset( $mail_mailpath ) ) {echo $mail_mailpath;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_mail_smtp_host' ); ?>:<input type="text" name="mail_smtp_host" value="<?php if ( isset( $mail_smtp_host ) ) {echo $mail_smtp_host;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_mail_smtp_user' ); ?>:<input type="text" name="mail_smtp_user" value="<?php if ( isset( $mail_smtp_user ) ) {echo $mail_smtp_user;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_mail_smtp_pass' ); ?>:<input type="password" name="mail_smtp_pass" value="<?php if ( isset( $mail_smtp_pass ) ) {echo $mail_smtp_pass;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_mail_smtp_port' ); ?>:<input type="text" name="mail_smtp_port" value="<?php if ( isset( $mail_smtp_port ) ) {echo $mail_smtp_port;} ?>" maxlength="255" /></label>
			<label><?php echo lang( 'config_mail_sender_email' ); ?>: <span class="txt_require">*</span>
				<input type="text" name="mail_sender_email" value="<?php if ( isset( $mail_sender_email ) ) {echo $mail_sender_email;} ?>" maxlength="255" />
				<span class="txt_comment"><?php echo lang( 'config_mail_sender_email_comment' ); ?></span>
			</label>
		</div>
		
		
		<div id="tabs-4">
			<label><?php echo lang( 'config_content_show_title' ); ?>:
				<select name="content_show_title">
					<option value="1"<?php if ( isset( $content_show_title ) && $content_show_title == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_yes' ); ?></option>
					<option value="0"<?php if ( isset( $content_show_title ) && $content_show_title == '0' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_no' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_content_show_time' ); ?>:
				<select name="content_show_time">
					<option value="1"<?php if ( isset( $content_show_time ) && $content_show_time == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_yes' ); ?></option>
					<option value="0"<?php if ( isset( $content_show_time ) && $content_show_time == '0' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_no' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_content_show_author' ); ?>:
				<select name="content_show_author">
					<option value="1"<?php if ( isset( $content_show_author ) && $content_show_author == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_yes' ); ?></option>
					<option value="0"<?php if ( isset( $content_show_author ) && $content_show_author == '0' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_no' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_content_items_perpage' ); ?>: <span class="txt_require">*</span><input type="text" name="content_items_perpage" value="<?php if ( isset( $content_items_perpage ) ) {echo $content_items_perpage;} ?>" maxlength="2" /></label>
			<label><?php echo lang( 'config_content_frontpage_category' ); ?> (<?php $langs = $this->config->item( 'lang_uri_abbr' ); echo ucfirst( $langs[$this->lang->get_current_lang()] ); unset( $langs ); ?>):
				<select name="content_frontpage_category">
					<option value=""<?php if ( $content_frontpage_category == null ) {echo ' selected="selected"';} ?>>&nbsp;</option>
					<?php $this->load->helper( 'category' );
					$this->load->model( 'taxonomy_model' );
					$this->taxonomy_model->tax_type = 'category';
					echo show_category_select( $this->taxonomy_model->list_item(), $content_frontpage_category ); ?> 
				</select>
			</label>
		</div>
		
		
		<div id="tabs-media">
			<label>
				<?php echo lang( 'config_media_allowed_types' ); ?>:
				<input type="text" name="media_allowed_types" value="<?php if ( isset( $media_allowed_types ) ) {echo $media_allowed_types;} ?>" maxlength="255" />
				<span class="txt_comment"><?php echo lang( 'config_media_please_check_mimes' ); ?></span>
			</label>
		</div>
		
		
		<div id="tabs-comment">
			<label><?php echo lang( 'config_comment_allow' ); ?>:
				<select name="comment_allow">
					<option value=""<?php if ( isset( $comment_allow ) && $comment_allow == null ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_comment_allow_uptopost' ); ?></option>
					<option value="1"<?php if ( isset( $comment_allow ) && $comment_allow == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_yes' ); ?></option>
					<option value="0"<?php if ( isset( $comment_allow ) && $comment_allow == '0' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_no' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_comment_show_notallow' ); ?>:
				<select name="comment_show_notallow">
					<option value="1"<?php if ( isset( $comment_show_notallow ) && $comment_show_notallow == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_yes' ); ?></option>
					<option value="0"<?php if ( isset( $comment_show_notallow ) && $comment_show_notallow == '0' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_no' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_comment_perpage' ); ?>: <span class="txt_require">*</span><input type="text" name="comment_perpage" value="<?php if ( isset( $comment_perpage ) ) {echo $comment_perpage;} ?>" maxlength="2" /></label>
			<label><?php echo lang( 'config_comment_new_notify_admin' ); ?>:
				<select name="comment_new_notify_admin">
					<option value="0"<?php if ( isset( $comment_new_notify_admin ) && $comment_new_notify_admin == '0' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_comment_new_notify_no' ); ?></option>
					<option value="1"<?php if ( isset( $comment_new_notify_admin ) && $comment_new_notify_admin == '1' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_comment_new_notify_yesmoderation' ); ?></option>
					<option value="2"<?php if ( isset( $comment_new_notify_admin ) && $comment_new_notify_admin == '2' ) {echo ' selected="selected"';} ?>><?php echo lang( 'config_comment_new_notify_yesall' ); ?></option>
				</select>
			</label>
			<label><?php echo lang( 'config_comment_admin_notify_emails' ); ?>: <span class="txt_require">*</span><input type="text" name="comment_admin_notify_emails" value="<?php if ( isset( $comment_admin_notify_emails ) ) {echo $comment_admin_notify_emails;} ?>" maxlength="255" /></label>
		</div>
		
		
		<div class="ui-tabs-panel button-panel"><button type="submit" class="bb-button btn btn-primary"><?php echo lang( 'admin_save' ); ?></button></div>
	</div>
<?php echo form_close(); ?>

<script type="text/javascript">
	make_tabs();
</script>