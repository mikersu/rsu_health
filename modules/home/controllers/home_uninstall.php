<?php
/**
*
* Block comment
*
**/

class home_uninstall extends admin_controller {
	
	
	public $module_system_name = 'home';

	
	function __construct() {
		parent::__construct();
	}
	
	
	function index() {
		// uninstall module
		if ( $this->db->table_exists( 'home_slider_config' ) ) {
			$sql = 'DROP TABLE `'.$this->db->dbprefix('home_slider_config').'`;';
			$this->db->query( $sql );
		}

		if ( $this->db->table_exists( 'home_slider_detail' ) ) {
			$sql = 'DROP TABLE `'.$this->db->dbprefix('home_slider_detail').'`;';
			$this->db->query( $sql );
		}

		
		// uninstall
		$this->db->set( 'module_install', '0' );
		$this->db->where( 'module_system_name', $this->module_system_name );
		$this->db->update( 'modules' );
		// disable too
		$this->load->model( 'modules_model' );
		$this->modules_model->do_deactivate( $this->module_system_name );
		echo 'Uninstall completed. <a href="'.site_url( 'site-admin/module' ).'" >Go back</a>';
	}
	

}

