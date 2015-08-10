<?php
/**
*
* Block comment
*
**/

class member_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'Member' => array( 'Access Member','Add Member' , 'Edit Member' , 'Delete Member' , 'Accress Menu Member Admin' ) );
	}// _define_permission
	
	
	function admin_nav() {
		return '';
	}// admin_nav
	
	
}