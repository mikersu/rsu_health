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

class edit_profile extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'date', 'form', 'language' ) );
		
		// load language
		$this->lang->load( 'account' );
	}// __construct
	
	
	function _remap( $att1 = '', $att2 = '' ) {
		if ( $att1 == 'delete-avatar' ) {
			$this->delete_avatar();
		} else {
			$this->index();
		}
	}// _remap
	
	
	function delete_avatar() {
		// get id
		$account_id = trim( $this->input->post( 'account_id' ) );
		
		// delete avatar
		$this->account_model->delete_account_avatar( $account_id );
		
		// return
		if ( !$this->input->is_ajax_request() ) {
			redirect( 'account/edit-profile' );
		} else {
			$output['result'] = true;
			$this->output->set_content_type( 'application/json' );
			$this->output->set_output( json_encode( $output ) );
			unset( $output );
		}
	}// delete_avatar
	
	
	function index() {
		// is member login?
		if ( !$this->account_model->is_member_login() ) {redirect( site_url() );}
		
		// load configurations
		$cfg = $this->config_model->load( array( 'allow_avatar', 'avatar_size', 'avatar_allowed_types' ) );
		$output['allow_avatar'] = $cfg['allow_avatar']['value'];
		$output['avatar_size'] = $cfg['avatar_size']['value'];
		$output['avatar_allowed_types'] = $cfg['avatar_allowed_types']['value'];
		unset( $cfg );
		
		// load session for flashdata
		$this->load->library( 'session' );
		$form_status = $this->session->flashdata( 'form_status' );
		if ( $form_status != null ) {
			$output['form_status'] = $form_status;
		}
		unset( $form_status );
		
		// get id
		$cm_account = $this->account_model->get_account_cookie( 'member' );
		
		// check from db
		$data['account_id'] = $cm_account['id'];
		$data['account_username'] = $cm_account['username'];
		$row = $this->account_model->get_account_data( $data );
		unset( $data );
		
		if ( $row != null ) {
			$output['row'] = $row;
			$output['account_id'] = $row->account_id;
			$output['account_username'] = $row->account_username;
			$output['account_email'] = $row->account_email;
			$output['account_fullname'] = $row->account_fullname;
			$output['account_birthdate'] = $row->account_birthdate;
			$output['account_avatar'] = $row->account_avatar;
			$output['account_timezone'] = $row->account_timezone;
		} else {
			// not found.
			unset( $cm_account, $output );
			redirect( site_url() );
		}
		
		// save action
		if ( $this->input->post() ) {
			$data['account_id'] = $row->account_id;
			$data['account_old_email'] = $row->account_email;
			$data['account_username'] = $row->account_username;
			$data['account_email'] = strip_tags( trim( $this->input->post( 'account_email', true ) ) );
			$data['account_password'] = trim( $this->input->post( 'account_password' ) );
			$data['account_new_password'] = trim( $this->input->post( 'account_new_password' ) );
			$data['account_fullname'] = htmlspecialchars( trim( $this->input->post( 'account_fullname' ) ),ENT_QUOTES, config_item( 'charset' ) );
				if ( empty( $data['account_fullname'] ) ) {$data['account_fullname'] = null;}
			$data['account_birthdate'] = strip_tags( trim( $this->input->post( 'account_birthdate' ) ) );
				if ( empty( $data['account_birthdate'] ) ) {$data['account_birthdate'] = null;}
			$data['account_timezone'] = trim( $this->input->post( 'account_timezone' ) );
				if ( empty( $data['account_timezone'] ) ) {$data['account_timezone'] = $this->config_model->load_single( 'site_timezone' );}
			
			// load form validation
			$this->load->library( 'form_validation' );
			$this->form_validation->set_rules( 'account_email', 'lang:account_email', 'trim|required|valid_email|xss_clean' );
			$this->form_validation->set_rules( 'account_birthdate', 'lang:account_birthdate', 'trim|preg_match_date' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
			} else {
				// save
				$result = $this->account_model->member_edit_profile( $data );
				
				if ( $result === true ) {
					// flash success msg to session
					$this->session->set_flashdata( 'form_status', '<div class="txt_success alert alert-success">'.$this->lang->line( 'account_saved' ).'</div>' );
					redirect( current_url() );
				} else {
					$output['form_status'] = '<div class="txt_error alert alert-error">'.$result.'</div>';
				}
				unset( $result );
			}
			
			// re-populate form
			$output['account_email'] = $data['account_email'];
			$output['account_fullname'] = $data['account_fullname'];
			$output['account_birthdate'] = $data['account_birthdate'];
			$output['account_timezone'] = $data['account_timezone'];
		}
		unset( $cm_account, $query );
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_edit_profile' ) );
		// meta tags
		// link tags
		$link = array(
			'<link rel="stylesheet" type="text/css" href="'.$this->base_url.'public/js/jquery-ui/css/smoothness/jquery-ui.css" media="all" />'
			);
		$output['page_link'] = $this->html_model->gen_tags( $link );
		unset( $link );
		// script tags
		$script = array(
			'<script src="'.$this->base_url.'public/js/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>'
			);
		$output['page_script'] = $this->html_model->gen_tags( $script );
		unset( $script );
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'front/templates/account/edit_profile_view', $output );
	}// index
	

}

