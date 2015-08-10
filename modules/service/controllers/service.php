<?php

class service extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('service/service_model');
		$this->load->model('service/fservice_model');
	}
	
	
	function index() 
	{

		// SET VALUE
		$output = '';

		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default();
		$output['this_lang'] = $this_lang;
		/** END LANG **/

		$category_list = $this->fservice_model->list_category();

		foreach ( $category_list as $key => $value ) {
			
			$this->db->from( 'service_category_gallery_config AS scgc' );
			$this->db->join( 'service_category_gallery_detail AS scgd', 'scgc.id = scgd.ref_id_gallery', 'left' );
			$this->db->where( 'scgc.ref_category_id', $value->id );
			$this->db->where( 'scgc.status', 1 );
			$this->db->where( 'language_id', $this_lang );
			$query = $this->db->get();
			$data = $query->result();

			$category_list[$key]->list_item = $data;

		}

		$output['category_list'] = $category_list;


		$link = array(
			'<link rel="stylesheet" href="'.$this->theme_path.'/components/sliderkit/css/sliderkit-core-product-detail.css" />'
			);
		$output['page_link'] = $this->html_model->gen_tags( $link );

		$output['page_name'] = 'service';
		$this->generate_page( 'front/front_service_view', $output );
	}// index
	


	public function category( $id = '' , $page = 1 )
	{
		// SET VALUE
		$output = '';
	
		if ( $id == 'rent_house' ) 
		{
			$this->rent_house( $page );
			return false;
		}


		if ( $id == 'water_park' ) 
		{
			$this->service_garden( $page );
			return false;
		}

		$output['data_show'] = $this->service_model->get_category_by_language( $id , 'front' , 'object' , $this->session->userdata( 'lang' ) );

		if ( ! empty( $output['data_show'] ) ) 
		{
			$output['gallery_list'] = $this->service_model->get_category_image_gallery( $output['data_show']->id );	
		}
		else
		{
			$output['gallery_list'] = '';
		}

		// --------------
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;
		$data_tag = $this->seotag_model->this_tag( 'page_service' , 'page_service_other_'.$id , $this_lang );
		foreach ( $data_tag as $key => $value ) 
		{
			if ( $value->tag_name == 'title' ) 
			{
				$output['page_title'] = $value->value;
			}
			else
			{
				$meta[] = '<meta name="'.$value->tag_name.'" content="'.$value->value.'" />';
			}
		}	
		$meta = ( ! empty( $meta ) ) ? $meta : '' ;
		$output['meta_tag'] = $this->html_model->gen_tags( $meta );
		// --------------



		$output['page_name'] = 'service';
		$this->generate_page( 'front/front_service_other_view', $output );	
	
	} // END FUNCTION category



	public function rent_house( $page )
	{
		// SET VALUE
		$output = '';

		$data_count = $this->fservice_model->get_total_service_home();

		$data_limit = '3';

		$output['page'] = $page;

		$output['all_page'] = ceil($data_count/$data_limit);

		$data_list = $this->service_model->get_category_service_home( $this->session->userdata( 'lang' ) , '' , 'front' , 'object' , $data_limit , $page );

		// echo $this->db->last_query();

		foreach ( $data_list as $key => $value ) 
		{
			
			$gallery = $this->service_model->get_category_service_home_gallery( $value->id );
			$data_list[$key]->gallery = $gallery;

		}


		// --------------
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;
		$data_tag = $this->seotag_model->this_tag( 'page_services' , 'home_page_services' , $this_lang );
		$meta = array();
		foreach ( $data_tag as $key => $value ) 
		{
			if ( $value->tag_name == 'title' ) 
			{
				$output['page_title'] = $value->value;
			}
			else
			{
				$meta[] = '<meta name="'.$value->tag_name.'" content="'.$value->value.'" />';
			}
		}	
		$meta = ( ! empty( $meta ) ) ? $meta : '' ;
		$output['meta_tag'] = $this->html_model->gen_tags( $meta );
		// --------------



		$output['data_list'] = $data_list;

		$output['page_name'] = 'service';
		$this->generate_page( 'front/front_service_home_view', $output );	
		
	
	} // END FUNCTION rent_house


	public function service_garden( $page )
	{
		// SET VALUE
		$output = '';

		// --------------
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;
		$data_tag = $this->seotag_model->this_tag( 'page_service' , 'category_service_water_park' , $this_lang );
		$meta = array();

		foreach ( $data_tag as $key => $value ) 
		{
			if ( $value->tag_name == 'title' ) 
			{
				$output['page_title'] = $value->value;
			}
			else
			{
				$meta[] = '<meta name="'.$value->tag_name.'" content="'.$value->value.'" />';
			}
		}	
		$meta = ( ! empty( $meta ) ) ? $meta : '' ;
		$output['meta_tag'] = $this->html_model->gen_tags( $meta );
		// --------------


		$output['data_show'] = $this->fservice_model->get_water_park();
		$output['page_name'] = 'service';
		$this->generate_page( 'front/front_service_water_park_view', $output );	
	
	} // END FUNCTION service_garden

}
