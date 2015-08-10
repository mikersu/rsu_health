<?php
/**
*
* Jiryau@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class home_install extends admin_controller {
	
	
	public $module_system_name = 'home';

	
	function __construct() {
		parent::__construct();
	}
	
	
	function index() {
		$this->db->where( 'module_system_name', $this->module_system_name );
		$query = $this->db->get( 'modules' );
		if ( $query->num_rows() <= 0 ) {
			$query->free_result();
			echo 'Installed.';
			return null;
		}
		// install module.
		// DATABASE home
		if ( !$this->db->table_exists( 'home_slider_config' ) ) {
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('home_slider_config').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `language_id` int(11) NOT NULL,
					  `image_home` varchar(255) NOT NULL,
					  `image_recommended` varchar(255) NOT NULL,
					  `title` varchar(255) NOT NULL DEFAULT "",
					  `insert_date` int(20) NOT NULL,
					  `home_date` varchar(20) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}

		$this->db->set( 'module_install', '1' );
		$this->db->where( 'module_system_name', $this->module_system_name );
		$this->db->update( 'modules' );
		// go back
		redirect( 'site-admin/module' );
	}

	
}

