<?php
/**
*
* Jiryau.k@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class type_setting_install extends admin_controller {
	
	
	public $module_system_name = 'type_setting';

	function __construct() 
	{
		parent::__construct();
	}
	
	function index() {
		$this->db->where( 'module_system_name', $this->module_system_name );
		$query = $this->db->get( 'modules' );
		if ( $query->num_rows() <= 0 ) 
		{
			$query->free_result();
			echo 'Installed.';
			return null;
		}
		// install module.

		if ( !$this->db->table_exists( 'type_setting_config' ) ) 
		{
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('type_setting_config').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `type` varchar(100) NOT NULL DEFAULT "",
					  `order_sort` int(11) DEFAULT NULL,
					  `status` int(1) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}


		if ( !$this->db->table_exists( 'type_setting_detail' ) ) 
		{
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('type_setting_detail').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `ref_id_config` int(11) NOT NULL,
					  `language_id` int(11) NOT NULL,
					  `name_type` varchar(255) NOT NULL DEFAULT "",
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

