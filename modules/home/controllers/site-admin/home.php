<?php

class home extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('home/home_model');
		$this->load->model('home/fhome_model');
	}
	 

	public function mark_sort_home()
	{
		if ( $this->input->post('id') ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->update( 'home' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/home' );
	}

	public function mark_sort_slider() {
	
		if ( $this->account_model->check_admin_permission( 'Home', 'Sort Slider List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		if ( $this->input->post('id') ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'home_slider_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/home/slider_list' );
		
	}// END mark_sort_slider 


	
	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'Home', 'Access Home Setting' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );
		$default_lang = $this->lang_model->get_lang_default();
		$output['list_news'] = $this->fhome_model->list_news( 1 , $default_lang );
		$output['list_event'] = $this->fhome_model->list_news( 2 , $default_lang );

		if ( $this->input->post()) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();

		 		$array_validation = array( 'title' => 'About Title' ,'detail' => 'About Detail' , 'image' => 'About Cover Image' , 'id_news_hover' => 'News active in home page'  );

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

		 		if ( !$this->input->post('image_title_gallery') ) {
		 			$error_validation[] = 'Please enter information Title image logo';
		 		}
		 		else
		 		{
		 			$title_iamge = $this->input->post('image_title_gallery');

		 			foreach ( $title_iamge as $key => $value ) {
		 				if ( empty( $value ) ) {
		 					$error_validation[] = 'Please enter information Title image logo at image '.($key+1);
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


		 			foreach ( $data_post['title'] as $key => $value ) {
		 				$this->content_config_model->add( 'home_about_title' , $value , $key );
		 				$this->content_config_model->add( 'home_about_detail' , $data_post['detail'][$key] , $key );
		 			}

		 			$this->content_config_model->add( 'home_about_image' , $data_post['image'] );
		 			$this->content_config_model->add( 'id_news_hover' , $data_post['id_news_hover'] );
		 			$this->content_config_model->add( 'home_about_link' , $data_post['link'] );
		 			
		 			$this->fhome_model->add_banner_list( $data_post );


					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/home' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST
		else
		{

			$list_gallery = $this->fhome_model->list_banner();

			foreach ( $list_gallery as $key => $value ) {
				$output['show_data']['image_name_gallery'][$key] = $value->image;
				$output['show_data']['image_title_gallery'][$key] = $value->link; 
			}

			$data_title = $this->content_config_model->get_all( 'home_about_title' );
			$data_detail = $this->content_config_model->get_all( 'home_about_detail' );
			$data_image = $this->content_config_model->get( 'home_about_image' );
			$data_id_new = $this->content_config_model->get( 'id_news_hover' );
			$data_link = $this->content_config_model->get( 'home_about_link' );

			foreach ( $data_title as $key => $value ) {
				$output['show_data']['title'][$value->language_id] = $value->content;
			}
			foreach ( $data_detail as $key => $value ) {
				$output['show_data']['detail'][$value->language_id] = $value->content;
			}			

			$output['show_data']['image'] = $data_image;
			$output['show_data']['id_news_hover'] = $data_id_new;
			$output['show_data']['link'] = $data_link;

		}



		// $link = array(
		// 	'<link rel="stylesheet" href="'.base_url().'public/js/jquery-ui/css/smoothness/jquery-ui.css" />'
		// 	);
		// $output['page_link'] = $this->html_model->gen_tags( $link );

		// $script = array(
		// 			'<script src="'.base_url().'public/js/jquery-ui/jquery-ui.min.js"></script>',
		// 			);
		// $output['page_script'] = $this->html_model->gen_tags( $script );





		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-home"></i> Home';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home Setting' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Home Setting';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index_view' , $output );

	}// index
	

	public function home_add( $language_id = '' )
	{
		
		$output['language'] = $this->lang_model->get_list( $language_id , 'front' );

		if ( empty( $language_id ) ) 
		{
			redirect( site_url( 'site-admin/home' ) );
		}
		else
		{
			$output['language_id'] = $language_id;
		}

		if ( $this->input->post()) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'title' => 'Title' ,'image_home' => 'Image Cover' , 'image_recommended' => 'Recommended upload' );

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

		 			$last_id = $this->home_model->add( $data_post );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/home' );
		 		}

			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}// END POST

		$output['this_title_page'] = '<i class="icon-home"></i> Home Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home' => site_url('site-admin/home') , 'Home Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Home Setting';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );

	}
	

	public function home_edit( $language_id = '' , $id = '' )
	{

		$output['language'] = $this->lang_model->get_list( $language_id , 'front' );

		if ( empty( $language_id ) ) 
		{
			redirect( site_url( 'site-admin/home' ) );
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
			
		 		$array_validation = array( 'title' => 'Title' ,'image_home' => 'Image Cover' , 'image_recommended' => 'Recommended upload' );

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
		 			$output[ 'show_data' ] = $this->input->post();	
		 			$output[ 'error' ] = preview_error( $error_validation );
		 		}
		 		else
		 		{

	
		 			$this->home_model->edit( $id , $data_post );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/home' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------


		}else{
			$output['show_data'] = $this->home_model->get_data( $id , 'array' );
		}


		$output['this_title_page'] = '<i class="icon-home"></i> Home Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home' => site_url('site-admin/home') , 'Home Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Home Setting';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_view' , $output );
		
	}	


	public function slider_delete( $id = '' )
	{

		if ( $this->account_model->check_admin_permission( 'Home', 'Delete Content Service' ) != true ) { die(); }

		$this->db->where( 'id', $id );
		$this->db->delete( 'home_slider_config' );

		$this->db->where( 'ref_id', $id );
		$this->db->delete( 'home_slider_detail' );

		echo "1";
	}	

	public function banner_list() {
	
		$output['this_title_page'] = '<i class="icon-home"></i> Banner List';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home' => site_url('site-admin/home') , 'Banner List' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Banner List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_banner_logo_view' , $output );
		
	}// END banner_list 


	public function slider_list() {
	

		if ( $this->account_model->check_admin_permission( 'Home', 'Access Slider List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$default_lang = $this->lang_model->get_lang_default();
		$output['data_list'] = $this->home_model->list_slider( $default_lang );
		$output['this_title_page'] = '<i class="icon-home"></i> Slider List';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home' => site_url('site-admin/home') , 'Slider List' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Slider List';
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/index_slider_view' , $output );
		
	}// END slider_list 


	public function slider_edit( $id = '' ) {
	
		if ( $this->account_model->check_admin_permission( 'Home', 'Edit Slider List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}


		if ( empty( $id ) ) {
			redirect( site_url('site-admin/home/slider_list') );
		}

		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();

		 		$array_validation = array( 'title' => 'Title' ,'detail' => 'Detail' , 'image' => 'Image Slider' );

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
		 			$this->home_model->edit_slider( $id , $data_post );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/home/slider_list' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------

		}
		else
		{

			$data = $this->home_model->get_slider( $id );

			foreach ( $data as $key => $value ) {
				$output['show_data']['title'][$value->language_id] = $value->title;
				$output['show_data']['detail'][$value->language_id] = $value->detail;
				$output['show_data']['image'] = $value->image;
				$output['show_data']['status'] = $value->status;
				$output['show_data']['link'] = $value->link;
			}

		}


		$output['this_title_page'] = '<i class="icon-home"></i> Slider List';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home' => site_url('site-admin/home') , 'Slider List' => site_url('site-admin/home/slider_list') , 'Slider Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Slider List';
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_slider_view' , $output );	



		
	}// END slider_edit 



	public function slider_add() {
	

		if ( $this->account_model->check_admin_permission( 'Home', 'Add Slider List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}
		

		$output['language'] = $this->lang_model->get_list( '' , 'front' );

		if ( $this->input->post() ) 
		{

			/**
			*
			*** START ADD CONTENT
			*
			**/
				$data_post = $this->input->post();

		 		$array_validation = array( 'title' => 'Title' ,'detail' => 'Detail' , 'image' => 'Image Slider' );

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
		 			$this->home_model->add_slider( $data_post );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/home/slider_list' );
		 		}
			
			/** END ADD CONTENT **/
			
			// -------------------------------------


		}


		$output['this_title_page'] = '<i class="icon-home"></i> Slider List';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Home' => site_url('site-admin/home') , 'Slider List' => site_url('site-admin/home/slider_list') , 'Slider Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Home';
		$output['hover_sub_menu'] = 'Slider List';
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_slider_view' , $output );		

		
	}// END add_slider 





	/** END NEW SUBSCRIBE **/

	// -------------------------------------
}