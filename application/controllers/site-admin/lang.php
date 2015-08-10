<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lang extends admin_controller 
{

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model( 'lang_model' );

	}// __construct

	function index()
	{
		// SET VALUE
		$output = '';

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = 'language';
		$breadcrumb = array( 'Setting' => site_url('site-admin') , 'language' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'language';


		// SET DATA
		$output['show_data'] = $this->lang_model->get_list();

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'language' );	

		$this->generate_page( 'site-admin/templates/lang/lang_admin_index_view', $output );
	}


	public function lang_form( $id = '' )
	{
		
		// SET VALUE
		$output = '';

		$output['id'] = $id;
		
		if ( $this->input->post() ) 
		{
			
			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'language_name' => 'Language Name' , 'language_code' => 'Language Code' );

		 		foreach ( $array_validation as $key => $value ) 
		 		{
		 			if ( ! $this->input->post( $key ) ) 
		 			{
		 				$error_validation[] = 'Please enter information '.$array_validation[ $key ];
		 			}
		 		}	

		 		if ( ! empty( $error_validation )  ) 
		 		{
		 			$output['show_data'] = $this->input->post();	
		 			$output[ 'error' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{
		 			// CHECK EDIT OR ADD DATA
		 			if ( ! empty( $id ) ) 
		 			{
		 				$this->lang_model->edit_lang( $id , $data_post );
		 			}
		 			else
		 			{
		 				$this->lang_model->add_lang( $this->input->post() );
		 			}
		 			
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/lang' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = 'language';
		$output['hover_menu'] = 'language';
		// CHECK ID NOT EMPTY
		if ( ! empty( $id ) ) 
		{
			// SET DATA
			$output[ 'show_data' ] = $this->lang_model->get_list( $id );
			$breadcrumb = array( 'Setting' => site_url('site-admin') , 
								'language' => site_url( 'site-admin/lang' ) ,
								'language Edit' => '#' );

		} 
		else 
		{
			$breadcrumb = array( 'Setting' => site_url('site-admin') , 
								'language' => site_url( 'site-admin/lang' ) ,
								'language Add' => '#' );
		}
		$output['this_breadcrumb_page'] = $breadcrumb;

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'language' );	

		$this->generate_page( 'site-admin/templates/lang/lang_form_view', $output );		

	}


	public function delete_lang( $id = '' )
	{
		$this->db->where( 'config_name', 'language_default' );
		$this->db->where( 'config_value', $id );
		$query = $this->db->get( 'config' );
		$num_row = $query->num_rows();


		if ( ! empty( $num_row ) ) {
			echo "false";
			return false;
		}

		$this->db->where( 'id', $id );
		$this->db->delete( 'language' );
		echo "1";
		return true;
	}

}