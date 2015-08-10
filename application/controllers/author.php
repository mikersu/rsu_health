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
 
class author extends MY_Controller {
	
	
	function __construct() {
		parent::__construct();
		// load model
		$this->load->model( array( 'posts_model' ) );
		
		// set posts_model post_type
		$this->posts_model->post_type = 'article';
		
		// load helper
		$this->load->helper( array( 'date', 'language' ) );
		
		// load language
		$this->lang->load( 'post' );
	}// __construct
	
	
	function _remap( $att1 = '', $att2 = '' ) {
		$this->index( $att1, $att2 );
	}// _remap
	
	
	function index( $username = '', $att2 = '' ) {
		if ( !empty( $att2 ) ) {show_404(); exit;}// prevent duplicate content (localhost/author/authorname and localhost/author/authorname/aaa can be same result, just 404 it). good for seo.
		
		// get account cookie
		$cm_account = $this->account_model->get_account_cookie( 'member' );
		if ( isset( $cm_account['id'] ) && isset( $cm_account['username'] ) ) {
			$my_account_id = $cm_account['id'];
			$my_username = $cm_account['username'];
		} else {
			$my_account_id = '0';
		}
		unset( $cm_account );
		
		// send username to views
		$output['username'] = $username;
		
		// list posts
		$data['account_username'] = $username;
		$output['list_item'] = $this->posts_model->list_item( 'front', $data );
		unset( $data );
		
		if ( is_array( $output['list_item'] ) ) {
			$output['pagination'] = $this->pagination->create_links();
		}
		
		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( sprintf( lang( 'post_article_by_' ), $username ) );
		// meta tags
		$meta[] = '<meta name="robots" content="noindex, nofollow" />';
		$output['page_meta'] = $this->html_model->gen_tags( $meta );
		unset( $meta );
		// link tags
		// script tags
		// end head tags output ##############################
		
		// output
		$this->generate_page( 'front/templates/author/author_view', $output );
	}// index
	
	
}

// EOF