<?php

class intro_page extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('content_config_model');
		$this->load->model('intro_page/intro_page_model');
	}
	 
	
	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'Intor Page', 'Access Intro Page' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}
		
		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-bookmark-empty"></i> Intro Page';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Intro Page' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Intro Page';

		$output['show_data']['title_detail'] = $this->content_config_model->get( 'intro_page_title' );

		$output['show_data']['slug'] = $this->content_config_model->get( 'intro_page_slug' );
		$output['show_data']['tag_keywords'] = $this->content_config_model->get( 'intro_page_tag_keywords' );
		$output['show_data']['tag_description'] = $this->content_config_model->get( 'intro_page_tag_description' );

		$output['data_list'] = $this->intro_page_model->get_list();


		if ( $this->input->post() ) 
		{

			$title_content = $this->input->post( 'title_detail' );
			$this->content_config_model->add( 'intro_page_title' , $title_content );

			$slug = $this->input->post( 'slug' );
			$this->content_config_model->add( 'intro_page_slug' , $slug );

			$tag_keywords = $this->input->post( 'tag_keywords' );
			$this->content_config_model->add( 'intro_page_tag_keywords' , $tag_keywords );

			$tag_description = $this->input->post( 'tag_description' );
			$this->content_config_model->add( 'intro_page_tag_description' , $tag_description );

			$this->session->set_flashdata( 'form_status', preview_success() );
			redirect( 'site-admin/intro_page' );
		}


		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index' , $output );
	}// index
	

	public function intro_page_add()
	{

		$output['this_title_page'] = '<i class="icon-bookmark-empty"></i> Intro Page Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Intro Page' => site_url('site-admin/intro_page') , 'Intro Page Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Intro Page';

		$error = array();


		if ( $this->input->post() ) 
		{
			
			$data_input = $this->input->post();

			// check and return validate data

			switch ( $data_input['select_cover'] ) 
			{
				case '1':
					$v = 'image_name_cover';
					break;
				case '2':
					$v = 'youtube_id_cover';
					break;
				case '3':
					$v = 'file_video_cover';
					break;	
				case '4':
					$v = 'intro_text';
					break;	
				
				default:
					# code...
					break;
			}

			$validate_data = array( 'title' );
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

			if ( empty( $data_input[$v] ) ) 
			{
				$error[] = 'Please enter information '.remove_underscore( ucfirst( $v ) );
			}



			$output['error'] = preview_error( $error );
			// end check and return validate data



			if ( empty( $output['error']  ) ) 
			{
		
				$data_input['start_date'] = strtotime( $data_input['start_date'] );
				$data_input['end_date'] = strtotime( $data_input['end_date'] );

				$this->intro_page_model->add( $data_input );
				$this->session->set_flashdata( 'form_status', preview_success() );
				redirect( 'site-admin/intro_page' );

			}


			
			$output['show_data']['start_date'] = strtotime( $data_input['start_date'] );
			$output['show_data']['end_date'] = strtotime( $data_input['end_date'] );
			
		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

	public function intro_page_edit( $id = '' )
	{

		$output['this_title_page'] = '<i class="icon-bookmark-empty"></i> Intro Page Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Intro Page' => site_url('site-admin/intro_page') , 'Intro Page Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Intro Page';

		$output['show_data'] = $this->intro_page_model->get_data( $id );

		$error = array();

		if ( $this->input->post() ) 
		{
			$data_input = $this->input->post();

			// check and return validate data

			switch ( $data_input['select_cover'] ) 
			{
				case '1':
					$v = 'image_name_cover';
					break;
				case '2':
					$v = 'youtube_id_cover';
					break;
				case '3':
					$v = 'file_video_cover';
					break;	
				case '4':
					$v = 'intro_text';
					break;		
				default:
					# code...
					break;
			}

			$validate_data = array( 'title' );
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

			if ( empty( $data_input[$v] ) ) 
			{
				$error[] = 'Please enter information '.remove_underscore( ucfirst( $v ) );
			}

			$output['error'] = preview_error( $error );
			// end check and return validate data

			if ( empty( $output['error']  ) ) 
			{
			
				$data_input['start_date'] = ( ! empty( $data_input['start_date'] ) ) ? strtotime(reset_format_date( $data_input['start_date'] )) : 0 ;
				$data_input['end_date'] = ( ! empty( $data_input['end_date'] ) ) ? strtotime(reset_format_date( $data_input['end_date'] )) : 0 ;

				$this->intro_page_model->edit( $id , $data_input );
				$this->session->set_flashdata( 'form_status', preview_success() );
				redirect( 'site-admin/intro_page' );

			}
		}


		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
		
	}	


	public function intro_page_delete( $id = '' )
	{
		$this->intro_page_model->delete( $id );
		echo "1";
	}	


	public function mark_sort()
	{
		if ( $this->input->post('id') ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'intro_page' );

			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/intro_page' );
	}

}