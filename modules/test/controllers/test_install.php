<?php
/**
*
* Jiryau@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class test_install extends admin_controller {
	
	
	public $module_system_name = 'test';

	
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
		// DATABASE test
		if ( !$this->db->table_exists( 'test_detail' ) ) {
			$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->db->dbprefix('test_detail').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `language_id` int(11) NOT NULL,
					  `title` varchar(255) NOT NULL DEFAULT "",
					  `description` tinytext,
					  `order_sort` int(11) NOT NULL,
					  `status` int(1) DEFAULT NULL,
					  PRIMARY KEY (`id`),
					  KEY `language_id` (`language_id`),
					  KEY `status` (`status`)
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

