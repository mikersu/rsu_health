<?php
/**
*
* Jiryau.k@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class service_install extends admin_controller {
	
	
	public $module_system_name = 'service';

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

		// CREATE TABLE
		if ( !$this->db->table_exists( 'service_category' ) ) 
		{
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('service_category').'` (
				  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				  `image` varchar(255) NOT NULL DEFAULT "",
				  `order_sort` int(11) NOT NULL DEFAULT "0",
				  `status` int(1) NOT NULL DEFAULT "1",
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}

		// CREATE TABLE
		if ( !$this->db->table_exists( 'service_category_gallery_config' ) ) 
		{
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('service_category_gallery_config').'` (
				  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				  `ref_category_id` int(11) NOT NULL,
				  `image` int(11) DEFAULT NULL,
				  `order_sort` int(11) NOT NULL,
				  `status` int(1) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}	
		
		// CREATE TABLE
		if ( !$this->db->table_exists( 'service_category_gallery_detail' ) ) 
		{
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('service_category_gallery_detail').'` (
				  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				  `ref_id_gallery` int(11) NOT NULL,
				  `language_id` int(11) NOT NULL,
				  `title` varchar(255) NOT NULL DEFAULT "",
				  `detail` text NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}		


		$this->db->set( 'module_install', '1' );
		$this->db->where( 'module_system_name', $this->module_system_name );
		$this->db->update( 'modules' );
		// go back
		redirect( 'site-admin/module' );
	}

	
}

