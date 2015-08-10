<?php

class home extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model( 'home/home_model' );
		$this->load->model( 'home/fhome_model' );
		if ( ! $this->session->userdata( 'lang' ) ) 
		{
			$this->session->set_userdata( 'lang', $this->lang_model->get_lang_default() );
		}
	}
	
	
	function index( $page = 1 ) 
	{

		$this->generate_page( 'front/front_view' );
	}// index
}
