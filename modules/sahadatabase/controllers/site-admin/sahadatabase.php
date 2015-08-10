<?php

class sahadatabase extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('sahadatabase/sahadatabase_model');
	}
	 
	
	function index() 
	{
		$output['this_title_page'] = 'Saha Database';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Saha Database' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Saha Database';

		$output['data_list'] = $this->sahadatabase_model->get_list();


		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );
	}// index

	public function sahadatabase_add()
	{
		$output['this_title_page'] = 'Saha Database Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Saha Database' => site_url('site-admin/sahadatabase') , 'Saha Database Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Saha Database';

		$output['director_list'] = $this->sahadatabase_model->get_director();

		// process add data if data post has not empty
		if ( $this->input->post() ) 
		{
			// set value 
			$error = array();
			$data_input = $this->input->post();
			// end set value

			// check and return validate data
			$validate_data = array( 'type' , 'director' , 'title' , 'date' );
			foreach ( $data_input as $key => $value ) 
			{

				$output['show_data'][$key] = $value;

				if ( in_array( $key , $validate_data ) ) 
				{
					if ( empty( $value ) ) 
					{
						$error[] = 'Please enter information '.remove_underscore( ucfirst( $key ) );
					}
				}


			}

			if ( empty( $data_input['select_cover'] ) ) 
			{
				$error[] = 'Please enter information '.remove_underscore( ucfirst( 'select_cover' ) );
			}
			else
			{
				if ( $data_input['select_cover'] == 1 ) 
				{
					if ( empty( $data_input['image_name_cover'] ) ) 
					{
						$error[] = 'Please enter information '.remove_underscore( ucfirst( 'image_name_cover' ) );
					}
				} 
				else 
				{
					if ( empty( $data_input['youtube_id_cover'] ) ) 
					{
						$error[] = 'Please enter information '.remove_underscore( ucfirst( 'youtube_id_cover' ) );
					}
				}
			}			

			$output['error'] = preview_error( $error );
			// end check and return validate data


			if ( empty( $output['error']  ) ) 
			{
				
				$this->sahadatabase_model->add( $this->input->post() );
				$this->session->set_flashdata( 'form_status', preview_success() );
				redirect( 'site-admin/sahadatabase' );
			}

		}// end post

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
	}


	public function sahadatabase_delete( $id = '' )
	{
		$this->sahadatabase_model->delete( $id );
		echo "1";
	}	



	public function sahadatabase_edit( $id = '' )
	{
		if ( empty( $id ) ) 
		{
			redirect( 'site-admin/sahadatabase' );
		}

		$output['this_title_page'] = 'Saha Database Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Saha Database' => site_url('site-admin/sahadatabase') , 'Saha Database Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Saha Database';

		$output['director_list'] = $this->sahadatabase_model->get_director();

		$info = $this->sahadatabase_model->get_data( $id );

		// set data in value
		foreach ( $info['data'] as $key => $value ) 
		{
			$output['show_data'][$key] = $value;
		}

		// set data image cover
		if ( $output['show_data']['select_cover'] == '1' ) 
		{
			$output['show_data']['image_name_cover'] = $output['show_data']['data_cover'];
		}
		else
		{
			$output['show_data']['youtube_id_cover'] = $output['show_data']['data_cover'];
		}

		$output['show_data']['name_image_poster'] = $info['poster'];
		$output['show_data']['name_image_promotion'] = $info['promotion'];
		$output['show_data']['name_image'] = $info['gallery'];
		$output['show_data']['id_youtube'] = $info['youtube'];

		// process add data if data post has not empty
		if ( $this->input->post() ) 
		{
			// set value 
			$error = array();
			$data_input = $this->input->post();
			// end set value

			// check and return validate data
			$validate_data = array( 'type' , 'director' , 'title' , 'date' );
			foreach ( $data_input as $key => $value ) 
			{

				$output['show_data'][$key] = $value;

				if ( in_array( $key , $validate_data ) ) 
				{
					if ( empty( $value ) ) 
					{
						$error[] = 'Please enter information '.remove_underscore( ucfirst( $key ) );
					}
				}


			}

			if ( empty( $data_input['select_cover'] ) ) 
			{
				$error[] = 'Please enter information '.remove_underscore( ucfirst( 'select_cover' ) );
			}
			else
			{
				if ( $data_input['select_cover'] == 1 ) 
				{
					if ( empty( $data_input['image_name_cover'] ) ) 
					{
						$error[] = 'Please enter information '.remove_underscore( ucfirst( 'image_name_cover' ) );
					}
				} 
				else 
				{
					if ( empty( $data_input['youtube_id_cover'] ) ) 
					{
						$error[] = 'Please enter information '.remove_underscore( ucfirst( 'youtube_id_cover' ) );
					}
				}
			}			

			$output['error'] = preview_error( $error );
			// end check and return validate data


			if ( empty( $output['error']  ) ) 
			{
				
				$this->sahadatabase_model->edit( $id , $this->input->post() , $output['show_data']['group_poster_img'] , $output['show_data']['group_promotion_img'] , $output['show_data']['group_gallery'] , $output['show_data']['group_youtube'] );
				$this->session->set_flashdata( 'form_status', preview_success() );
				redirect( 'site-admin/sahadatabase' );
			}

		}// end post





		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

}