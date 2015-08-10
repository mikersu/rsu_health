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

class login extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'form', 'language' ) );
		
		// load language
		$this->lang->load( 'account' );
	}// __construct
	
	
	function index() {

		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default();
		$output['this_lang'] = $this_lang;
		/** END LANG **/


		$data_account = $this->account_model->get_account_cookie( 'member' );
		
		$account_success = $this->session->flashdata( 'form_status' );

		$output['member_text_page'] = $this->content_config_model->get( 'member_text_page', $this_lang );
		
		if ( ! empty( $data_account ) ) 
		{
			redirect( site_url() );
		}

		if ( ! empty( $account_success ) )
		{
			$output['form_status'] = '<div class="txt_error alert alert-success">' . $account_success . '</div>';
		}


		$account_error = $this->session->flashdata( 'account_error' );

		if ( ! empty( $account_error ) ) 
		{
			$output['form_status'] = '<div class="txt_error alert alert-error">'.$account_error.'</div>';
		}


		// set login redirect referrer (when done)
		$this->load->library( 'user_agent' );
		if ( $this->agent->is_referral() && $this->agent->referrer() != current_url() ) {
			$output['go_to'] = urlencode( $this->agent->referrer() );
		}
		if ( $this->input->get( 'rdr' ) != null ) {
			$output['go_to'] = urlencode( $this->input->get( 'rdr', true ) );
		}
		
		// load library
		$this->load->library( array( 'securimage/securimage', 'session' ) );
		
		// read account error. eg. duplicate, simultaneous login error from check_login() in account model.
		$account_error = $this->session->flashdata( 'account_error' );
		if ( $account_error != null ) {
			$output['form_status'] = '<div class="txt_error alert alert-error">' . $account_error . '</div>';
		}

		unset( $account_error );
		
		// count login fail
		// if ( $this->session->userdata( 'fail_count' ) >= 3 || $this->session->userdata( 'show_captcha' ) == true ) {
		// 	$output['show_captcha'] = true;
			
		// 	if ( (time()-$this->session->userdata( 'fail_count_time' ) )/(60) < 30 ) {
		// 		// fail over 30 minute, reset.
		// 		$this->session->unset_userdata( 'fail_count' );
		// 		$this->session->unset_userdata( 'fail_count_time' );
		// 		$this->session->unset_userdata( 'show_captcha' );
		// 	}
		// }
		
		// login submitted
		if ( $this->input->post() ) {

			$output['show_data'] = $this->input->post();

			$data['account_username'] = htmlspecialchars( trim( $this->input->post( 'account_username' ) ), ENT_QUOTES, config_item( 'charset' ) );
			$data['account_password'] = trim( $this->input->post( 'account_password' ) );
			
			// validate form
			$this->load->library( 'form_validation' );
			$this->form_validation->set_rules( 'account_username', 'lang:account_username', 'trim|required' );
			$this->form_validation->set_rules( 'account_password', 'lang:account_password', 'trim|required' );
			if ( $this->form_validation->run() == false ) 
			{
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>'.lang_get( 'Error : E-mail and Password is incorrect' ).'</ul></div>';
			} 
			else 
			{

				$login_fail_last_time = $this->account_model->login_fail_last_time( $data['account_username'] );
				$count_login_fail = $this->account_model->count_login_fail( $data['account_username'] );
				
				// count login fail and wait time
				if ( ($count_login_fail !== false && $login_fail_last_time !== false) && ($count_login_fail > 10 && (time()-strtotime( $login_fail_last_time ))/(60) < 30) ) {
					// login failed over 10 times
					// $result = $this->lang->line( 'account_login_fail_to_many' );

				} else {
					if ( isset( $output['show_captcha'] ) && $output['show_captcha'] == true && $this->securimage->check( strtoupper( trim( $this->input->post( 'captcha', true ) ) ) ) == false ) {
						// $result = $this->lang->line( 'account_wrong_captcha_code' );
					} else {
						// try to login
						$result = $this->account_model->member_login( $data );
					}
				}

				
				// check result and login fail count
				if ( $result === true ) {
					$this->session->unset_userdata( 'fail_count' );
					$this->session->unset_userdata( 'fail_count_time' );
					$this->session->unset_userdata( 'show_captcha' );

					
					if ( !$this->input->is_ajax_request() ) {
						if ( isset( $output['go_to'] ) ) {
							redirect( site_url( 'home' ) );
							// redirect( $this->input->get( 'rdr', true ) );
						} else {
							redirect( site_url( 'home' ) );
						}
					} else {
						// ajax login
						if ( !isset( $output['go_to'] ) ) {
							$output['go_to'] = site_url( 'home' );
						}
						$output['login_status'] = true;
						$this->output->set_content_type( 'application/json' );
						$this->output->set_output( json_encode( $output ) );

						return true;
					}
				} else {

					// fetch last data (after login fail, there is a logins update)
					$login_fail_last_time = $this->account_model->login_fail_last_time( $data['account_username'] );
					$count_login_fail = $this->account_model->count_login_fail( $data['account_username'] );
					
					if ( $count_login_fail > 2 && $this->input->is_ajax_request() ) {
						$output['show_captcha'] = true;
					}
					
					// set session fail_count and fail_count_time
					$this->session->set_userdata( 'fail_count', $count_login_fail );
					$this->session->set_userdata( 'fail_count_time', strtotime( $login_fail_last_time ) );
					
					if ( $count_login_fail >= 3 ) {
						$this->session->set_userdata( 'show_captcha', true );
					}
					$output['form_status'] = '<div class="txt_error alert alert-error">'.$result.'</div>';

				}
				
			}
			
			// re-populate form
			$output['account_username'] = $data['account_username'];
		}
	



		if ( ! empty( $output['form_status'] ) ) 
		{
	
		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_login' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		// $this->generate_page( 'front/templates/account/login_view', $output );

		// $this->load->view( 'front/templates/account/login_view', $output );

		// $this->load->view( 'application/views/login_view', $output );
		
		$this->generate_page( 'public/themes/ape/front/templates/account/login_view', $output );	

	}// index
	

	public function forget_password_code( $info = '' )
	{

		if ( empty( $info ) ) 
		{
			redirect( site_url() );
		}

		// SET VALUE
		$output = '';

		if ( $this->input->post() ) 
		{
			
			if ( $this->input->post( 'password' ) AND $this->input->post( 'confirm_password' ) ) 
			{
				$password = $this->input->post( 'password' );
				$confirm_password = $this->input->post( 'confirm_password' );

				if ( $password === $confirm_password ) 
				{
					
					$this->db->where( 'account_confirm_code', $info );
					$this->db->set( 'account_password', $this->encrypt_password( $password ) );
					$this->db->set( 'account_confirm_code', '' );
					$this->db->update( 'accounts' );
					
					$this->session->set_flashdata( 'form_status', 'ได้ทำการเปลียน password เรียบร้อยแล้ว กรุณา login ใหม่' );

					redirect( site_url( 'account/login' ) );

				}
				else
				{
					$output[ 'error' ] = preview_error( array( 'กรุณาระบุ password ให้ถูกต้อง' ) );
				}
			}
			else
			{
				$output[ 'error' ] = preview_error( array( 'กรุณาระบุ password ให้ถูกต้อง' ) );
			}




		}

		$this->load->view( 'front/templates/account/reset_password', $output );
	}


	public function forget_password()
	{

		if ( ! $this->input->post() ) 
		{
			redirect( site_url() );
		}


		if ( $this->input->post('email')  ) 
		{

			$email_set = $this->input->post('email');
			$this->db->where( 'account_email', $email_set );
			$query = $this->db->get( 'accounts' );
			$num_row = $query->num_rows();

			if ( empty( $num_row ) ) 
			{
				$output['form_status'] = '<div class="alert alert-error"><button class="close" data-dismiss="alert"></button><strong>Error! </strong>ไม่มี Email นี้อยู่ในระบบ</div>';
				$this->load->view( 'front/templates/account/login_view', $output );
				return false;
			}	


			require_once( APPPATH.'libraries/phpmailer/class.phpmailer.php' );
			/**
			*
			*** START PROCESS SYSTEM FORGETPASSWORD
			*
			**/
			
			$this->db->where( 'account_email', $this->input->post('email') );
			$query = $this->db->get( 'accounts' );	
			$num_row = $query->num_rows();

			$number = '';
			if ( ! empty( $num_row ) ) 
			{
				$number = alphanumeric_rand( 5 );
				$this->db->set( 'account_confirm_code', $number );
				$this->db->where( 'account_email', $this->input->post('email') );
				$this->db->update( 'accounts' );

			}
			
			/** END PROCESS SYSTEM FORGETPASSWORD **/
			



    		/**
    		*
    		*** START SET SENT EMAIL	
    		*
    		**/

			$mail 				 = new PHPMailer();
			// $mail->SMTPDebug 	 = 2;
			$mail->CharSet 		 = 'UTF-8';


	    	// $body = sprintf( $file, $this->input->post('email') );
	    	$body = 'คุณได้ทำการร้องขอการ reset password <br><br>';
	    	$body .= 'กรุณา เข้า url : '.site_url( 'account/login/forget_password_code/'.$number ).' เพื่อทำการระบุ password ใหม่';


			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			//$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Host       = "203.146.117.197"; 
			$mail->Port       = 25;                   // set the SMTP port for the GMAIL server
			//$mail->Username   = "2bbride.email@gmail.com";  // GMAIL username
			//$mail->Password   = "RFVujm123@";            // GMAIL password
			
			$mail->Username = 'bizidea';
			$mail->Password = 'nyGJELRR';
			
			$email_from = 'admin@armblub.com'; 
			$from_name = 'armblub.com';
			$mail->SetFrom( $email_from , $from_name );
			$mail->Subject  = 'Armblub Forget Password';
			$mail->MsgHTML( $body );
			$mail->AddAddress( $this->input->post('email') );
			
			if(!$mail->Send()) 
			{
			  	// $this->data['error_sent_mail'] = $this->language->get( 'error_sent_mail' );
			} 
			else 
			{
				$output['form_status'] = '<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><strong>Success! </strong>ระบบจะส่ง Password ใหม่ไปยังอีเมลของท่าน</div>';
				$this->load->view( 'front/templates/account/login_view', $output );
				
			}
    		
    		/** END SET SENT EMAIL	 **/


		}
		else
		{

			$output['form_status'] = '<div class="txt_error alert alert-error">Email ไม่ถูกต้อง</div>';
			$this->load->view( 'front/templates/account/login_view', $output );


		}

	}



    /**
     * encrypt_password
     * @param string $password
     * @return string
     */
    function encrypt_password( $password = '' ) {
        $this->load->library( 'encrypt' );
        return $this->encrypt->sha1( $this->config->item( 'encryption_key' ).'::'.$this->encrypt->sha1( $password ) );
    }// encrypt_password

}

