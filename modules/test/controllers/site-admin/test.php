<?php

class test extends admin_controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('test/test_model');
	}
	 

	
	public function index()
	{
		
		$this->generate_page('site-admin/test');
	}
	/** END NEW SUBSCRIBE **/

	// -------------------------------------





}