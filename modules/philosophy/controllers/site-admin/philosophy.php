<?php

class philosophy extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('philosophy/philosophy_model');
	}
	 

	public function mark_sort_philosophy()
	{

		if ( $this->account_model->check_admin_permission( 'Philosophy', 'Sort Philosophy' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'philosophy_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/philosophy' );
	}
	
	public function mark_sort_philosophy_category()
	{
		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'philosophy_category' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/philosophy/category' );
	}
	
	public function mark_sort_philosophy_subcategory()
	{
		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'philosophy_subcategory' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/philosophy/subcategory' );
	}	
	
	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'Philosophy', 'Access Philosophy' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Philosophy' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy List';

		$output['data_list'] = $this->philosophy_model->get_list();	
	


		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );

	}// index
	public function category( $language_id = '')
	{
		$output['language'] = $this->lang_model->get_list( '' , 'admin' );
		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy Category';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Philosophy Category' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy Category';
		foreach ( $output['language'] as $key => $value ) 
		{
			$output['data_list'][$value->id]= $this->philosophy_model->list_category($value->id);	
		}	
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );	
		$this->generate_page( 'site-admin/admin_index_category' , $output );	
	}	
	public function add_category( $language_id = '',$id='')
	{

		$output['language'] = $this->lang_model->get_list( $language_id , 'front' );

		if ( empty( $language_id ) ) 
		{
			redirect( site_url( 'site-admin/philosophy/category' ) );
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
			
		 		$array_validation = array( 'title' => 'Title');

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

		 			$last_id = $this->philosophy_model->add_category( $data_post,$id);

		 			$this->seotag_model->edit_seotag( 'page_philosophy' , 'page_category_id_'.$last_id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/philosophy/category' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST
		if($id!=''){
			$output['show_data'] = $this->philosophy_model->get_category( $id,'array');
			print_r($output['show_data']);
		}
		
		$output['category_list']=$this->philosophy_model->list_category($language_id);
		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy Category';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'philosophy' => site_url('site-admin/philosophy/category') , 'Philosophy Category' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy Category';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view_category' , $output );

	}	
	public function subcategory( $language_id = '')
	{
		$output['language'] = $this->lang_model->get_list( '' , 'admin' );
		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy SubCategory';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Philosophy SubCategory' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy SubCategory';
		foreach ( $output['language'] as $key => $value ) 
		{
			$output['data_list'][$value->id]= $this->philosophy_model->list_subcategory($value->id);	
		}	
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );	
		$this->generate_page( 'site-admin/admin_index_subcategory' , $output );	
	}	
	public function add_subcategory( $language_id = '',$id='')
	{

		$output['language'] = $this->lang_model->get_list( $language_id , 'front' );

		if ( empty( $language_id ) ) 
		{
			redirect( site_url( 'site-admin/philosophy/subcategory' ) );
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
			
		 		$array_validation = array( 'title' => 'Title');

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

		 			$last_id = $this->philosophy_model->add_subcategory( $data_post,$id);

		 			$this->seotag_model->edit_seotag( 'page_philosophy' , 'page_subcategory_id_'.$last_id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/philosophy/subcategory' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST
		if($id!=''){
			$output['show_data'] = $this->philosophy_model->get_subcategory( $id,'array');
		}
		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy SubCategory';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'philosophy' => site_url('site-admin/philosophy/subcategory') , 'Philosophy SubCategory' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy SubCategory';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view_subcategory' , $output );

	}
	public function philosophy_add( $language_id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'Philosophy', 'Add Philosophy' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

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
		 			$last_id = $this->philosophy_model->add( $data_post );
		 			$this->seotag_model->edit_seotag( 'philosophy' , 'philosophy_'.$last_id , $data_seo );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/philosophy' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}


		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Philosophy' => site_url('site-admin/philosophy') , 'Philosophy Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

	public function philosophy_edit( $id = '' )
	{


		if ( $this->account_model->check_admin_permission( 'Philosophy', 'Edit Philosophy' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );


		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();				
			
		 		$array_validation = array( 'title' => 'Title' ,'detail'=>'Detail','philosophy_date'=>'Philosophy Date');

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

		 			$this->philosophy_model->edit( $id , $data_post );

		 			$this->seotag_model->edit_seotag( 'philosophy' , 'philosophy_'.$id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/philosophy' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------


		}
		else
		{

			$output['show_data'] = $this->philosophy_model->get_data( $id );
						
			$data_seo = $this->seotag_model->get_data( 'philosophy' , 'philosophy_'.$id );
			foreach ( $data_seo as $key => $value ) 
			{
				$output['show_data']['seotag'][ $value->language_id ][ $value->tag_name ] = $value->value;
			}			
			

		}

		
		$output['this_title_page'] = '<i class="icon-inbox"></i> Philosophy Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'philosophy' => site_url('site-admin/philosophy') , 'Philosophy Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Philosophy';
		$output['hover_sub_menu'] ='Philosophy List';



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
		
	}	


	public function philosophy_delete( $id = '' )
	{
		if ( $this->account_model->check_admin_permission( 'Philosophy', 'Delete Philosophy' ) != true ) { die(); }

		$this->db->where( 'id', $id );
		$this->db->delete( 'philosophy_config' );

		$this->db->where( 'philosophy_id', $id );
		$this->db->delete( 'philosophy_detail' );

		echo "1";

	}	
	public function del_category( $id = '' )
	{
		

		// echo "1";
	}
		


	/** END NEW SUBSCRIBE **/

	// -------------------------------------





}