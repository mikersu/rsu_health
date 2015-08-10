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

class index extends admin_controller {

	
	function __construct() {
		parent::__construct();
		$this->load->model('content_config_model');
	}// __construct
	
	
	function index() {

		// load session for flashdata
		$this->load->library( 'session' );
		$form_status = $this->session->flashdata( 'form_status' );
		if ( $form_status != null ) {
			$output['form_status'] = $form_status;
		}
		unset( $form_status );
		
		$output['this_title_page'] = '<i class="icon-signal"></i> Dashboard';
		$breadcrumb = array( 'Home' => site_url('site-admin') );
		$output['this_breadcrumb_page'] = $breadcrumb;
		$output['hover_menu'] = 'Dashboard';

		$output['user_analytics'] = $this->content_config_model->get( 'setting_user_analytics' );
		$output['password_analytics'] = $this->content_config_model->get( 'setting_password_analytics' );
		$output['id_code_analytics'] = $this->content_config_model->get( 'setting_id_code_analytics' );

		$output['google_analytice'] = true;
		if ( empty( $output['user_analytics'] ) OR empty( $output['password_analytics'] ) OR empty( $output['id_code_analytics'] ) ) 
		{
			$output['google_analytice'] = false;
		}

		// head tags output ##############################
		$output['page_title'] = $this->html_model->gen_title( 'Backoffice' );
		// meta tags
		// link tags
		// script tags
		// end head tags output ##############################
	

		/**
		*
		* get name theme default
		*
		**/	
		$this->db->where( 'theme_default_admin', 1 );
		$query = $this->db->get( 'themes' );
		$data = $query->row();

		if ( empty( $data ) ) 
		{
			$this->generate_page( 'site-admin/templates/index/index_view', $output );
		}
		// end get name theme default

		/**
		*
		* check theme default and generate page for that theme
		*
		**/
		switch ( $data->theme_name ) 
		{
			case 'saha':
				$this->generate_page( 'site-admin/templates/index/main_index_view', $output );
				break;
			
			default:
				$this->generate_page( 'site-admin/templates/index/index_view', $output );
				break;
		}
		// end check theme default and generate page for that theme

	}// index
	

}

