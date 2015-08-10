<?php

class seotag extends MY_Controller {

	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('seotag/fseotag_model');

	}
	
	
	function index() 
	{
	
		// SET VALUE
		$output = '';

		$output['content'] = $this->fseotag_model->cll_content();

		$output['page_name'] = 'seotag';

		$this->generate_page( 'front/seotag_view', $output );

	}// index
	

}
