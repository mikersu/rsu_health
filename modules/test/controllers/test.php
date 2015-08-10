<?php

class test extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model( 'test/test_model' );
		$this->load->model( 'test/ftest_model' );
	}


	public function index( )
	{
		
		$this->generate_page('front/test');
	}
	/** END NEW SUBSCRIBE **/

	// -------------------------------------





}