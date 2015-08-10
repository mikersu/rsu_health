<?php

class seotag extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('seotag/seotag_model');
		if ( $this->account_model->check_admin_permission( 'Seo Tag Setting', 'Access Setting' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}
	}
	 
	
	function index( $info = '' ) 
	{

		// SET LANGUAGE
		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		// CHECK VALUE EMPTY IS REDIRECT
		if ( empty( $info ) ) 
		{
			redirect( site_url( 'site-admin' ) );
		}

		// DATA POST
		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/

				$data_post = $this->input->post();

		 		$array_validation = array(  );

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
		 			$this->seotag_model->edit_seotag( $info , 'home_'.$info , $this->input->post() );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/seotag/index/'.$info );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST
		else // ELSE NOT POST
		{
			$show_data = array();
			$data_seo = $this->seotag_model->get_data( $info , 'home_'.$info );

			foreach ( $data_seo as $key => $value ) 
			{
				
				$show_data['seotag'][ $value->language_id ][ $value->tag_name ] = $value->value;

			}

			$output['show_data'] = $show_data;


		}// END NOT POST



		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Seotag';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'seotag' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'SEO Tag Setting';
		$output['hover_sub_menu'] = $info;

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/seotag_admin_index_view' , $output );
	}// index


}

