<?php

class qa_evaluation extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('qa_evaluation/qa_evaluation_model');
	}

	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'QA_Evaluation', 'Access QA_Evaluation' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-inbox"></i> QA_Evaluation';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'QA_Evaluation' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'QA_Evaluation';

		$output['data_list'] = $this->qa_evaluation_model->get_list();	
	
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );

	}// index

	public function qa_evaluation_add( $language_id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'QA_Evaluation', 'Add QA_Evaluation' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

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
		 			$last_id = $this->qa_evaluation_model->add( $data_post );
		 			$this->seotag_model->edit_seotag( 'qa_evaluation' , 'qa_evaluation_'.$last_id , $data_seo );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/qa_evaluation' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}


		$output['this_title_page'] = '<i class="icon-inbox"></i> QA_Evaluation Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'QA_Evaluation' => site_url('site-admin/qa_evaluation') , 'QA_Evaluation Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'QA_Evaluation';
		$output['hover_sub_menu'] ='QA_Evaluation List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

	public function qa_evaluation_edit( $id = '' )
	{


		if ( $this->account_model->check_admin_permission( 'QA_Evaluation', 'Edit QA_Evaluation' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );


		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();				
			
		 		$array_validation = array( 'title' => 'Title' ,'detail'=>'Detail','qa_evaluation_date'=>'QA_Evaluation Date');

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

		 			$this->qa_evaluation_model->edit( $id , $data_post );

		 			$this->seotag_model->edit_seotag( 'qa_evaluation' , 'qa_evaluation_'.$id , $data_seo );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/qa_evaluation' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------


		}
		else
		{

			$output['show_data'] = $this->qa_evaluation_model->get_data( $id );
						
			$data_seo = $this->seotag_model->get_data( 'qa_evaluation' , 'qa_evaluation_'.$id );
			foreach ( $data_seo as $key => $value ) 
			{
				$output['show_data']['seotag'][ $value->language_id ][ $value->tag_name ] = $value->value;
			}			
			

		}

		
		$output['this_title_page'] = '<i class="icon-inbox"></i> QA_Evaluation Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'qa_evaluation' => site_url('site-admin/qa_evaluation') , 'QA_Evaluation Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'QA_Evaluation';
		$output['hover_sub_menu'] ='QA_Evaluation List';



		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
		
	}	


	public function qa_evaluation_delete( $id = '' )
	{
		if ( $this->account_model->check_admin_permission( 'QA_Evaluation', 'Delete QA_Evaluation' ) != true ) { die(); }

		$this->db->where( 'id', $id );
		$this->db->delete( 'qa_evaluation_config' );

		$this->db->where( 'qa_evaluation_id', $id );
		$this->db->delete( 'qa_evaluation_detail' );

		echo "1";

	}	
	
	public function mark_sort_qa_evaluation()
	{

		if ( $this->account_model->check_admin_permission( 'QA_Evaluation', 'Sort QA_Evaluation' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		if ( $this->input->post() ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'qa_evaluation_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/qa_evaluation' );
	}
	
	/** END NEW SUBSCRIBE **/

	// -------------------------------------





}