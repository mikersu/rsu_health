<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */
 
class search extends MY_Controller {
	
	
	function __construct() {
		parent::__construct();
		
		// load model
		$this->load->model( array( 'posts_model' ) );
		
		// load helper
		$this->load->helper( array( 'date', 'language' ) );
		
		// load language
		$this->lang->load( 'post' );
		$this->lang->load( 'search' );
	}// __construct
	
	
	function index() {
		$q = trim( $this->input->get( 'q' ) );
		$output['q'] = htmlspecialchars( $q, ENT_QUOTES, config_item( 'charset' ) );
		
		if ( mb_strlen( $q ) > 1 ) {
			// search and list post
			$output['list_item'] = $this->posts_model->list_item( 'front' );
			if ( is_array( $output['list_item'] ) ) {
				$output['pagination'] = $this->pagination->create_links();
			}
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( $this->lang->line( 'search_search' ) );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'front/templates/search/search_view', $output );
	}// index
	
	
}

// EOF