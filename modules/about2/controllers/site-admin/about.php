<?php

class about extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('about/about_model');
	}
	 

	public function mark_sort_about()
	{

		if ( $this->account_model->check_admin_permission( 'About', 'Sort About' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'about_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/about' );
	}
	
	public function mark_sort_about_category()
	{
		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'about_category' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/about/category' );
	}
	
	public function mark_sort_about_subcategory()
	{
		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'about_subcategory' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/about/subcategory' );
	}	
	
	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'About', 'Access About' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> About';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'About' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About List';

		$output['data_list'] = $this->about_model->get_list();	
	


		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );

	}// index
	public function category( $language_id = '')
	{
		$output['language'] = $this->lang_model->get_list( '' , 'admin' );
		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> About Category';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'About Category' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About Category';
		foreach ( $output['language'] as $key => $value ) 
		{
			$output['data_list'][$value->id]= $this->about_model->list_category($value->id);	
		}	
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );	
		$this->generate_page( 'site-admin/admin_index_category' , $output );	
	}	
	public function add_category( $language_id = '',$id='')
	{

		$output['language'] = $this->lang_model->get_list( $language_id , 'front' );

		if ( empty( $language_id ) ) 
		{
			redirect( site_url( 'site-admin/about/category' ) );
		}
		else
		{
			$output['language_id'] = $language_id;
		}

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'submenu' => 'Submenu');

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

		 			$last_id = $this->about_model->add_category( $data_post,$id);

		 			$this->seotag_model->edit_seotag( 'page_about' , 'page_category_id_'.$last_id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/about/category' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST
		if($id!=''){
			$output['show_data'] = $this->about_model->get_category( $id,'array');
			print_r($output['show_data']);
		}
		
		$output['category_list']=$this->about_model->list_category($language_id);
		$output['this_title_page'] = '<i class="icon-inbox"></i> About Category';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'about' => site_url('site-admin/about/category') , 'About Category' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About Category';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view_category' , $output );

	}	
	public function subcategory( $language_id = '')
	{
		$output['language'] = $this->lang_model->get_list( '' , 'admin' );
		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> About SubCategory';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'About SubCategory' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About SubCategory';
		foreach ( $output['language'] as $key => $value ) 
		{
			$output['data_list'][$value->id]= $this->about_model->list_subcategory($value->id);	
		}	
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );	
		$this->generate_page( 'site-admin/admin_index_subcategory' , $output );	
	}	
	public function add_subcategory( $language_id = '',$id='')
	{

		$output['language'] = $this->lang_model->get_list( $language_id , 'front' );

		if ( empty( $language_id ) ) 
		{
			redirect( site_url( 'site-admin/about/subcategory' ) );
		}
		else
		{
			$output['language_id'] = $language_id;
		}

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'submenu' => 'Submenu');

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

		 			$last_id = $this->about_model->add_subcategory( $data_post,$id);

		 			$this->seotag_model->edit_seotag( 'page_about' , 'page_subcategory_id_'.$last_id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/about/subcategory' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST
		if($id!=''){
			$output['show_data'] = $this->about_model->get_subcategory( $id,'array');
		}
		$output['this_title_page'] = '<i class="icon-inbox"></i> About SubCategory';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'about' => site_url('site-admin/about/subcategory') , 'About SubCategory' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About SubCategory';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view_subcategory' , $output );

	}
	public function about_add( $language_id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'About', 'Add About' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'submenu' => 'Submenu' ,'detail'=>'Detail' );

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
		 			$last_id = $this->about_model->add( $data_post );
		 			$this->seotag_model->edit_seotag( 'about' , 'about_'.$last_id , $data_seo );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/about' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}


		$output['this_title_page'] = '<i class="icon-inbox"></i> About Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'About' => site_url('site-admin/about') , 'About Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

	public function about_edit( $id = '' )
	{


		if ( $this->account_model->check_admin_permission( 'About', 'Edit About' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );


		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();				
			
		 		$array_validation = array( 'submenu' => 'Submenu' ,'detail'=>'Detail','about_date'=>'About Date');

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

		 			$this->about_model->edit( $id , $data_post );

		 			$this->seotag_model->edit_seotag( 'about' , 'about_'.$id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/about' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------


		}
		else
		{

			$output['show_data'] = $this->about_model->get_data( $id );
						
			$data_seo = $this->seotag_model->get_data( 'about' , 'about_'.$id );
			foreach ( $data_seo as $key => $value ) 
			{
				$output['show_data']['seotag'][ $value->language_id ][ $value->tag_name ] = $value->value;
			}			
			

		}

		
		$output['this_title_page'] = '<i class="icon-inbox"></i> About Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'about' => site_url('site-admin/about') , 'About Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'About';
		$output['hover_sub_menu'] ='About List';



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
		
	}	


	public function about_delete( $id = '' )
	{
		if ( $this->account_model->check_admin_permission( 'About', 'Delete About' ) != true ) { die(); }

		$this->db->where( 'id', $id );
		$this->db->delete( 'about_config' );

		$this->db->where( 'about_id', $id );
		$this->db->delete( 'about_detail' );

		echo "1";

	}	


	/** END NEW SUBSCRIBE **/

	// -------------------------------------





}