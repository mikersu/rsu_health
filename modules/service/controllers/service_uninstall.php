<?php
/**
*
* Block comment
*
**/

class service_uninstall extends admin_controller {
	
	
	public $module_system_name = 'service';

	
	function __construct() {
		parent::__construct();
	}
	
	
	function index() {
		// uninstall module
		if ( $this->db->table_exists( 'service_category' ) ) {
			$sql = 'DROP TABLE `'.$this->db->dbprefix('service_category').'`;';
			$this->db->query( $sql );
		}
		if ( $this->db->table_exists( 'service_category_gallery_config' ) ) {
			$sql = 'DROP TABLE `'.$this->db->dbprefix('service_category_gallery_config').'`;';
			$this->db->query( $sql );
		}
		if ( $this->db->table_exists( 'service_category_gallery_detail' ) ) {
			$sql = 'DROP TABLE `'.$this->db->dbprefix('service_category_gallery_detail').'`;';
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

