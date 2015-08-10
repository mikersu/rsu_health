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

class register extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'date', 'form', 'language' ) );
		$this->load->model( 'type_setting/ftype_setting_model' );
		
		// load language
		$this->lang->load( 'account' );
	}// __construct
	
	
	function index() {

		redirect( site_url( 'account/register/new_account' ) );

		if ( $this->config_model->load_single( 'member_allow_register' ) == '0' ) {redirect( $this->base_url );}// check for allowed register?
		
		// get plugin captcha for check
		$output['plugin_captcha'] = $this->modules_plug->do_action( 'account_register_show_captcha' );
		
		// save action (register action)
		if ( $this->input->post() ) 
		{

			$data_post = $this->input->post();

			$data['account_username'] = htmlspecialchars( trim( $this->input->post( 'account_email' ) ), ENT_QUOTES, config_item( 'charset' ) );
			$data['account_email'] = strip_tags( trim( $this->input->post( 'account_email', true ) ) );
			$data['account_password'] = trim( $this->input->post( 'account_password' ) );
			
			$data['name'] = $data_post['name'];
			$data['phone'] = $data_post['phone'];
			$data['address'] = $data_post['address'];
			$data['member_type'] = $data_post['member_type'];
			$data['package_type'] = $data_post['package_type'];

			// load form validation
			$this->load->library( 'form_validation' );
			// $this->form_validation->set_rules( 'account_username', 'lang:account_username', 'trim|required|xss_clean|min_length[1]' );
			$this->form_validation->set_rules( 'account_email', 'lang:account_email', 'trim|required|valid_email|xss_clean' );
			$this->form_validation->set_rules( 'account_password', 'lang:account_password', 'trim|required' );
			$this->form_validation->set_rules( 'account_confirm_password', 'lang:account_confirm_password', 'trim|required|matches[account_password]' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
			} else {
				// check plugin captcha
				if ( $output['plugin_captcha'] != null ) {
					// use plugin captcha to check
					if ( $this->modules_plug->do_action( 'account_register_check_captcha' ) == false ) {
						$output['form_status'] = '<div class="txt_error alert alert-error">'.$this->lang->line( 'account_wrong_captcha_code' ).'</div>';
					} else {
						$continue_register = true;
					}
				} else {
					// // use system captcha to check
					// $this->load->library( 'securimage/securimage' );
					// if ( $this->securimage->check( $this->input->post( 'captcha', true ) ) == false ) {
					// 	$output['form_status'] = '<div class="txt_error alert alert-error">'.$this->lang->line( 'account_wrong_captcha_code' ).'</div>';
					// } else {
						$continue_register = true;
					// }
				}
				// if captcha pass
				if ( isset( $continue_register ) && $continue_register === true ) {
					// register action
					$result = $this->account_model->register_account( $data );
					
					if ( $result === true ) {

						redirect( site_url( 'home?register=success' ) );
						$output['hide_register_form'] = true;
						
						// if confirm member by email, use msg check email. if confirm member by admin, use msg wait for admin moderation.
						$member_verfication = $this->config_model->load( 'member_verification' );
						if ( $member_verfication == '1' ) {
							$output['form_status'] = '<div class="txt_success alert alert-success">'.$this->lang->line( 'account_registered_please_check_email' ).'</div>';
						} elseif ( $member_verfication == '2' ) {
							$output['form_status'] = '<div class="txt_success alert alert-success">'.$this->lang->line( 'account_registered_wait_admin_mod' ).'</div>';
						}
					} else {
						$output['form_status'] = '<div class="txt_error alert alert-error">'.$result.'</div>';
					}
				}
			}
			
			// re-populate form
			$output['account_username'] = $data['account_username'];
			$output['account_email'] = $data['account_email'];
			
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_register' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		// $this->generate_page( 'front/templates/account/register_view', $output );


		$output['type_list'] = $this->ftype_setting_model->get_type( 'member_type' );
		$output['package_list'] = $this->ftype_setting_model->get_type( 'package_type' );

		if ( ! empty( $output['form_status'] ) ) 
		{
			// redirect( site_url( 'home?register=error' ) ) ;
		}


		// $this->load->view( 'application/views/register_view', $output );

		// not use in theme ape
		// $this->generate_page( 'public/themes/ape/front/templates/account/register_view', $output );	


	}// index
	

	public function check_register()
	{
	
		$error = '';

		$member_type = $this->input->post('member_type');
		$name = $this->input->post('name');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$package_type = $this->input->post('package_type');
		$account_email = $this->input->post('account_email');
		$account_password = $this->input->post('account_password');
		$account_confirm_password = $this->input->post('account_confirm_password');
		$captcha = $this->input->post('captcha');

		$agree = $this->input->post('agree');


		if ( empty( $member_type ) ) 
		{
			$error .= lang_get( '๏ Require Member type , Please select in fill' )." \n\n";
		}

		if ( empty( $name ) ) 
		{
			$error .= lang_get( '๏ Require Name , Please inter in fill' )." \n\n";
		}

		if ( empty( $package_type ) ) 
		{
			$error .= lang_get( '๏ Require Package type , Please select in fill' )." \n\n";
		}

		if ( empty( $account_email ) ) 
		{
			$error .= lang_get( '๏ Require Email , Please inter in fill' )." \n\n";
		}

		if ( empty( $account_password ) ) 
		{
			$error .= lang_get( '๏ Require Password , Please inter in fill' )." \n\n";
		}

		if ( empty( $account_confirm_password ) ) 
		{
			$error .= lang_get( '๏ Require Confirm Password , Please inter in fill' )." \n\n";
		}

		if ( empty( $agree ) ) 
		{
			$error .= lang_get( '๏ Please checked agreement' )." \n\n";
		}

		if ( $account_password === $account_confirm_password ) 
		{
			# code...
		}
		else
		{
			$error .= lang_get( '๏ Password is not match , Please try again' )." \n\n";
		}

		// check duplicate account (duplicate email)
		$this->db->where( 'account_email', $this->input->post('account_email') );
		$query = $this->db->select( 'account_email' )->get( 'accounts' );
		if ( $query->num_rows() > 0 ) 
		{
			$query->free_result();
			$error .= lang_get( '๏ Email has in the system , Please tre again' )." \n\n";
		}

		$this->load->library( 'securimage/securimage' );
		if ( $this->securimage->check( $this->input->post( 'captcha', true ) ) == false ) {
			$error .= lang_get( '๏ captcha is not match' );
		}

		if ( empty( $error ) ) 
		{
			echo 'true';
		}
		else
		{
			echo $error;
		}
	
	} // END FUNCTION check_register



	public function new_account() {
	
		$data_account = $this->account_model->get_account_cookie( 'member' );

		if ( ! empty( $data_account ) ) 
		{
			redirect( site_url( 'home' ) );
		} 

		
		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default();
		$output['this_lang'] = $this_lang;
		/** END LANG **/

		$output['member_privacy_policy'] = $this->content_config_model->get( 'member_privacy_policy', $this_lang );


		if ( $this->input->post() ) {
			

			$data_post = $this->input->post();
		
	 		$array_validation = array( 'name_lastname' => 'Name and LastName' , 'birthdate' => 'Birthdate' , 'gender' => 'Gender' , 'email' => 'E-mail' , 'password' => 'Password' , 'c_password' => 'Confirm Password' , 'nickname' => 'NickName' , 'checkbox' => 'Acceptance Criteria');

	 		foreach ( $array_validation as $key => $value ) 
	 		{

	 			// AND is_array_empty( $this->input->post( $key )
	 			if ( ! $this->input->post( $key )  ) 
	 			{
	 				$error_validation[] = lang_get('Please enter information').' '.lang_get($array_validation[ $key ]);
	 			}
	 			else if ( is_array( $this->input->post( $key ) ) ) 
	 			{
	 				$set_error = is_array_empty_validate( $this->input->post( $key ) );

	 				foreach ( $set_error as $key_lang => $value_lang ) 
 					{
 						$error_validation[] = lang_get('Please enter information').' '.lang_get($array_validation[ $key ]).' at image number ' .($key_lang+1). ' has empty';
 					}	
	 			}

	 		}	
	
	 		if ( $this->input->post('password') != $this->input->post('c_password') ) {
	 			$error_validation[] = lang_get( 'Password is not match, Please try again' );
	 		}

	 		if ( $this->input->post('email') ) {
	 			if ( $this->account_model->has_mail_register( $this->input->post('email') ) ) {
	 				$error_validation[] = lang_get( 'This email is in the system, Please try again' );	
	 			}
	 		}
	 		if ( $this->input->post('nickname') ) {
	 			if ( $this->account_model->has_nickname( $this->input->post('nickname') ) ) {
	 				$error_validation[] = lang_get( 'This NickName is in the system, Please try again' );	
	 			}
	 		}

	 		if ( ! empty( $error_validation )  ) 
	 		{
	 			$output['show_data'] = $this->input->post();	
	 			$output[ 'error' ] = preview_error( $error_validation );
	 		}
	 		else
	 		{
	 			$this->account_model->add_new_account( $this->input->post() );
				$this->session->set_flashdata( 'form_status', preview_success( lang_get( 'Register success, Please check your email to confirm register' ) ) );
				redirect( 'account/register/new_account' );
	 		}


		}


		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$script = array(
					'<script type="text/javascript" src="'.$this->theme_path.'/js/ajaxupload.js"></script>',
					);
		$output['page_script'] = $this->html_model->gen_tags( $script );
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_register' ) );
		$this->generate_page( 'public/themes/ape/front/templates/account/register_view', $output );	


		
	}// END new 




	public function confirm_code( $code = '' ) {
		

		$output = '';
		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default();
		$output['this_lang'] = $this_lang;
		/** END LANG **/	


		if ( $this->input->post() ) {
		
			$data_post = $this->input->post();
		
	 		$array_validation = array( 'email' => 'E-mail' );

	 		foreach ( $array_validation as $key => $value ) 
	 		{

	 			// AND is_array_empty( $this->input->post( $key )
	 			if ( ! $this->input->post( $key )  ) 
	 			{
	 				$error_validation[] = lang_get('Please enter information').' '.lang_get($array_validation[ $key ]);
	 			}
	 			else if ( is_array( $this->input->post( $key ) ) ) 
	 			{
	 				$set_error = is_array_empty_validate( $this->input->post( $key ) );

	 				foreach ( $set_error as $key_lang => $value_lang ) 
 					{
 						$error_validation[] = lang_get('Please enter information').' '.lang_get($array_validation[ $key ]).' at image number ' .($key_lang+1). ' has empty';
 					}	
	 			}

	 		}	

	 		if ( $this->input->post( 'email' ) AND ! empty( $code ) ) {
	 			

	 			$this->db->where( 'account_email', $this->input->post( 'email' ) );
	 			$this->db->where( 'account_status', 1 );
	 			$query = $this->db->get( 'accounts' );
	 			$num_row = $query->num_rows();

	 			if ( empty( $num_row ) ) {
	
					$this->db->where( 'account_confirm_code', $code );
		 			$this->db->where( 'account_email', $this->input->post( 'email' ) );
		 			$query = $this->db->get( 'accounts' );
		 			$num_row = $query->num_rows();

		 			if ( empty( $num_row ) ) {
		 				$error_validation[] = lang_get('Email or Code is use, Please try again');
		 			}
	 				
	 			}
	 			else
	 			{
	 				$error_validation[] = lang_get('Account Email is Available, Please to page login');
	 			}



	 		}


	 		if ( ! empty( $error_validation )  ) 
	 		{
	 			$output['show_data'] = $this->input->post();	
	 			$output[ 'error' ] = preview_error( $error_validation );
	 		}
	 		else
	 		{
	 			
	 			$this->db->where( 'account_confirm_code', $code );
	 			$this->db->where( 'account_email', $this->input->post( 'email' ) );
	 			$this->db->set( 'account_status', 1 );
	 			$this->db->set( 'account_confirm_code', '' );
	 			$this->db->update( 'accounts' );

				$this->session->set_flashdata( 'form_status', preview_success( lang_get( 'Confirm Register success' ) ) );
				redirect( 'account/register/confirm_code/'.$code );
	 		}



		}

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['page_title'] = $this->html_model->gen_title( lang_get( 'Conifrm Account' ) );
		$this->generate_page( 'public/themes/ape/front/templates/account/confirm_view', $output );	
		
	}// END confirm_code 




}

