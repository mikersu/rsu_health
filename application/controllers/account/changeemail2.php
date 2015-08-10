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

class changeemail2 extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'language' ) );
		
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
				$this->db->set( 'account_new_email', NULL );
				$this->db->set( 'account_confirm_code', NULL );
				$this->db->where( 'account_id', $account_id );
				$this->db->update( 'accounts' );
				
				$output['form_status'] = '<div class="txt_success alert alert-success">' . $this->lang->line( 'account_cancel_change_email' ) . '</div>';
			} else {
				$this->db->where( 'account_id', $account_id );
				$this->db->where( 'account_confirm_code', $confirm_code );
				$query = $this->db->get( 'accounts' );
				
				if ( $query->num_rows() > 0 ) {
					$row = $query->row();
					
					// confirm, delete confirm code and update new email
					$this->db->set( 'account_email', $row->account_new_email );
					$this->db->set( 'account_new_email', NULL );
					$this->db->set( 'account_confirm_code', NULL );
					$this->db->where( 'account_id', $account_id );
					$this->db->update( 'accounts' );
					
					$output['form_status'] = '<div class="txt_success alert alert-success">' . $this->lang->line( 'account_confirmed_change_email' ) . '</div>';
					
					$this->modules_plug->do_action( 'account_change_email', array( 'account_id' => $account_id, 'account_username' => $row->account_username, 'account_email' => $row->account_new_email ) );
				} else {
					$output['form_status'] = '<div class="txt_error alert alert-error">' . $this->lang->line( 'account_chengeemail_invalid_url' ) . '</div>';
				}
				
				$query->free_result();
			}
		} else {
			$output['form_status'] = '<div class="txt_error alert alert-error">' . $this->lang->line( 'account_chengeemail_invalid_url' ) . '</div>';
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_change_email' ) );
		// meta tags
		$meta = array('<meta name="robots" content="noindex, nofollow" />');
		$output['page_meta'] = $this->html_model->gen_tags( $meta );
		unset( $meta );
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'front/templates/account/changeemail2_view', $output );
	}// index
	

}

