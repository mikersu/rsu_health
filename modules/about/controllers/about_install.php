<?php
/**
*
* Jiryau@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class about_install extends admin_controller {
	
	
	public $module_system_name = 'about';

	
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
		/*
		// install module.
		// DATABASE about
		if ( !$this->db->table_exists( 'about_category' ) ) {
			$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->db->dbprefix('about_category').'` (
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
		}*/
		// DATABASE about_config
		if ( !$this->db->table_exists( 'about_config' ) ) {
			$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->db->dbprefix('about_config').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `image` varchar(255) NOT NULL DEFAULT "",
					  `select_cover` int(11) NOT NULL,
					  `youtube_id` varchar(255) NOT NULL DEFAULT "",
					  `file_video` varchar(255) NOT NULL DEFAULT "",
					  `date_add` int(30) NOT NULL,
					  `insert_date` int(30) NOT NULL,
					  `order_sort` int(11) NOT NULL,
					  `about_date` int(11) NOT NULL,
					  `status` int(11) DEFAULT NULL,
					  `slug` varchar(255) NOT NULL DEFAULT "",
					  `hash` varchar(255) NOT NULL DEFAULT "",
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}
		// DATABASE about_detail
		if ( !$this->db->table_exists( 'about_detail' ) ) {
			$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->db->dbprefix('about_detail').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `about_id` int(11) NOT NULL,
					  `language_id` int(11) NOT NULL,
					  `title` varchar(255) NOT NULL DEFAULT "",
					  `detail` text NOT NULL,
					  `description` text NOT NULL,
					  PRIMARY KEY (`id`),
					  KEY `language_id` (`language_id`)
					) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';
			$this->db->query( $sql );
		}
				
		if ( !$this->db->table_exists( 'about_gallery' ) ) {
			$sql = 'CREATE TABLE IF NOT EXISTS `'.$this->db->dbprefix('about_gallery').'` (
					  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
					  `about_id` int(11) NOT NULL,
					  `image` varchar(255) NOT NULL DEFAULT "",
					  PRIMARY KEY (`id`),
					  KEY `gallery_id` (`about_id`)
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

