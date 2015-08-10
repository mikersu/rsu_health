<?php

class member extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('member/member_model');
		if ( $this->account_model->check_admin_permission( 'Member', 'Access Member' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}
	}
	 
	
	function index() 
	{
		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';
		$output['hover_sub_menu'] = 'Member list';

		$output['form_status'] = $this->session->flashdata( 'form_status' );

		$output['data_list'] = $this->member_model->get_list();

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );
	}// index
	

	public function content_text() {
	
		$output = '';
		$output['language'] = $this->lang_model->get_list( '' , 'front' );
		$output['form_status'] = $this->session->flashdata( 'form_status' );
		
		$output['show_data']['member_privacy_policy'] = $this->content_config_model->set_get_all( 'member_privacy_policy' );
		$output['show_data']['member_text_page'] = $this->content_config_model->set_get_all( 'member_text_page' );


		if ( $this->input->post() ) {
			
			$data_post = $this->input->post();

			foreach ( $data_post['member_privacy_policy'] as $key => $value ) {
				
				$this->content_config_model->add( 'member_privacy_policy' , $value , $key );
				$this->content_config_model->add( 'member_text_page' , $data_post['member_text_page'][$key] , $key );

			}


			$this->session->set_flashdata( 'form_status', preview_success() );
			redirect( 'site-admin/member/content_text' );



		}


		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';
		$output['hover_sub_menu'] = 'Content Text';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/content_text_view' , $output );

		
		
	}// END content_text 

	public function member_add()
	{
		$output['member_add'] = true;
		if ( $this->account_model->check_admin_permission( 'Member', 'Add Member' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}
		
		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url('site-admin/member') , 'Member Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START EDIT CONTENT
			*
			**/
				$data_post = $this->input->post();

		 		$array_validation = array( 'account_fullname' => 'Name LastName', 'account_email' => 'E-mail', 'account_birthdate' => 'Birthdate', 'account_password' => 'Password' , 'account_password_confirm' => 'Confirm Password' , 'nickname' => 'Penname'  );

		 		foreach ( $array_validation as $key => $value ) 
		 		{
		 			if ( ! $this->input->post( $key ) ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 		}

		 		if ( $this->input->post( 'account_email' ) ) 
		 		{
		 			$check = $this->member_model->check_email( $this->input->post( 'account_email' ) );
		 			if ( $check ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ 'account_email' ];
		 			}
		 		}

		 		if ( $data_post['account_password'] != $data_post['account_password_confirm']) {
		 			$error_validation[] = 'Password is not match , Please try again';
		 		}



		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output['show_data'] = $this->input->post();
		 			$output[ 'error_validation' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			unset( $data_post['account_password_confirm'] );
		 			$this->member_model->add( $data_post );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/member' );
		 		}
			
			/** END EDIT CONTENT **/
			
			// -------------------------------------
		
		}

		$link = array(
			'<link rel="stylesheet" href="'.$this->theme_path.'assets/jquery-ui/jquery-ui-1.10.1.custom.css" />'
			);
		$output['page_link'] = $this->html_model->gen_tags( $link );

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}


	public function member_edit( $id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'Member', 'Edit Member' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url('site-admin/member') , 'Member Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';
		$output['hover_sub_menu'] = 'Member list';

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START EDIT CONTENT
			*
			**/
				

		 		$array_validation = array( 'account_fullname' => 'Name LastName', 'account_email' => 'E-mail', 'account_birthdate' => 'Birthdate', 'nickname' => 'Penname'  );

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
					redirect( 'site-admin/member' );
		 		}
			
			/** END EDIT CONTENT **/
			
			// -------------------------------------
		

		}

		$link = array(
			'<link rel="stylesheet" href="'.$this->theme_path.'assets/jquery-ui/jquery-ui-1.10.1.custom.css" />'
			);
		$output['page_link'] = $this->html_model->gen_tags( $link );

		$this->load->model( 'type_setting/ftype_setting_model' );

		$output['type_list'] = $this->ftype_setting_model->get_type( 'member_type' );
		$output['package_list'] = $this->ftype_setting_model->get_type( 'package_type' );

		$output['show_data'] = $this->member_model->get_data( $id );

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
	}


	public function other_setting()
	{
		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url( 'site-admin/member' ) , 'Other setting' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';


		$output['data_list'] = $this->member_model->generation_list();

		$output['data_list_type'] = $this->member_model->business_type_list();

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/other_setting_view' , $output );
	}


	public function generation_add()
	{

		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url( 'site-admin/member' ) , 'Other setting' => site_url( 'site-admin/member/other_setting' ) , 'Generation Add' => ''  );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';


		// DATA POST
		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/

				$data_post = $this->input->post();

		 		$array_validation = array( 'detail_left' => 'Detail left' , 'detail_right' => 'Detail Right' );

		 		foreach ( $array_validation as $key => $value ) 
		 		{

		 			// AND is_array_empty( $this->input->post( $key )
		 			if ( ! $this->input->post( $key )  ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 			else if ( is_array( $this->input->post( $key ) ) ) 
		 			{
		 				$set_error = is_array_empty_validate( $this->input->post( $key ) );

		 				foreach ( $set_error as $key_lang => $value_lang ) 
	 					{
	 						$error_validation[] = 'Please enter information '.$array_validation[ $key ].' for language '.$this->lang_model->get_name_lang( $value_lang );
	 					}	
		 			}

		 		}	

		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output['show_data'] = $this->input->post();	
		 			$output[ 'error' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			$this->about_model->edit_about( $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/about' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/generation_view' , $output );
	}


	public function generation_edit( $id )
	{
		
		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url( 'site-admin/member' ) , 'Other setting' => site_url( 'site-admin/member/other_setting' ) , 'Generation Edit' => ''  );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';

		$output['show_data'] = $this->member_model->generation_list( $id );

		$output['show_data'] = ( ! empty( $output['show_data'][0] ) ) ? $output['show_data'][0] : '' ;		

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START EDIT CONTENT
			*
			**/
			
		 		$array_validation = array( 'generation_name' => 'Generation Name' );

		 		foreach ( $array_validation as $key => $value ) 
		 		{
		 			if ( ! $this->input->post( $key ) ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 		}


		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output[ 'error_validation' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			$this->member_model->generation_edit( $id , $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/member/other_setting' );
		 		}
			
			/** END EDIT CONTENT **/
			
			// -------------------------------------


			
		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/generation_view' , $output );
	}


	public function generation_delete( $id = '' )
	{
		$this->db->where( 'id', $id );
		$this->db->delete( 'generation' );
		echo "1";

	}

	public function business_type_delete( $id = '' )
	{
		$this->db->where( 'id', $id );
		$this->db->delete( 'business_type' );
		echo "1";

	}

	public function member_delete( $id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'Member', 'Delete Member' ) != true ) { die();}

		$this->member_model->delete( $id );
		echo "1";
	}





	public function business_type_add()
	{
		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url( 'site-admin/member' ) , 'Other setting' => site_url( 'site-admin/member/other_setting' ) , 'Business type Add' => ''  );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';


		if ( $this->input->post() ) 
		{

			/**
			*
			*** START EDIT CONTENT
			*
			**/
			
		 		$array_validation = array( 'business_type_name' => 'Business Type Name' );

		 		foreach ( $array_validation as $key => $value ) 
		 		{
		 			if ( ! $this->input->post( $key ) ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 		}


		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output[ 'error_validation' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			$this->member_model->business_type_add( $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/member/other_setting' );
		 		}
			
			/** END EDIT CONTENT **/
			
			// -------------------------------------


			
		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/business_type_view' , $output );
	}


	public function business_type_edit( $id )
	{
		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => site_url( 'site-admin/member' ) , 'Other setting' => site_url( 'site-admin/member/other_setting' ) , 'Business Type Edit' => ''  );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';

		$output['show_data'] = $this->member_model->business_type_list( $id );

		$output['show_data'] = ( ! empty( $output['show_data'][0] ) ) ? $output['show_data'][0] : '' ;		

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START EDIT CONTENT
			*
			**/
			
		 		$array_validation = array( 'business_type_name' => 'Business Type Name' );

		 		foreach ( $array_validation as $key => $value ) 
		 		{
		 			if ( ! $this->input->post( $key ) ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 		}


		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output[ 'error_validation' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			$this->member_model->business_type_edit( $id , $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/member/other_setting' );
		 		}
			
			/** END EDIT CONTENT **/
			
			// -------------------------------------


			
		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/business_type_view' , $output );
	}



	public function member_admin() {
	
		if ( $this->account_model->check_admin_permission( 'Member', 'Accress Menu Member Admin' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['this_title_page'] = '<i class="icon-group"></i> Member';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Member' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Member';
		$output['hover_sub_menu'] = 'Member list';

		$output['form_status'] = $this->session->flashdata( 'form_status' );

		$output['data_list'] = $this->member_model->get_list_admin();

		$output['admin_add'] = true;

		$output['over_admin'] = site_url('site-admin/account/edit/');

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );

		
		
	}// END member_admin 





}