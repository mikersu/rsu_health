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

class resetpw2 extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'form', 'language' ) );
		
		// load language
		$this->lang->load( 'account' );
	}// __construct
	
	
	function _remap( $attr1 = '', $attr2 = '' ) {
		$this->index( $attr1, $attr2 );
	}// _remap
	
	
	function index( $account_id = '', $confirm_code = '' ) {
		$confirm_code = ( isset( $confirm_code[0] ) ? $confirm_code[0] : '' );
		
		if ( is_numeric( $account_id ) && $confirm_code != null ) {
			if ( $confirm_code == '0' ) {
				// cancel, delete confirm code and new password from db
				$this->db->set( 'account_new_password', NULL );
				$this->db->set( 'account_confirm_code', NULL );
				$this->db->where( 'account_id', $account_id );
				$this->db->update( 'accounts' );
				$output['form_status'] = '<div class="txt_success alert alert-success">' . $this->lang->line( 'account_cancel_change_password' ) . '</div>';
			} else {
				$this->db->where( 'account_id', $account_id );
				$this->db->where( 'account_confirm_code', $confirm_code );
				$query = $this->db->get( 'accounts' );
				if ( $query->num_rows() > 0 ) {
					$row = $query->row();
					
					// set to show change password form.
					$output['show_changepw_form'] = true;
					
					// save action
					if ( $this->input->post() ) {
						$data['account_id'] = $account_id;// for plugin/api to change password.
						$data['account_username'] = $row->account_username;// for plugin/api to change password.
						$data['account_email'] = $row->account_email;// for plugin/api to change password.
						$data['new_password'] = trim( $this->input->post( 'new_password' ) );
						$data['conf_new_password'] = trim( $this->input->post( 'conf_new_password' ) );
						
						// validate form
						$this->load->library( 'form_validation' );
						$this->form_validation->set_rules('new_password', 'lang:account_new_password', 'trim|required|matches[conf_new_password]');
						$this->form_validation->set_rules('conf_new_password', 'lang:account_confirm_new_password', 'trim|required');
						if ( $this->form_validation->run() == false ) {
							$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
						} else {
							// update new password
							$this->db->set( 'account_password', $this->account_model->encrypt_password( $data['new_password'] ) );
							$this->db->set( 'account_new_password', NULL );
							$this->db->set( 'account_confirm_code', NULL );
							$this->db->where( 'account_id', $account_id );
							$this->db->update( 'accounts' );
							$output['form_status'] = '<div class="txt_success alert alert-success">' . $this->lang->line( 'account_confirm_reset_password' ) . '</div>';
							
							// any APIs add here
							$this->modules_plug->do_action( 'account_change_password', $data );
						}
					}
					
				} else {
					$output['form_status'] = '<div class="txt_error alert alert-error">' . $this->lang->line( 'account_forgetpw_invalid_url' ) . '</div>';
				}
				$query->free_result();
			}
		} else {
			$output['form_status'] = '<div class="txt_error alert alert-error">' . $this->lang->line( 'account_forgetpw_invalid_url' ) . '</div>';
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_reset_password' ) );
		// meta tags
		$meta = array('<meta name="robots" content="noindex, nofollow" />');
		$output['page_meta'] = $this->html_model->gen_tags( $meta );
		unset( $meta );
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'front/templates/account/resetpw2_view', $output );
	}// index
	

}

