<?php
/**
*
* Block comment
*
**/

class service_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'Engineering Service' => array( 'Access Content Service', 'Access Engineering Service List', 'Add Engineering Service List', 'Edit Engineering Service List', 'Delete Engineering Service List', 'Sort Engineering Service List') );
	}// _define_permission
	
	
	// function admin_nav() {
	// 	return '<li>' . anchor( '#', lang( 'service_service' ), array( 'onclick' => 'return false' ) ) . '
	// 			<ul>
	// 				<li>' . anchor( 'service/site-admin/service', lang( 'service_manage_posts' ) ) . '</li>
	// 				<li>' . anchor( 'service/site-admin/service/add', lang( 'service_new_post' ) ) . '</li>
	// 			</ul>
	// 		</li>';
	// }// admin_nav
	
	
}