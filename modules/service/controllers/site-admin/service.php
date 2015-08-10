<?php

class service extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('service/service_model');
	}
	 
	
	function index() 
	{

		if ( $this->account_model->check_admin_permission( 'Engineering Service', 'Access Engineering Service List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Engineering Service';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Engineering Service' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Engineering Service List';

		$output['data_list'] = $this->service_model->list_category();

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_index_view' , $output );

	}// index
	

	public function mark_sort_service( $id = '' ) {
	
		if ( $this->account_model->check_admin_permission( 'Engineering Service', 'Sort Engineering Service List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		if ( $this->input->post('id') ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'service_category' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/service' );	
		
	}// END mark_sort_service 

	public function mark_sort_list_item( $category = '' ) {
	
		if ( $this->input->post('id') ) 
		{
			$array_id = $this->input->post('id');
			foreach ( $array_id as $key => $value ) 
			{
				$this->db->where( 'ref_category_id', $category );
				$this->db->where( 'id', $value );
				$this->db->set( 'order_sort', $key );
				$this->db->update( 'service_category_gallery_config' );
			}

			$this->session->set_flashdata( 'form_status', preview_success() );
		}
		redirect( 'site-admin/service/list_item/'.$category );

		
	}// END mark_sort_list_item 



	public function category_edit( $id = '') {
	
		if ( $this->account_model->check_admin_permission( 'Engineering Service', 'Edit Engineering Service List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output = '';

		if ( empty( $id ) ) {
			redirect( site_url( 'site-admin/service' ) );
		}

		if ( $this->input->post() ) {
			
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'image_logo' => 'Image' );

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
		 			unset($data_post['set']);

		 			$this->service_model->edit_category( $data_post, $id );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/service' );
		 		}


		}
		else
		{
			$show_data = $this->service_model->get_category( $id );
			$output['show_data'] = $show_data;
		}


		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Edit Category';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Engineering Service' => site_url( 'site-admin/service' ) , 'Edit Category' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Engineering Service List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_form_category_view' , $output );		
		
	}// END category_edit 


	public function category_add() {
	
		if ( $this->account_model->check_admin_permission( 'Engineering Service', 'Add Engineering Service List' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

		$output = '';

		if ( $this->input->post() ) {
			
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'image_logo' => 'Image' );

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
		 			unset($data_post['set']);

		 			$this->service_model->add_category( $data_post );

					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/service' );
		 		}


		}


		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Add Category';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Service' => site_url( 'site-admin/service' ) , 'Add Category' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Engineering Service List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/admin_form_category_view' , $output );

	}// END category_add 

	public function category_delete( $id = '') {
	
		if ( $this->account_model->check_admin_permission( 'Engineering Service', 'Delete Engineering Service List' ) != true ) { die(); }

		$this->db->where( 'id', $id );
		$this->db->delete( 'service_category' );
		echo "1";
		
	}// END category_delete 


	public function list_item( $id = '') {
	
		if ( empty( $id ) ) {
			redirect( 'site-admin/service' );
		}

		$output['category_id'] = $id;
		$output['language'] = $this->lang_model->get_list( '' , 'admin' );
		$data = $this->service_model->get_category( $id );

		// SET HTML IMAGE
		$html = '';
		foreach ( $data['image_logo'] as $key => $value ) {
			$html .= '<img class="set-over-image" src="'.base_url( $value ).'" alt=""> &nbsp;&nbsp;&nbsp;';
		}



		$output['data_list'] = $this->service_model->get_list_item( $id );

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Management Data';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Service' => site_url( 'site-admin/service' ) , 'Management Data '.$html => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Engineering Service List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/management_data_view' , $output );

	}// END list_item 


	public function add_list_item( $category = '' ) {
	
		// CHECK CATEGORY IS NOT EMPTY
		if ( empty( $category ) ) {
			redirect( site_url('site-admin/service') );
		}

		$output = '';
		$output['category_id'] = $category;
		$data = $this->service_model->get_category( $category );

		// SET HTML IMAGE
		$html = '';
		foreach ( $data['image_logo'] as $key => $value ) {
			$html .= '<img class="set-over-image" src="'.base_url( $value ).'" alt=""> &nbsp;&nbsp;&nbsp;';
		}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );

		if ( $this->input->post() ) {
			
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'title' => 'Title', 'detail' => 'Detail', 'image' => 'Cover Image' );

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
		 			$this->service_model->add_management_data( $data_post );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/service/list_item/'.$category );
		 		}

		}

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Management Data Add';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Service' => site_url( 'site-admin/service' ) , 'Management Data '.$html => site_url( 'site-admin/service/list_item/'.$category ) , 'Management Data Add' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Engineering Service List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_management_data_view' , $output );	

	}// END add_list_item 



	public function edit_list_item( $category = '' , $id = '' ) {
	
		// CHECK CATEGORY IS NOT EMPTY
		if ( empty( $category ) ) {
			redirect( site_url('site-admin/service') );
		}

		$output = '';
		$output['category_id'] = $category;
		$data = $this->service_model->get_category( $category );

		// SET HTML IMAGE
		$html = '';
		foreach ( $data['image_logo'] as $key => $value ) {
			$html .= '<img class="set-over-image" src="'.base_url( $value ).'" alt=""> &nbsp;&nbsp;&nbsp;';
		}

		$output['language'] = $this->lang_model->get_list( '' , 'admin' );

		if ( $this->input->post() ) {
			
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'title' => 'Title', 'detail' => 'Detail', 'image' => 'Cover Image' );

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
		 			$this->service_model->edit_management_data( $data_post , $id  );
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/service/list_item/'.$category );
		 		}

		}
		else
		{

			$output['show_data'] = $this->service_model->detail_list_item( $id );

		}

		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Management Data Edit';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Service' => site_url( 'site-admin/service' ) , 'Management Data '.$html => site_url( 'site-admin/service/list_item/'.$category ) , 'Management Data Edit' => '#' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Engineering Service List';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_management_data_view' , $output );	
		
	}// END edit_list_item 


    public function list_item_delete( $id = '' ) {
    
        $this->db->where( 'id', $id );
        $this->db->delete( 'service_category_gallery_config' );

        $this->db->where( 'ref_id_gallery', $id );
        $this->db->delete( 'service_category_gallery_detail' );

        echo "1";
        
    }// END list_item_delete 


    public function service_delete( $id = '' ) {
    
    	$this->db->where( 'id', $id );
    	$this->db->delete( 'service_category' );

    	$this->db->where( 'ref_category_id', $id );
    	$query = $this->db->get( 'service_category_gallery_config' );
    	$data = $query->result();

    	$over_id = array();
    	foreach ( $data as $key => $value ) {
    		$over_id[] = $value->id;
    	}

    	$this->db->where( 'ref_category_id', $id );
    	$this->db->delete( 'service_category_gallery_config' );

    	$this->db->where_in( 'ref_id_gallery', $over_id );
    	$this->db->delete( 'service_category_gallery_detail' );

    	unset( $over_id );

    	echo "1";
    	
    }// END service_delete 


    public function content() {
    

    	if ( $this->account_model->check_admin_permission( 'Engineering Service', 'Access Content Service' ) != true ) { echo '<script>alert( "Account cannot access !! " ); history.go(-1);</script>';die();}

    	$output['language'] = $this->lang_model->get_list( '' , 'admin' );


		if ( $this->input->post() ) {
			
				$data_post = $this->input->post();
			
		 		$array_validation = array( 'detail_left' => 'Detail Left', 'detail_right' => 'Detail Right' );

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
		 			foreach ( $data_post as $key => $value ) {
		 				foreach ( $value as $key_data => $value_data ) {
		 					$this->content_config_model->add( 'service_'.$key , $value_data , $key_data );
		 				}
		 			}
		 			
					$this->session->set_flashdata( 'form_status', preview_success() );
					redirect( 'site-admin/service/content' );
		 		}

		}
		else
		{

			$detail_left = $this->content_config_model->set_get_all( 'service_detail_left' );
			$detail_right = $this->content_config_model->set_get_all( 'service_detail_right' );

			$output['show_data']['detail_left'] = $detail_left;
			$output['show_data']['detail_right'] = $detail_right;



		}



		$output['form_status'] = $this->session->flashdata( 'form_status' );
		$output['this_title_page'] = '<i class="icon-cogs"></i> Management Content';
		$breadcrumb = array( 'Home' => site_url('site-admin') , 'Service' => '#' , 'Management Content' => '' );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Engineering Service';
		$output['hover_sub_menu'] = 'Content Service';

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );		
		$this->generate_page( 'site-admin/form_content_view' , $output );	

    	
    }// END content 


}