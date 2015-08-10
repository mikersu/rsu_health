<?php

class setting extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('content_config_model');
	}
	 
	
	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'Setting', 'Delete Cache' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['this_title_page'] = '<i class="icon-cogs"></i> Setting';
		$breadcrumb = array( 'Home' => site_url('site-admin') , "Setting" => '#');
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Setting';
		$output['hover_sub_menu'] = 'Setting Delete Cache';
		$output['form_status'] = $this->session->flashdata( 'form_status' );

		$output['show_data']['setting_image_intro'] = $this->content_config_model->get( 'setting_image_intro' );
		
		$output['list_file'] = glob('cache/*');

		$output['list_file'] = ( ! empty( $output['list_file'] ) ) ? $output['list_file'] : array() ;


		// GET DATA POST
		if ( $this->input->post() ) 
		{
				
			$files = glob('cache/*');
			foreach($files as $file) {
				recursiveDelete( $file );
			}

			$this->session->set_flashdata( 'form_status', preview_success( 'Delete Success' ) );
			redirect( 'site-admin/setting' );
		

		} // END GET DATA POST

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );
	}// index
	

	public function info() {
	
		if ( $this->account_model->check_admin_permission( 'Setting', 'Setting Info' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['this_title_page'] = '<i class="icon-cogs"></i> Setting';
		$breadcrumb = array( 'Home' => site_url('site-admin') , "Setting" => '#' , 'Setting Detail' => site_url('site-admin/setting/info') );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Setting';
		$output['hover_sub_menu'] = 'Setting info';
		$output['form_status'] = $this->session->flashdata( 'form_status' );

		$output['show_data']['company_name'] = $this->content_config_model->get( 'company_name' );
		$output['show_data']['image_company_name'] = $this->content_config_model->get( 'image_company_name' );
		$output['show_data']['logo_company_header'] = $this->content_config_model->get( 'logo_company_header' );
		$output['show_data']['logo_company_footer'] = $this->content_config_model->get( 'logo_company_footer' );
		$output['show_data']['logo_company_ico'] = $this->content_config_model->get( 'logo_company_ico' );

		// GET DATA POST
		if ( $this->input->post() ) 
		{

			$data_post = $this->input->post();


	 		$array_validation = array(  'company_name' => 'Company Name',  'logo_company_header' => 'Logo Company Header',  'logo_company_footer' => 'Logo Company Footer'  );

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

				$output['show_data']['company_name'] = $this->content_config_model->add( 'company_name', $this->input->post('company_name') );
				$output['show_data']['image_company_name'] = $this->content_config_model->add( 'image_company_name', $this->input->post('image_company_name') );
				$output['show_data']['logo_company_header'] = $this->content_config_model->add( 'logo_company_header', $this->input->post('logo_company_header') );
				$output['show_data']['logo_company_footer'] = $this->content_config_model->add( 'logo_company_footer', $this->input->post('logo_company_footer') );
				$output['show_data']['logo_company_ico'] = $this->content_config_model->add( 'logo_company_ico', $this->input->post('logo_company_ico') );
	 			

				$this->session->set_flashdata( 'form_status', preview_success() );
				redirect( 'site-admin/setting/info' );
	 		}

				



			

		} // END GET DATA POST

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_setting_view' , $output );
		
	}// END Namefunciton 


}