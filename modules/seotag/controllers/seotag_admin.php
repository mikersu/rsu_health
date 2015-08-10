<?php
/**
*
* Block comment
*
**/

class seotag_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'Seo Tag Setting' => array( 'Access Setting' ) );
	}// _define_permission
	
	
	function admin_nav() {
		return '<li>' . anchor( '#', lang( 'seotag_admin' ), array( 'onclick' => 'return false' ) ) . '
			</li>';
	}// admin_nav
	
	
}