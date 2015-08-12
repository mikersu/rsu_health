<?php

class qa_evaluation extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model( 'qa_evaluation/qa_evaluation_model' );
		$this->load->model( 'qa_evaluation/fqa_evaluation_model' );
		if ( ! $this->session->userdata( 'lang' ) ) 
		{
			$this->session->set_userdata( 'lang', $this->lang_model->get_lang_default() );
		}
	}


	public function _remap($method, $params = array())
	{
	    if ( ! method_exists($this, $method))
	    {
	        $this->index( $method );
	    }
	    else
	    {
	    	return call_user_func_array(array($this, $method), $params);
	    }   
	}	
	
	
	function index( $string_slug = '' ) 
	{


		$string_slug = rawurldecode( $string_slug );

		/** GET LANG **/
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;				
		/** END LANG **/
		
		$data_list = $this->fqa_evaluation_model->get_list( $this_lang , 'front' );




		foreach ( $data_list as $key => $value ) {
	
			if ( $value->hash == md5($string_slug) ) {
				$show_data = $value;
				$show_data->hover = 'class="active"';
			}

			if ( $key == count( $data_list )-1 AND empty( $show_data )  ) {
				$show_data = $data_list['0'];
				$show_data->hover = 'class="active"';
			}

		}

		$output['data_list'] = ( ! empty( $data_list ) ) ? $data_list : array() ;
		$output['show_data'] = ( ! empty( $show_data ) ) ? $show_data : array() ;

		$output['gallery_list'] = ( ! empty( $show_data ) ) ? $this->fqa_evaluation_model->get_gallery( $show_data->id ) : array() ;

		// --------------
		$data_tag = $this->seotag_model->this_tag( 'page_qa_evaluation_us' , 'home_page_qa_evaluation_us' , $this_lang );


		foreach ( $data_tag as $key => $value ) 
		{
			if ( $value->tag_name == 'title' ) 
			{
				$title = ( ! empty( $value->value ) ) ? $value->value : $show_data->title ;

				$output['page_title'] = 'QA_Evaluation us &rsaquo; '.$title;
			}
			else
			{
				$meta[] = '<meta name="'.$value->tag_name.'" content="'.$value->value.'" />';
			}
		}

		$meta = ( ! empty( $meta ) ) ? $meta : '' ;
		$output['meta_tag'] = $this->html_model->gen_tags( $meta );
		// --------------

		$output['page_name'] = 'qa_evaluation';
		$this->generate_page( 'front/front_view', $output );
	}// index
	
	public function detail( $id = '' )
	{

		// SET VALUE
		$output = '';

		$year = $this->input->get( 'year' );
		$year = ( ! empty( $year ) ) ? $year : date( 'Y' ) ;
		$month = $this->input->get( 'month' );
		$month = ( ! empty( $month ) ) ? $month : date( 'm' ) ;

		$start = $year.'-'.$month.'-1';

		$end = strtotime( date ( 'y-m-t' , strtotime( $start ) ) );
		$start = strtotime($year.'-'.$month.'-1');

		//$output['calendar_list'] = $this->fqa_evaluation_model->calendar_list( $start , $end );
		
	
		$output['show_data'] = $this->fqa_evaluation_model->get_data( $id,'array');
		$output['data_list'] = $this->fqa_evaluation_model->get_list( $this->session->userdata( 'lang' ) , 'front' );

		// foreach ( $output['data_list'] as $key => $value ) {
		// 	$info_data[$value->id] = $value;


		// }
		// $output['data_list'] = $info_data;

		if ( empty( $output['show_data'] ) ) 
		{
			redirect( site_url( 'qa_evaluation' ) );
		}

		// --------------
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;
		$data_tag = $this->seotag_model->this_tag( 'qa_evaluation' , 'qa_evaluation_'.$id , $this_lang );
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


		$output['gallery_list'] = $this->fqa_evaluation_model->get_gallery( $id,'array');
		$output['page_name'] = 'qa_evaluation';
		$this->generate_page( 'front/front_detail_view', $output );

	} // END FUNCTION detail_new



}
