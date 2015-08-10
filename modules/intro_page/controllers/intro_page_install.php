<?php
/**
*
* Jiryau@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class intro_page_install extends admin_controller {
	
	
	public $module_system_name = 'intro_page';

	
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

		if ( !$this->db->table_exists( 'intro_page' ) ) {
			$sql = 'CREATE TABLE `'.$this->db->dbprefix('intro_page').'` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `link_url` text COLLATE utf8_unicode_ci NOT NULL,
				  `select_cover` int(1) NOT NULL,
				  `image_name_cover` text COLLATE utf8_unicode_ci NOT NULL,
				  `youtube_id_cover` text COLLATE utf8_unicode_ci NOT NULL,
				  `file_video_cover` text COLLATE utf8_unicode_ci NOT NULL,
				  `intro_text` text COLLATE utf8_unicode_ci NOT NULL,
				  `start_date` int(20) NOT NULL,
				  `end_date` int(20) NOT NULL,
				  `order_sort` int(11) NOT NULL,
				  `open_this_page` int(1) NOT NULL,
				  `status` int(1) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;';
			$this->db->query( $sql );

		}				

		$this->db->set( 'module_install', '1' );
		$this->db->where( 'module_system_name', $this->module_system_name );
		$this->db->update( 'modules' );
		// go back
		redirect( 'site-admin/module' );
	}

	
}

