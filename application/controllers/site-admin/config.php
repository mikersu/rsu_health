<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */

class config extends admin_controller {

	
	function __construct() {
		parent::__construct();
		
		// load model
		$this->load->model( array( 'themes_model' ) );
		
		// load helper
		$this->load->helper( array( 'date', 'form' ) );
		
		// load language
		$this->lang->load( 'config' );
		
		// load config
		$this->config->load( 'agni' );
	}// __construct
	
	
	function _define_permission() {
		return array( 'config_global' => array( 'config_global' ) );
	}// _define_permission
	
	
	function index() {
		// check permission
		if ( $this->account_model->check_admin_permission( 'config_global', 'config_global' ) != true ) {redirect( 'site-admin' );}
		
		// load session
		$this->load->library( 'session' );
		$form_status = $this->session->flashdata( 'form_status' );
		if ( $form_status != null ) {
			$output['form_status'] = $form_status;
		}
		unset( $form_status );
		
		// load config to form
		$this->db->where( 'config_core', '1' );
		$query = $this->db->get( 'config' );
		if ( $query->num_rows() > 0 ) {
			foreach ( $query->result() as $row ) {
				$output[$row->config_name] = htmlspecialchars( $row->config_value );
			}
			$output['content_frontpage_category'] = $this->config_model->load_single( 'content_frontpage_category', $this->lang->get_current_lang() );
		} else {
			log_message( 'error', 'No config in config table.' );
			redirect( 'site-admin' );
		}
		$query->free_result();
		
		// method post request (save data)
		if ( $this->input->post() ) {
			//tab1
			$data['site_name'] = trim( $this->input->post( 'site_name', true ) );
			$data['page_title_separator'] = $this->input->post( 'page_title_separator', true );
			$data['site_timezone'] = trim( $this->input->post( 'timezones', true ) );
			
			//tab2
			$data['member_allow_register'] = $this->input->post( 'member_allow_register' );
			if ( $data['member_allow_register'] != '1' ) {$data['member_allow_register'] = '0';}
			$data['member_register_notify_admin'] = $this->input->post( 'member_register_notify_admin' );
			if ( $data['member_register_notify_admin'] != '1' ) {$data['member_register_notify_admin'] = '0';}
			$data['member_verification'] = $this->input->post( 'member_verification' );
			$data['member_admin_verify_emails'] = trim( $this->input->post( 'member_admin_verify_emails' ) );
			$data['duplicate_login'] = $this->input->post( 'duplicate_login' );
			if ( $data['duplicate_login'] != '1' ) {$data['duplicate_login'] = '0';}
			$data['allow_avatar'] = $this->input->post( 'allow_avatar' );
			if ( $data['allow_avatar'] != '1' ) {$data['allow_avatar'] = '0';}
			$data['avatar_size'] = trim( $this->input->post( 'avatar_size' ) );
			if ( !is_numeric( $data['avatar_size']) ) {$data['avatar_size'] = '200';}
			$data['avatar_allowed_types'] = trim( $this->input->post( 'avatar_allowed_types', true ) );
			if ( empty( $data['avatar_allowed_types'] ) ) {$data['avatar_allowed_types'] = 'jpg|jpeg';}
			
			//tab3
			$data['mail_protocol'] = $this->input->post( 'mail_protocol' );
			$data['mail_mailpath'] = trim( $this->input->post( 'mail_mailpath' ) );
			$data['mail_smtp_host'] = trim( $this->input->post( 'mail_smtp_host' ) );
			$data['mail_smtp_user'] = trim( $this->input->post( 'mail_smtp_user' ) );
			$data['mail_smtp_pass'] = trim( $this->input->post( 'mail_smtp_pass' ) );
			$data['mail_smtp_port'] = (int) $this->input->post( 'mail_smtp_port' );
			$data['mail_sender_email'] = trim( $this->input->post( 'mail_sender_email', true ) );
			
			//tab4
			$data['content_show_title'] = $this->input->post( 'content_show_title' );
			if ( $data['content_show_title'] != '1' ) {$data['content_show_title'] = '0';}
			$data['content_show_time'] = $this->input->post( 'content_show_time' );
			if ( $data['content_show_time'] != '1' ) {$data['content_show_time'] = '0';}
			$data['content_show_author'] = $this->input->post( 'content_show_author' );
			if ( $data['content_show_author'] != '1' ) {$data['content_show_author'] = '0';}
			$data['content_items_perpage'] = trim( $this->input->post( 'content_items_perpage' ) );
			if ( !is_numeric( $data['content_items_perpage'] ) ) {$data['content_items_perpage'] = '10';}
			$data['content_frontpage_category'] = trim( $this->input->post( 'content_frontpage_category' ) );
			if ( !is_numeric( $data['content_frontpage_category'] ) || $data['content_frontpage_category'] == null ) {$data['content_frontpage_category'] = null;}
			
			// tab media
			$data['media_allowed_types'] = trim( $this->input->post( 'media_allowed_types' ) );
			if ( empty( $data['media_allowed_types'] ) ) {$data['media_allowed_types'] = 'jpeg|jpg|gif|png';}
			
			// tab comment
			$data['comment_allow'] = $this->input->post( 'comment_allow' );
			if ( $data['comment_allow'] != '1' && $data['comment_allow'] != '0' ) {$data['comment_allow'] = null;}
			$data['comment_show_notallow'] = $this->input->post( 'comment_show_notallow' );
			if ( $data['comment_show_notallow'] != '1' ) {$data['comment_show_notallow'] = '0';}
			$data['comment_perpage'] = trim( $this->input->post( 'comment_perpage' ) );
			if ( !is_numeric( $data['comment_perpage'] ) ) {$data['comment_perpage'] = '40';}
			$data['comment_new_notify_admin'] = $this->input->post( 'comment_new_notify_admin' );
			if ( $data['comment_new_notify_admin'] < '0' || $data['comment_new_notify_admin'] > '2' ) {$data['comment_new_notify_admin'] = '1';}
			$data['comment_admin_notify_emails'] = trim( $this->input->post( 'comment_admin_notify_emails' ) );
			
			// load form validation
			$this->load->library( 'form_validation' );
			$this->form_validation->set_rules( 'site_name', 'lang:config_sitename', 'trim|required|xss_clean' );
			$this->form_validation->set_rules( 'member_admin_verify_emails', 'lang:config_member_admin_verify_emails', 'required|valid_emails' );
			$this->form_validation->set_rules( 'mail_sender_email', 'lang:config_mail_sender_email', 'trim|required|valid_email|xss_clean' );
			$this->form_validation->set_rules( 'content_items_perpage', 'lang:config_content_items_perpage', 'trim|required|integer|xss_clean' );
			$this->form_validation->set_rules( 'comment_perpage', 'lang:config_comment_perpage', 'trim|required|integer|xss_clean' );
			$this->form_validation->set_rules( 'comment_admin_notify_emails', 'lang:config_comment_admin_notify_emails', 'trim|required|valid_email|xss_clean' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
			} else {
				// save config
				$result = $this->config_model->save( $data );
				
				if ( $result === true ) {
					$this->session->set_flashdata( 'form_status', '<div class="txt_success alert alert-success">' . $this->lang->line( 'admin_saved' ) . '</div>' );
					redirect( 'site-admin/config' );
				} else {
					$output['form_status'] = '<div class="txt_error alert alert-error">' . $result . '</div>';
				}
			}
			
			// re-population form
			foreach ( $data as $key => $item ) {
				$output[$key] = htmlspecialchars( $item );
			}
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'config_global' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'site-admin/templates/config/config_view', $output );
	}// index
	

}

