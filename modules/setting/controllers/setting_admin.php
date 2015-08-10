<?php
/**
*
* Block comment
*
**/

class setting_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'Setting' => array( 'Delete Cache', 'Setting Info' ) );
	}// _define_permission
	
	
	function admin_nav() {
		return '<li>' . anchor( '#', lang( 'blog_blog' ), array( 'onclick' => 'return false' ) ) . '
				<ul>
					<li>' . anchor( 'blog/site-admin/blog', lang( 'blog_manage_posts' ) ) . '</li>
					<li>' . anchor( 'blog/site-admin/blog/add', lang( 'blog_new_post' ) ) . '</li>
				</ul>
			</li>';
	}// admin_nav
	
	
}