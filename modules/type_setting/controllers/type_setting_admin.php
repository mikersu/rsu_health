<?php
/**
*
* Block comment
*
**/

class type_setting_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'type_setting_admin' => array( 'type_setting_all_post', 'type_setting_add_post', 'type_setting_edit_post', 'type_setting_delete_post' ) );
	}// _define_permission
	
	
	// function admin_nav() {
	// 	return '<li>' . anchor( '#', lang( 'type_setting_type_setting' ), array( 'onclick' => 'return false' ) ) . '
	// 			<ul>
	// 				<li>' . anchor( 'type_setting/site-admin/type_setting', lang( 'type_setting_manage_posts' ) ) . '</li>
	// 				<li>' . anchor( 'type_setting/site-admin/type_setting/add', lang( 'type_setting_new_post' ) ) . '</li>
	// 			</ul>
	// 		</li>';
	// }// admin_nav
	
	
}