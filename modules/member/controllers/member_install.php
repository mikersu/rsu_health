<?php
/**
*
* Jiryau@bizidea.co.th
* vision 0.2
* Date 26-09-56
*
**/

class member_install extends admin_controller {
	
	
	public $module_system_name = 'member';

	
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

		if (!$this->db->field_exists('name','accounts' ) ) 
		{
			$sql2 = "ALTER TABLE `".$this->db->dbprefix('accounts')."` ADD `name` VARCHAR( 255 ) NOT NULL AFTER `account_confirm_code`";	
			$this->db->query($sql2);
		}

		if (!$this->db->field_exists('phone','accounts' ) ) 
		{
			$sql2 = "ALTER TABLE `".$this->db->dbprefix('accounts')."` ADD `phone` VARCHAR( 20 ) NOT NULL AFTER `account_confirm_code`";	
			$this->db->query($sql2);
		}

		if (!$this->db->field_exists('address','accounts' ) ) 
		{
			$sql2 = "ALTER TABLE `".$this->db->dbprefix('accounts')."` ADD `address` VARCHAR( 255 ) NOT NULL AFTER `account_confirm_code`";	
			$this->db->query($sql2);
		}


		if (!$this->db->field_exists('member_type','accounts' ) ) 
		{
			$sql2 = "ALTER TABLE `".$this->db->dbprefix('accounts')."` ADD `member_type` INT( 11 ) NOT NULL AFTER `account_confirm_code`";	
			$this->db->query($sql2);
		}


		if (!$this->db->field_exists('package_type','accounts' ) ) 
		{
			$sql2 = "ALTER TABLE `".$this->db->dbprefix('accounts')."` ADD `package_type` INT( 11 ) NOT NULL AFTER `account_confirm_code`";	
			$this->db->query($sql2);
		}



		$this->db->set( 'module_install', '1' );
		$this->db->where( 'module_system_name', $this->module_system_name );
		$this->db->update( 'modules' );
		// go back
		redirect( 'site-admin/module' );
	}

	
}

