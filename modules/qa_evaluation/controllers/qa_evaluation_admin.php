<?php
/**
*
* Block comment
*
**/

class qa_evaluation_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		return array( 'QA_Evaluation' => array( 'Access QA_Evaluation' , 'Add QA_Evaluation' , 'Edit QA_Evaluation' , 'Delete QA_Evaluation' , 'Sort QA_Evaluation' ) );
	}// _define_permission
	
	
	function admin_nav() {
		return '';
	}// admin_nav
	
	
}