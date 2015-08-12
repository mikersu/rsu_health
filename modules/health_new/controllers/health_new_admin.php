<?php
/**
*
* Block comment
*
**/

class health_new_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'Health_new' => array( 'Access Health_new' , 'Add Health_new' , 'Edit Health_new' , 'Delete Health_new' , 'Sort Health_new' ) );
	}// _define_permission
	
	
	function admin_nav() {
		return '';
	}// admin_nav
	
	
}