<?php

class type_setting extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('type_setting/type_setting_model');
		$this->load->model('type_setting/ftype_setting_model');
	}
	
	
	function index() 
	{
		// SET VALUE
		$output = '';


		$this->generate_page( 'front/front_type_setting_view', $output );
	}// index
	

}
