<?php

class member extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('member/member_model');
		$this->load->model( 'type_setting/ftype_setting_model' );
	}
	
	
	function index() 
	{
		redirect( site_url( 'member/account' ) );
		// SET VALUE
		// $output = '';

		// $data_account = $this->account_model->get_account_cookie( 'member' );

		// $data_user = $this->member_model->get_data( $data_account['id'] );

		// $output['data_user'] = $data_user;

		// $output['generation_list'] = $this->member_model->generation_list( '' , 'font' );

		// $output['business_type_list'] = $this->member_model->business_type_list( '' , 'font' );

		// $output['get_list'] = $this->member_model->get_list( 'front' );

		// foreach ( $output['get_list'] as $key => $value ) 
		// {
		// 	$name_business_type = $this->member_model->business_type_list( $value->business_type );
		// 	$output['get_list'][$key]->name_business_type = $name_business_type[0]->business_type_name;
		// 	$output['get_list'][$key]->logo_image = base_url().call_image_site( $value->account_avatar , 150 , 150 , '' , 'front' , true );
		// }

		// $this->generate_page( 'front/front_member_view', $output );
	}// index
	
	public function account()
	{

		redirect( site_url() );

		$data_account = $this->account_model->get_account_cookie( 'member' );

		if ( empty( $data_account ) ) 
		{
			redirect( site_url( 'home' ) );
		} 
		else 
		{
			$id = $data_account['id'];
		}
		

		// SET VALUE
		$output = '';

		$output['form_status'] = $this->session->flashdata( 'form_status' );

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START EDIT CONTENT
			*
			**/
				

		 		$array_validation = array( 'name' => 'Name' ,  'account_email' => 'Email' , 'member_type' => 'Member type' , 'package_type' => 'Package Type' );

		 		foreach ( $array_validation as $key => $value ) 
		 		{
		 			if ( ! $this->input->post( $key ) ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 		}

		 		if ( $this->input->post( 'account_email' ) ) 
		 		{
		 			$check = $this->member_model->check_email( $this->input->post( 'account_email' ) , $id );
		 			if ( $check ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ 'account_email' ];
		 			}
		 		}


		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output[ 'error_validation' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			$this->member_model->edit( $id , $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'member/account' );
		 		}
			
			/** END EDIT CONTENT **/
			
			// -------------------------------------
		
		}


		

		$output['show_data'] = $this->member_model->get_data( $id );

		$output['type_list'] = $this->ftype_setting_model->get_type( 'member_type' );
		$output['package_list'] = $this->ftype_setting_model->get_type( 'package_type' );


		$output['show_data'] = json_decode(json_encode( $output['show_data'] ), FALSE);


		$this->generate_page( 'front/front_member_account_view', $output );
	}

	public function ajax_data()
	{

		$generation = $this->input->post('generation');
		$business_type = $this->input->post('business_type');
		$string = $this->input->post('string');
		$sex = $this->input->post('sex');


		$generation = ( $this->input->post('generation') ) ? $generation : '' ;
		$business_type = ( $this->input->post('business_type') ) ? $business_type : '' ;		
		$string = ( $this->input->post('string') ) ? $string : '' ;		

		$output['get_list'] = $this->member_model->get_list( 'front' , $generation , $business_type , $string , $sex );

		foreach ( $output['get_list'] as $key => $value ) 
		{
			$name_business_type = $this->member_model->business_type_list( $value->business_type );
			$output['get_list'][$key]->name_business_type = $name_business_type[0]->business_type_name;
			$output['get_list'][$key]->logo_image = base_url().call_image_site( $value->account_avatar , 150 , 150 , '' , 'front' , true );
		}
		
		$this->load->view( 'modules/member/views/front/ajax_member_view', $output );

	}


	public function select_photo_upload()
	{
		//upload images
		require_once( APPPATH.'libraries/phpthumb/ThumbLib.inc.php' );			

		//--- change name -------------------
		$file_name = explode('.',$_FILES['uploadfile']['name']);

		$md = md5( $_FILES['uploadfile']['name'].uniqid( time() ) );    
		$filename = $md.'.'.$file_name[1];  
		
		$uploaddir = './uploads/logo_user/';   //path name save
		makeAll( 'uploads/logo_user/' );

		$file = $uploaddir . $filename;	
				 
		if ( move_uploaded_file( $_FILES['uploadfile']['tmp_name'], $file ) ) 
		{ 
			echo $filename;			
		}

	}

	public function delete_image()
	{
		if ( $this->input->post( 'path' ) ) 
		{
			if ( file_exists( $this->input->post( 'path' ) ) ) 
			{
				$path = './'.$this->input->post( 'path' );
				unlink( $path );
			}
			return true;
		}
		return false;
	}



	private function register()
	{
		// SET OUTPUT
		$output = '';

		$output['type_list'] = $this->ftype_setting_model->get_type( 'member_type' );
		$output['package_list'] = $this->ftype_setting_model->get_type( 'package_type' );


		$this->load->view( 'application/views/register_view', $output );
	}

	private function login()
	{
		// SET OUTPUT
		$output = '';

		$this->load->view( 'application/views/login_view', $output );
	}



	public function forgetpassword() {


		if ( ! $this->input->post('email') ) {

			$tt['text'] = 'ข้อมูลอีเมล์ไม่ถูกต้อง กรุณาใส่ข้อมูลใหม่อีกครั้ง';
			$tt['error'] = 1;
			echo $object = json_encode($tt);
			return false;

		}


		$this->db->where( 'account_email', $this->input->post('email') );
		$query = $this->db->get( 'accounts' );
		$data = $query->row();

		if ( empty( $data ) ) {
			$tt['text'] = 'ไม่มีข้อมูลอีเมล์ '.$this->input->post('email') . 'อยู่ในระบบ กรุณาใส่ข้อมูลใหม่อีกครั้ง';
			$tt['error'] = 1;
			echo $object = json_encode($tt);
			return false;
		}

		$this->db->where( 'account_email', $this->input->post('email') );
		$this->db->set( 'code_resetpassword', time() );
		$this->db->update( 'accounts' );

		$this->db->where( 'account_email', $this->input->post('email') );
		$query = $this->db->get( 'accounts' );
		$data = $query->row();


 		/**
 		*
 		*** START BLOCK COMMENT
 		*
 		**/
 		
		require ABSPATH.'/libraries/phpmailer/class.phpmailer.php';
		
		$gmail_username = "me@acodify.com";
		$gmail_password = "or4yTVJF9JzoAN4ReXJnoA@";
		$subject = 'Forget Password';

		$data_mail_set = $this->content_config_model->get( 'contact_email' );
		$data_mail_set = export_email( $data_mail_set );
		$mailform = ( ! empty( $data_mail_set[0] ) ) ? $data_mail_set[0] : 'admin@system.com';
		
		// MAIL TO
		$mailto = $this->input->post('email');
		
		$mailadmin = "";
		$MsgHTML = '<span style="font-size: 13px; font-family:Tahoma; color:#000;">
					
					
					<table width="100%" border="0" cellspacing="1" cellpadding="4">
					  <tr>
						<td>อีเมล์แจ้งการเปลียน Password จากเว็บไซต์ '.base_url().' </td>
					  </tr>
					  <tr>
						<td>==============================================</td>
					  </tr>
					  <tr>
						<td>อีเมล์ของคุณคือ '. $this->input->post('email') .'</td>
					  </tr>
					  <tr>
						<td>อีเมลนี้ส่งมาจาก เว็บไซต์ '.base_url().'</td>
					  </tr>
					  <tr>
						<td>
						เพื่อเป็นการเปลียนรหัสผ่านจากเว็ป '.base_url().' คุณสามารถเปลียนรหัสจาก URL ทางด้านล้าง
						</td>
					  </tr>
					  <tr>
						<td>
							----------------------------------------------------------------------<br>
							วิธีการเปลียนรหัสผ่าน<br>
							----------------------------------------------------------------------<br>    
						</td>
					  </tr>
					  <tr>
						<td>
							เมื่อทำการกดลิงค์ ยืนยันการเปลียนรหัสผ่าน<br>
							ระบบจะทำการเปิดหน้าใหม่เพื่อให้ท่านได้ใส่รหัสใหม่<br>
							การเปลียนจะเสร็จสมบูรณ์ก็ตือเมือ่ท่านกดปุ่มตกลงเพื่อเปลียนรหัสผ่าน<br>     
						</td>
					  </tr>
					  <tr>
						<td><a href="'. site_url( 'member/resetpassword/'.$data->code_resetpassword ) .'">ยืนยันการเปลียนรหัสผ่าน</a></td>
					  </tr>
					  <tr>
						<td>
							(หรือคัดลอก '.site_url( 'member/resetpassword/'.$data->code_resetpassword ).' ไปวางที่บราวเซอร์ที่คุณใช้)<br>
							ขอบคุณสำหรับการลงทะเบียนใช้งานเว็บไซต์ของเราขอให้สนุกกับการใช้งาน<br><br>    
						</td>
					  </tr>
					  <tr>
						<td>
							ขอแสดงความนับถือ<br><br>
							'.base_url().'<br>
							ผู้ดูแลระบบ<br>    
						</td>
					  </tr>
					  <tr>
						<td></td>
					  </tr>
					</table>
					
					</span>';
		
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP
		
        try {
            // $mail->Encoding = "quoted-printable";
            $mail->CharSet = "utf-8";
           
            // send mail by gmail
            $mail->SMTPAuth = true; // enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
            $mail->Host = "smtp.mandrillapp.com"; // sets GMAIL as the SMTP server
            $mail->Port = 587; // set the SMTP port for the GMAIL server
            $mail->Username = $gmail_username; // GMAIL username
            $mail->Password = $gmail_password; // GMAIL password
            
            $mail->AddReplyTo($mailform);
            $mail->AddAddress($mailto, $mailadmin);
            $mail->SetFrom($mailform);
            $mail->Subject = $subject;
            $mail->MsgHTML($MsgHTML);
			// $mail->Body = $MsgHTML; 
            $mail->Send();
        }
        catch (phpmailerException$e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        }
        catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }	 		
	 		
 		/** END BLOCK COMMENT **/
 		
 		// -------------------------------------


 		$tt['text'] = 'ได้ทำการส่งข้อมูล reset password ไปที่ E-mail : '. $this->input->post('email') .' แล้ว กรุณาเช็คเมล์เพื่อทำการ reset pasword ';
 		$tt['error'] = 0;

 		echo $object = json_encode($tt);

 		return true;
		
	}// END forgetpassword 


	public function set_password( $value = '' ) {

		$output = '';
		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default();
		$output['this_lang'] = $this_lang;
		/** END LANG **/



		$output['page_title'] = $this->html_model->gen_title( lang_get( 'Forget Password' ) );
		$this->generate_page( 'front/set_forgetpassword_view', $output );
		
	}// END set_password 


	public function resetpassword($info = '') {
		
		$output = '';

		$this->db->where( 'code_resetpassword', $info );
		$query = $this->db->get( 'accounts' );
		$num_row = $query->num_rows();

		if ( empty( $num_row ) ) {

			$message = lang_get( 'Code for change password is expire' );
			echo "<script type='text/javascript'>alert('$message'); window.location = '/'; </script>";
			 
		}

		if ( $this->input->post() ) {

			if ( $this->input->post('password') != $this->input->post('c_password')  ) {
				$error_validation[] = 'ข้อมูล Password ไม่ถูกต้อง';
				$output[ 'error_validation' ] = preview_error( $error_validation );
				$this->generate_page( 'front/reset_password_view', $output );
				return false;
			}
			
			$this->db->where( 'account_email', $this->input->post('email') );
			$this->db->where( 'code_resetpassword', $info );
			$query = $this->db->get( 'accounts' );
			$num_row = $query->num_rows();

			if ( empty( $num_row ) ) {
				
				$error_validation[] = 'ข้อมูลอีเมล์ไม่ถูกต้อง';
				$output[ 'error_validation' ] = preview_error( $error_validation );
				$this->generate_page( 'front/reset_password_view', $output );
				return false;

			}


			$this->db->where( 'account_email', $this->input->post('email') );
			$this->db->where( 'code_resetpassword', $info );
			$this->db->set( 'account_password', $this->encrypt_password( $this->input->post('password') ) );
			$this->db->set( 'code_resetpassword', '' );
			$this->db->update( 'accounts' );

			$output['success'] = '<div class="alert alert-success"><strong>'.lang_get("Success!").' </strong>'.lang_get('System reset password success').'</div>';



		}	
		
		$this->generate_page( 'front/reset_password_view', $output );

	}// END resetpassword 


	public function view_forgetpassword( $value = '' ) {
		
		$output = '';
		$this->load->view( 'modules/member/views/front/form_forgetpassword', $output );
			
	}// END view_forgetpassword 	


	/**
	 * encrypt_password
	 * @param string $password
	 * @return string
	 */
	function encrypt_password( $password = '' ) {
		$this->load->library( 'encrypt' );
		return $this->encrypt->sha1( $this->config->item( 'encryption_key' ).'::'.$this->encrypt->sha1( $password ) );
	}// encrypt_password


	public function detail() {
	
		$output = '';
		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default();
		$output['this_lang'] = $this_lang;
		/** END LANG **/


		$data_account = $this->account_model->get_account_cookie( 'member' );


		$this->db->where( 'account_id', $data_account['id'] );
		$query = $this->db->get( 'accounts' );
		$data = $query->row();

		$show_data = array();
		$show_data['image'] = $data->account_avatar;
		$show_data['name_lastname'] = $data->account_fullname;
		$show_data['birthdate'] = $data->account_birthdate;
		$show_data['gender'] = $data->gender;
		$show_data['email'] = $data->account_username;
		$show_data['nickname'] = $data->nickname;




		$output['form_status'] = $this->session->flashdata( 'form_status' );


		if ( $this->input->post() ) {
			

			$data_post = $this->input->post();
		
	 		$array_validation = array( 'name_lastname' => 'Name and LastName' , 'birthdate' => 'Birthdate' , 'gender' => 'Gender' , 'email' => 'E-mail' , 'nickname' => 'NickName' );

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

	
	 		if ( $this->input->post('password') OR $this->input->post('n_password') ) {
	 				
	 			if ( $this->input->post('n_password') ) {
	 				
	 				if ( empty( $data_account['id'] ) ) {
	 					redirect( site_url() );
	 				}

	 				$data = $this->member_model->get_data( $data_account['id'] );

	 				$new_password = $this->encrypt_password( $this->input->post('password') );

	 				if ( $new_password != $data['account_password'] ) {
	 					$error_validation[] = lang_get('Password is not match');
	 				}

	 			}
	 			else
	 			{
	 				$error_validation[] = lang_get('Please enter new password');
	 			}

	 		}

	 		if ( $this->input->post('email') ) {
	 			if ( $this->account_model->has_mail_register( $this->input->post('email') , $data_account['id'] ) ) {
	 				$error_validation[] = lang_get( 'This email is in the system, Please try again' );	
	 			}
	 		}
	 		if ( $this->input->post('nickname') ) {
	 			if ( $this->account_model->has_nickname( $this->input->post('nickname') , $data_account['id'] ) ) {
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

	 			$data_post['id'] = $data_account['id'];

	 			$this->account_model->edit_new_account( $data_post );
				$this->session->set_flashdata( 'form_status', preview_success( lang_get( 'Change data account success' ) ) );
				redirect( 'member/detail' );
	 		}


		}else{
			$output['show_data'] = $show_data;
		}

		


		$script = array(
					'<script type="text/javascript" src="'.$this->theme_path.'/js/ajaxupload.js"></script>',
					);
		$output['page_script'] = $this->html_model->gen_tags( $script );
		$output['page_title'] = $this->html_model->gen_title( lang_get( 'Account Detail' ) );
		$this->generate_page( 'front/front_member_account_view', $output );
	}// END detail 


}
