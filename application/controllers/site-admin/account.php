<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */

class account extends admin_controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'date', 'form' ) );
		
		// load language
		$this->lang->load( 'account' );
	}// __construct
	
	
	function _define_permission() {
		return array(  );
	}// _define_permission
	
	
	function add() {
		// check permission
		if ( $this->account_model->check_admin_permission( 'Member', 'Add Member' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}
		
		$output['list_level'] = $this->account_model->list_level_group();
		
		// post method. save action
		if ( $this->input->post() ) {
			$data['account_username'] = htmlspecialchars( trim( $this->input->post( 'account_email' ) ), ENT_QUOTES, config_item( 'charset' ) );
			$data['account_email'] = strip_tags( trim( $this->input->post( 'account_email', true ) ) );
			$data['account_password'] = trim( $this->input->post( 'account_password' ) );
			$data['account_fullname'] = htmlspecialchars( trim( $this->input->post( 'nickname' ) ),ENT_QUOTES, config_item( 'charset' ) );
				if ( empty( $data['account_fullname'] ) ) {$data['account_fullname'] = null;}
			$data['account_birthdate'] = strip_tags( trim( $this->input->post( 'account_birthdate' ) ) );
				if ( empty( $data['account_birthdate'] ) ) {$data['account_birthdate'] = null;}
			$data['account_timezone'] = trim( $this->input->post( 'account_timezone' ) );
				if ( empty( $data['account_timezone'] ) ) {$data['account_timezone'] = $this->config_model->load_single( 'site_timezone' );}
			$data['account_status'] = $this->input->post( 'account_status' );
			$data['account_status_text'] = trim( $this->input->post( 'account_status_text', true ) );
				if ( empty( $data['account_status_text'] ) ) {$data['account_status_text'] = null;}
			$data['level_group_id'] = $this->input->post( 'level_group_id' );
			$data['nickname'] = $this->input->post( 'nickname' );
			
			// load form validation
			$this->load->library( 'form_validation' );
			$this->form_validation->set_rules( 'nickname', 'ชื่อ', 'trim|required|xss_clean|min_length[1]' );
			$this->form_validation->set_rules( 'account_email', 'lang:account_email', 'trim|required|valid_email|xss_clean' );
			$this->form_validation->set_rules( 'account_password', 'lang:account_password', 'trim|required' );
			$this->form_validation->set_rules( 'account_birthdate', 'lang:account_birthdate', 'trim|preg_match_date' );
			$this->form_validation->set_rules( 'account_status', 'lang:account_status', 'trim|required' );
			$this->form_validation->set_rules( 'level_group_id', 'lang:account_level', 'trim|required' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert"></button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
			} else {
				// save
				$result = $this->account_model->add_account( $data );
				
				if ( $result === true ) {
					// load session library
					$this->load->library( 'session' );
					$this->session->set_flashdata( 'form_status', '<div class="txt_success alert alert-success">'.$this->lang->line( 'admin_saved' ).'</div>' );
					redirect( 'site-admin/member/member_admin' );
				} else {
					$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert"></button>'.$result.'</div>';
				}
			}
			
			// re-populate form
			$output['account_username'] = $data['account_username'];
			$output['account_email'] = $data['account_email'];
			$output['account_fullname'] = $data['account_fullname'];
			$output['account_birthdate'] = $data['account_birthdate'];
			$output['account_timezone'] = $data['account_timezone'];
			$output['account_status'] = $data['account_status'];
			$output['account_status_text'] = $data['account_status_text'];
			$output['level_group_id'] = $data['level_group_id'];
			$output['nickname'] = $data['nickname'];
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_accounts' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		

		$output['this_title_page'] = 'Account';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Account Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;


		// output
		$this->generate_page( 'site-admin/templates/account/account_ae_view', $output );
	}// add
	
	
	function delete_avatar() {
		$account_id = trim( $this->input->post( 'account_id' ) );
		
		// load account cookie for check edit self?
		$ca_account = $this->account_model->get_account_cookie( 'admin' );
		if ( !isset( $ca_account['id'] ) ) {redirect( 'site-admin' );}
		
		// if not edit myself, go check permission.
		if ( $account_id != null && $account_id != $ca_account['id'] ) {
			// check permission
			if ( $this->account_model->check_admin_permission( 'account_perm', 'account_edit_perm' ) != true ) {unset( $ca_account ); redirect( 'site-admin' );}
		}
		unset( $ca_account );
		
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
	
	
	function delete_log( $account_id = '' ) {
		// check permission
		if ( $this->account_model->check_admin_permission( 'account_perm', 'account_deletelog_perm' ) != true ) {redirect( 'site-admin' );}
		
		if ( ! is_numeric( $account_id ) ) {redirect( 'site-admin' );}
		
		// check delete log higher level than yours?
		$target_level_group_id = $this->account_model->show_account_level_info( $account_id );
		if ( $target_level_group_id == false ) {redirect( 'site-admin' );}
		if ( $this->account_model->can_i_add_edit_account( $target_level_group_id ) == false ) {redirect( 'site-admin' );}
		
		// get act command
		$act = trim( $this->input->post( 'act' ) );
		
		// act is truncate, check is this super admin?
		$level_id = $this->account_model->show_account_level_info();
		if ( $act == 'truncate' && $level_id !== '1' ) {
			// not super admin
			redirect( 'site-admin/account/viewlog/'.$account_id );
		} elseif ( $act == 'truncate' && $level_id === '1' ) {
			// super admin, delete all logins
			$this->db->truncate( 'account_logins' );
		}
		unset( $level_id );
		
		// delete logins specific user.
		if ( $act == 'del' ) {
			$this->db->where( 'account_id', $account_id );
			$this->db->delete( 'account_logins' );
		}
		
		redirect( 'site-admin/account/viewlog/'.$account_id );
	}// delete_log
	
	
	function edit( $account_id = '' ) {

		// load account cookie for check edit self?
		$ca_account = $this->account_model->get_account_cookie( 'admin' );
		if ( !isset( $ca_account['id'] ) ) {redirect( 'site-admin' );}
		
		// if not edit myself, go check permission.
		if ( $account_id != null && $account_id != $ca_account['id'] ) {
			// check permission
			if ( $this->account_model->check_admin_permission( 'account_perm', 'account_edit_perm' ) != true ) {unset( $ca_account ); redirect( 'site-admin' );}
		}
		
		// no account_id set, load from cookie
		if ( !is_numeric( $account_id ) ) {
			$account_id = $ca_account['id'];
		}
		unset( $ca_account );
		
		// load data for form
		$row = $this->account_model->get_account_data( array( 'account_id' => $account_id ) );
		
		if ( $row == null ) {
			// not found selected account_id.
			redirect( 'site-admin' );
		}
		
		$output['account_id'] = $row->account_id;
		$output['account_username'] = $row->account_username;
		$output['nickname'] = $row->nickname;
		$output['account_email'] = $row->account_email;
		$output['account_fullname'] = $row->account_fullname;
		$output['account_birthdate'] = $row->account_birthdate;
		$output['account_avatar'] = $row->account_avatar;
		$output['account_timezone'] = $row->account_timezone;
		$output['account_status'] = $row->account_status;
		$output['account_status_text'] = $row->account_status_text;
		$output['level_group_id'] = $row->level_group_id;
		
		// for future use
		$output['row'] = $row;

		// check if editing higher level?
		if ( !$this->account_model->can_i_add_edit_account( $output['level_group_id'] ) ) {
			// you cannot edit this user because he/she has higher role than you
			$query->free_result();
			$this->load->library( 'session' );
			$this->session->set_flashdata( 'form_status', '<div class="txt_error alert alert-error">'.$this->lang->line( 'account_cannot_edit_account_higher_your_level' ).'</div>' );
			redirect( 'site-admin/account' );
		}
		
		// list level group for select
		$output['list_level'] = $this->account_model->list_level_group();
		
		// post method. save action
		if ( $this->input->post() ) {
			$data['account_id'] = $account_id;
			$data['account_old_email'] = $row->account_email;
			$data['account_username'] = htmlspecialchars( trim( $this->input->post( 'account_email' ) ), ENT_QUOTES, config_item( 'charset' ) );
				if ( empty( $data['account_username'] ) ) {$data['account_username'] = $row->account_username;}
			$data['account_email'] = strip_tags( trim( $this->input->post( 'account_email', true ) ) );
			$data['account_password'] = trim( $this->input->post( 'account_password' ) );
			$data['account_new_password'] = trim( $this->input->post( 'account_new_password' ) );
			$data['account_fullname'] = htmlspecialchars( trim( $this->input->post( 'nickname' ) ),ENT_QUOTES, config_item( 'charset' ) );
				if ( empty( $data['account_fullname'] ) ) {$data['account_fullname'] = null;}
			$data['account_birthdate'] = strip_tags( trim( $this->input->post( 'account_birthdate' ) ) );
				if ( empty( $data['account_birthdate'] ) ) {$data['account_birthdate'] = null;}
			$data['account_timezone'] = trim( $this->input->post( 'account_timezone' ) );
			$data['account_status'] = $this->input->post( 'account_status' );
			$data['account_status_text'] = trim( $this->input->post( 'account_status_text', true ) );
				if ( empty( $data['account_status_text'] ) ) {$data['account_status_text'] = null;}
			$data['level_group_id'] = $this->input->post( 'level_group_id' );

			$data['nickname'] = ( $this->input->post( 'nickname' ) ) ? $this->input->post( 'nickname' ) : 'NickName' ;
			
			// load form validation
			$this->load->library( 'form_validation' );
			$this->form_validation->set_rules( 'account_email', 'lang:account_email', 'trim|required|valid_email|xss_clean' );
			$this->form_validation->set_rules( 'account_birthdate', 'lang:account_birthdate', 'trim|preg_match_date' );
			$this->form_validation->set_rules( 'account_status', 'lang:account_status', 'trim|required' );
			$this->form_validation->set_rules( 'level_group_id', 'lang:account_level', 'trim|required' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert"></button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
			} else {
				// save
				$result = $this->account_model->edit_account( $data );
				
				if ( $result === true ) {
					// load session library
					$this->load->library( 'session' );
					$this->session->set_flashdata( 'form_status', '<div class="txt_success alert alert-success">'.$this->lang->line( 'admin_saved' ).'</div>' );
					redirect( 'site-admin/member/member_admin' );
				} else {
					$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert"></button>'.$result.'</div>';
				}
			}

			// re-populate form
			$output['account_username'] = $data['account_username'];
			$output['account_email'] = $data['account_email'];
			$output['account_fullname'] = $data['account_fullname'];
			$output['account_birthdate'] = $data['account_birthdate'];
			$output['account_timezone'] = $data['account_timezone'];
			$output['account_status'] = $data['account_status'];
			$output['account_status_text'] = $data['account_status_text'];
			$output['nickname'] = $data['nickname'];
			$output['level_group_id'] = $data['level_group_id'];
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_accounts' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		

		$output['this_title_page'] = 'Account';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Account Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;

		// output
		$this->generate_page( 'site-admin/templates/account/account_ae_view', $output );
	}// edit
	
	
	function index() {

		redirect( 'site-admin/account' );

		// check permission
		if ( $this->account_model->check_admin_permission( 'account_perm', 'account_manage_perm' ) != true ) {redirect( 'site-admin' );}
		
		// sort
		$output['sort'] = ($this->input->get( 'sort' ) == null || $this->input->get( 'sort' ) == 'asc' ? 'desc' : 'asc' );
		
		// list item
		$output['list_item'] = $this->account_model->list_account();
		if ( is_array( $output['list_item'] ) ) {
			$output['pagination'] = $this->pagination->create_links();
		}
		
		// load session for flashdata
		$this->load->library( 'session' );
		$form_status = $this->session->flashdata( 'form_status' );
		if ( $form_status != null ) {
			$output['form_status'] = $form_status;
		}
		unset( $form_status );
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_accounts' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'site-admin/templates/account/account_view', $output );
	}// index
	
	
	function process_bulk() {
		$id = $this->input->post( 'id' );
		$act = trim( $this->input->post( 'act' ) );
		
		if ( $act == 'del' ) {
			// check permission
			if ( $this->account_model->check_admin_permission( 'account_perm', 'account_delete_perm' ) != true ) {redirect( 'site-admin' );}
			if ( is_array( $id ) ) {
				foreach ( $id as $an_id ) {
					// check if delete higher level than yours
					$target_level_group_id = $this->account_model->show_account_level_info( $an_id );
					
					if ( $target_level_group_id == false ) {break;}
					
					if ( $this->account_model->can_i_add_edit_account( $target_level_group_id ) == true ) {
						// delete account
						$this->account_model->delete_account( $an_id );
					}
				}
			}
		}
		
		// go back
		$this->load->library( 'user_agent' );
		if ( $this->agent->is_referral() ) {
			redirect( $this->agent->referrer() );
		} else {
			redirect( 'site-admin/account' );
		}
	}// process_bulk
	
	
	function viewlog( $account_id = '' ) {
		if ( !is_numeric( $account_id ) ) {redirect( 'site-admin' );}
		
		// check permission
		if ( $this->account_model->check_admin_permission( 'account_perm', 'account_viewlog_perm' ) != true ) {redirect( 'site-admin' );}
		
		// load session for flashdata
		$this->load->library( 'session' );
		$form_status = $this->session->flashdata( 'form_status' );
		if ( $form_status != null ) {
			$output['form_status'] = $form_status;
		}
		
		// check if viewing higher level than yours?
		$target_level_group_id = $this->account_model->show_account_level_info( $account_id );
		if ( $target_level_group_id == false ) {redirect( 'site-admin' );}
		if ( $this->account_model->can_i_add_edit_account( $target_level_group_id ) == false ) {redirect( 'site-admin' );}
		
		// list logins
		$output['account_id'] = $account_id;
		$output['account_username'] = $this->account_model->show_accounts_info( $account_id, 'account_id', 'account_username' );
		
		// sort
		$output['sort'] = ($this->input->get( 'sort' ) == null || $this->input->get( 'sort' ) == 'desc' ? 'asc' : 'desc' );
		$output['list_item'] = $this->account_model->list_account_logins( $account_id );
		if ( is_array( $output['list_item'] ) ) {
			$output['pagination'] = $this->pagination->create_links();
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_view_logins' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'site-admin/templates/account/account_viewlog_view', $output );
	}// viewlog
	

}

