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

class forgotpw extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		
		// load helper
		$this->load->helper( array( 'form', 'language' ) );
		
		// load language
		$this->lang->load( 'account' );
	}// __construct
	
	
	function index() {
		$output['plugin_captcha'] = $this->modules_plug->do_action( 'account_show_captcha' );
		
		// submitted email to reset password
		if ( $this->input->post() ) {
			$data['account_email'] = trim( $this->input->post( 'account_email' ) );
			
			// load libraries
			$this->load->library( array( 'form_validation', 'securimage/securimage' ) );
			$this->form_validation->set_rules( 'account_email', 'lang:account_email', 'trim|required|valid_email' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = '<div class="txt_error alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><ul>'.validation_errors( '<li>', '</li>' ).'</ul></div>';
			} else {
				// check captcha
				if ( $output['plugin_captcha'] != null ) {
					// use plugin captcha to check
					if ( $this->modules_plug->do_action( 'account_check_captcha' ) == false ) {
						$output['form_status'] = '<div class="txt_error alert alert-error">'.$this->lang->line( 'account_wrong_captcha_code' ).'</div>';
					} else {
						$continue = true;
					}
				} else {
					// use system captcha to check
					$this->load->library( 'securimage/securimage' );
					if ( $this->securimage->check( $this->input->post( 'captcha', true ) ) == false ) {
						$output['form_status'] = '<div class="txt_error alert alert-error">'.$this->lang->line( 'account_wrong_captcha_code' ).'</div>';
					} else {
						$continue = true;
					}
				}
				
				// if captcha pass
				if ( isset( $continue ) && $continue === true ) {
					$result = $this->account_model->reset_password1( $data['account_email'] );
					
					if ( $result === true ) {
						$output['hide_form'] = true;
						$output['form_status'] = '<div class="txt_success alert alert-success">' . $this->lang->line( 'account_please_check_email_confirm_resetpw' ) . '</div>';
					} else {
						$output['form_status'] = '<div class="txt_error alert alert-error">' . $result . '</div>';
					}
				}
			}
			
			// re-populate form
			$output['account_email'] = $data['account_email'];
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'account_forget_userpass' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		// $this->generate_page( 'front/templates/account/forgotpw_view', $output );

		die();
	}// index
	

	public function get_mail()
	{
		$output = '';

		$this->load->view( 'application/views/forgotpw_view', $output );
	
	} // END FUNCTION get_mail


	/**
	 * encrypt_password
	 * @param string $password
	 * @return string
	 */
	function encrypt_password( $password = '' ) {
		$this->load->library( 'encrypt' );
		return $this->encrypt->sha1( $this->config->item( 'encryption_key' ).'::'.$this->encrypt->sha1( $password ) );
	}// encrypt_password


	public function sent_mail()
	{
	
		$email = $this->input->post('mail');
		$error = '';
		if ( empty( $email ) ) 
		{
			echo $error = lang_get( 'Error Email has invalid , Please try again' );
			return false;
		}

		$this->db->where( 'account_email', $email );
		$query = $this->db->get( 'accounts' );
		$num_row = $query->num_rows();

		if ( empty( $num_row ) ) 
		{
			echo $error = lang_get( 'Error Email has invalid , Please try again' );
			return false;
		}

		$new_password = alphanumeric_rand( 6 );

		$new_password_encode = $this->encrypt_password( $new_password );

		$this->db->where( 'account_email', $email );
		$this->db->set( 'account_password', $new_password_encode );
		$this->db->update( 'accounts' );

		/**
		*
		*** START SET SENT EMAIL	
		*
		**/
		require_once( APPPATH.'libraries/phpmailer/class.phpmailer.php' );

		$mail 				 = new PHPMailer();
		$mail->CharSet 		 = 'UTF-8';
		$body = '';
    	$body .= '<h4>คุณได้ทำการร้องขอ ข้อมูล Password ใหม่ โดย Password ใหม่ของคุณคือ</h4><br>';
    	$body .= '<b>Password : '.$new_password.'</b> <br>';
    	$body .= 'คุณสามารถเข้าไป login ได้ที่ '. site_url( 'home' );
 
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "203.146.117.197"; 
		$mail->Port       = 25;                   // set the SMTP port for the GMAIL server			
		$mail->Username = 'bizidea';
		$mail->Password = 'nyGJELRR';
		
		$email_from = 'contact@bansuannam.com'; 
		$from_name = 'Bansuannam.com';
		$mail->SetFrom( $email_from , $from_name );
		$mail->Subject  = 'Bansuannam Reset Password';
		$mail->MsgHTML( $body );
		$mail->AddAddress( $email );
		
		if(!$mail->Send()) 
		{
		  	// $this->data['error_sent_mail'] = $this->language->get( 'error_sent_mail' );
		} 

		/** END SET SENT EMAIL	 **/

		echo  'true';
		
		return true;

	
	} // END FUNCTION sent_mail

}

