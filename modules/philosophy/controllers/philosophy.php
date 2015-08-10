<?php

class philosophy extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model( 'philosophy/philosophy_model' );
		$this->load->model( 'philosophy/fphilosophy_model' );
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
	
	
	function index( ) 
	{


	
		$this->generate_page( 'front/front_view' );
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

		//$output['calendar_list'] = $this->fphilosophy_model->calendar_list( $start , $end );
		
	
		$output['show_data'] = $this->fphilosophy_model->get_data( $id,'array');
		$output['data_list'] = $this->fphilosophy_model->get_list( $this->session->userdata( 'lang' ) , 'front' );

		// foreach ( $output['data_list'] as $key => $value ) {
		// 	$info_data[$value->id] = $value;


		// }
		// $output['data_list'] = $info_data;

		if ( empty( $output['show_data'] ) ) 
		{
			redirect( site_url( 'philosophy' ) );
		}

		// --------------
		$this_lang = $this->session->userdata( 'lang' );
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;
		$data_tag = $this->seotag_model->this_tag( 'philosophy' , 'philosophy_'.$id , $this_lang );
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


		$output['gallery_list'] = $this->fphilosophy_model->get_gallery( $id,'array');
		$output['page_name'] = 'philosophy';
		$this->generate_page( 'front/front_detail_view', $output );

	} // END FUNCTION detail_new



}
