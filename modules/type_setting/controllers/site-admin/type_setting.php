<?php

class type_setting extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('type_setting/type_setting_model');
	}

	public function mark_sort_type( $type = '' )
	{
		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'type_setting_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/type_setting/table_type/'.$type );
	}

	 
	
	function index() 
	{

		redirect( site_url( 'site-admin' ) );

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = 'Type Setting';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Type Setting' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Type Setting';



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_table_type_setting_view' , $output );

	}// index


	public function table_type( $type = '' )
	{		

		$overset_hover_menu = 'Type Setting';	
		
		// CHECK TYPE AND SET HOVER SUB MENU
		switch ( $type ) 
		{
			case 'member_type':
				$overset_sub_menu = 'Member Type';
				break;

			case 'business_type':
				$overset_sub_menu = 'Business Type';
				$overset_hover_menu = 'Jobs';
				break;

			case 'subject_contact_type':

				$overset_sub_menu = 'Subject Contact Type';
				$overset_hover_menu = 'Contact Us';
				break;

			case 'reservation_type':
				$overset_sub_menu = 'Reservation Type';
				break;

			case 'contact_type':
				$overset_sub_menu = 'Contact Type';
				break;	

			default:
				redirect( site_url( 'site-admin' ) );
				break;
		}

		$output['data_list'] = array();

		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		$output['overset_sub_menu'] = $overset_sub_menu;

		$output['type'] = $type;

		// ------------------------------------------------------------------
		
		// START PROCESS

		// GET DATA 
		$output['data_list'] = $this->type_setting_model->get_type_list( $type );


		foreach ( $output['data_list'] as $key => $value ) 
		{

			$data_detail = $this->type_setting_model->get_type_detail( $value->id );

			if ( ! empty( $data_detail ) ) 
			{
				foreach ( $data_detail as $key_array => $value ) 
				{
					$output['data_list'][$key]->name_type[ $value->language_id ] = $value->name_type;
				}
			}
			else
			{
				$output['data_list'][$key]->name_type = '';
			}

		}


		// ------------------------------------------------------------------

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = 'Type Setting';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Type Setting <span class="icon-angle-right"></span> '.$overset_sub_menu => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = $overset_hover_menu;
		$output['hover_sub_menu'] = $overset_sub_menu;



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_table_type_setting_view' , $output );
	
	} // END FUNCTION table_type
	

	// EDIT
	public function edit_type( $type = '' , $id = '' )
	{
	
		//LANGUAGE
		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		$output['type'] = $type;



		$overset_hover_menu = 'Type Setting';	
		
		// CHECK TYPE AND SET HOVER SUB MENU
		switch ( $type ) 
		{
			case 'member_type':
				$overset_sub_menu = 'Member Type';
				break;

			case 'business_type':
				$overset_sub_menu = 'Business Type';
				$overset_hover_menu = 'Jobs';
				break;

			case 'subject_contact_type':

				$overset_sub_menu = 'Subject Contact Type';
				$overset_hover_menu = 'Contact Us';
				break;

			case 'reservation_type':
				$overset_sub_menu = 'Reservation Type';
				break;

			case 'contact_type':
				$overset_sub_menu = 'Contact Type';
				break;	

			default:
				redirect( site_url( 'site-admin' ) );
				break;
		}



		// GET DATA POST
		if ( $this->input->post() ) 
		{
				
			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();

		 		$array_validation = array( 'name_type' => 'Name Type' );

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
		 			$this->type_setting_model->edit( $type , $id , $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/type_setting/table_type/'.$type );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------			

		} // END GET DATA POST


		$output['show_data'] = $this->type_setting_model->get_type_list( $type , $id , 'admin' , 'array' );

		$data_detail = $this->type_setting_model->get_type_detail( $id );


		foreach ( $data_detail as $key => $value ) 
		{
			$output['show_data']['name_type'][$value->language_id] =  $value->name_type;
		}



		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = 'Type Setting';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Type Setting <span class="icon-angle-right"></span> '.get_type_name($type) => site_url( 'site-admin/type_setting/table_type/'.$type ) , 'Edit type' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = $overset_hover_menu;
		$output['hover_sub_menu'] = $overset_sub_menu;



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_form_type_setting_view' , $output );
	
	} // END FUNCTION edit_type



	// ADD 
	public function add_type( $type = '' , $id = '' )
	{

		//LANGUAGE
		$output['language'] = $this->lang_model->get_list( '' , 'front' );
		$output['type'] = $type;

		// GET DATA POST
		if ( $this->input->post() ) 
		{
				
			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'name_type' => 'Name Type' );

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
	 						$error_validation[] = 'Please enter information '.$array_validation[ $key ].' at image number ' .($key_lang+1). ' has empty';
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
		 			$this->type_setting_model->add( $type , $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/type_setting/table_type/'.$type );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------			

		} // END GET DATA POST


		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = 'Type Setting';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Type Setting <span class="icon-angle-right"></span> '.get_type_name($type) => site_url( 'site-admin/type_setting/table_type/'.$type ) , 'Add type' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$overset_hover_menu = 'Contact Us';
		$output['hover_menu'] = $overset_hover_menu;
		$output['hover_sub_menu'] = get_type_name($type);



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_form_type_setting_view' , $output );

	} // END FUNCTION add_type


	// DELETE
	public function type_setting_delete( $id = '' )
	{
		$this->type_setting_model->delete( $id );
		echo "1";
	} // DELETE


}