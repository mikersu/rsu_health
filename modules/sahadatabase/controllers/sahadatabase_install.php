<?php
/**
*
* Jiryau@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class sahadatabase_install extends admin_controller {
	
	
	public $module_system_name = 'sahadatabase';

	
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
		if ( !$this->db->table_exists( 'sahadatabase' ) ) {
			// $sql = 'CREATE TABLE `'.$this->db->dbprefix('about').'` (
			//   `id` int(11) NOT NULL AUTO_INCREMENT,
			//   `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			//   `detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			//   `year` int(11) NOT NULL,
			//   `slug` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			//   `tag_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			//   `tag_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			//   `slug_encode` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
			//   `modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT "จะ update auto เมื่อข้อมูลมีการแก้ไข",
			//   `mark_sort` int(11) NOT NULL,
			//   PRIMARY KEY (`id`)
			// ) ENGINE = InnoDB;';
			// $this->db->query( $sql );
		}
		$this->db->set( 'module_install', '1' );
		$this->db->where( 'module_system_name', $this->module_system_name );
		$this->db->update( 'modules' );
		// go back
		redirect( 'site-admin/module' );
	}

	
}

