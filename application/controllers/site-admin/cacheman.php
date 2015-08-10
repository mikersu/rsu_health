<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */
 
class cacheman extends admin_controller {
	
	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'form' ) );
		
		// load language
		$this->lang->load( 'cache' );
	}// __construct
	
	
	function _define_permission() {
		return array( 'cache_perm' => array( 'cache_perm_manage', 'cache_perm_clear_all' ) );
	}// _define_permission
	
	
	function do_action() {
		// filter post action only
		if ( $this->input->post() ) {
			
			$action = $this->input->post( 'cache_act' );
			
			if ( $action == 'clear' ) {
				// check permission
				if ( $this->account_model->check_admin_permission( 'cache_perm', 'cache_perm_clear_all' ) != true ) {redirect( 'site-admin' );}
				
				// clear all cache
				$this->config_model->delete_cache( 'ALL' );
				
				// flash message-----------------------------------
				// load session library
				$this->load->library( 'session' );
				$this->session->set_flashdata( 'form_status', '<div class="txt_success alert alert-success">'.$this->lang->line( 'cache_cleared' ).'</div>' );
			}
			
		}
		
		// go back
		$this->load->library( 'user_agent' );
		if ( $this->agent->is_referral() ) {
			redirect( $this->agent->referrer() );
		} else {
			redirect( 'site-admin/cacheman' );
		}
	}// do_action
	
	
	function index() {
		// check permission
		if ( $this->account_model->check_admin_permission( 'cache_perm', 'cache_perm_manage' ) != true ) {redirect( 'site-admin' );}
		
		// load session for flashdata
		$this->load->library( 'session' );
		$form_status = $this->session->flashdata( 'form_status' );
		if ( $form_status != null ) {
			$output['form_status'] = $form_status;
		}
		unset( $form_status );
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'cache_manager' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'site-admin/templates/cacheman/cacheman_view', $output );
	}// index
	
	
}

// EOF