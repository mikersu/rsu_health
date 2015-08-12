<?php

class health_new extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('health_new/health_new_model');
	}

	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'Health_new', 'Access Health_new' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> Health_new';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Health_new' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Health_new';

		$output['data_list'] = $this->health_new_model->get_list();	
	
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );

	}// index

	public function health_new_add( $language_id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'Health_new', 'Add Health_new' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'title' => 'Title' ,'detail'=>'Detail' );

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

		 			$data_seo['seotag'] = $data_post['seotag'];
		 			unset($data_post['seotag']);
		 			$last_id = $this->health_new_model->add( $data_post );
		 			$this->seotag_model->edit_seotag( 'health_new' , 'health_new_'.$last_id , $data_seo );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/health_new' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}


		$output['this_title_page'] = '<i class="icon-inbox"></i> Health_new Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Health_new' => site_url('site-admin/health_new') , 'Health_new Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Health_new';
		$output['hover_sub_menu'] ='Health_new List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

	public function health_new_edit( $id = '' )
	{


		if ( $this->account_model->check_admin_permission( 'Health_new', 'Edit Health_new' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );


		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();				
			
		 		$array_validation = array( 'title' => 'Title' ,'detail'=>'Detail','health_new_date'=>'Health_new Date');

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
		 			$output[ 'show_data' ] = $this->input->post();	
		 			$output[ 'error' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			$data_seo['seotag'] = $data_post['seotag'];
		 			unset($data_post['seotag']);

		 			$this->health_new_model->edit( $id , $data_post );

		 			$this->seotag_model->edit_seotag( 'health_new' , 'health_new_'.$id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/health_new' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------


		}
		else
		{

			$output['show_data'] = $this->health_new_model->get_data( $id );
						
			$data_seo = $this->seotag_model->get_data( 'health_new' , 'health_new_'.$id );
			foreach ( $data_seo as $key => $value ) 
			{
				$output['show_data']['seotag'][ $value->language_id ][ $value->tag_name ] = $value->value;
			}			
			

		}

		
		$output['this_title_page'] = '<i class="icon-inbox"></i> Health_new Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'health_new' => site_url('site-admin/health_new') , 'Health_new Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Health_new';
		$output['hover_sub_menu'] ='Health_new List';



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
		
	}	


	public function health_new_delete( $id = '' )
	{
		if ( $this->account_model->check_admin_permission( 'Health_new', 'Delete Health_new' ) != true ) { die(); }

		$this->db->where( 'id', $id );
		$this->db->delete( 'health_new_config' );

		$this->db->where( 'health_new_id', $id );
		$this->db->delete( 'health_new_detail' );

		echo "1";

	}	
	
	public function mark_sort_health_new()
	{

		if ( $this->account_model->check_admin_permission( 'Health_new', 'Sort Health_new' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'health_new_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/health_new' );
	}
	
	/** END NEW SUBSCRIBE **/

	// -------------------------------------





}