<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */
 
class blocks_model extends CI_Model {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * add_to_area
	 * @param array $data
	 * @return mixed 
	 */
	function add_to_area( $data = array() ) {
		// set additional data for insert to db
		$data['position'] = $this->get_latest_position( $data['theme_system_name'], $data['area_name'] );
		$data['language'] = $this->lang->get_current_lang();
		
		// insert into table
		$this->db->insert( 'blocks', $data );
		
		// done, set result and insert_id.
		$output['result'] = true;
		$output['id'] = $this->db->insert_id();
		return $output;
	}// add_to_area
	
	
	/**
	 * edit
	 * @param array $data
	 * @return boolean 
	 */
	function edit( $data = array() ) {
		// set 'block_values' field data.----------------------
		$value = array();
		foreach ( $this->input->post() as $key => $item ) {
			if ( !key_exists( $key, $data ) ) {
				$value[$key] = $item;
			}
		}
		if ( !empty( $value ) ) {
			$data['block_values'] = serialize( $value );
		}
		// end set 'block_values' field data.----------------------
		
		$this->db->where( 'block_id', $data['block_id'] );
		$this->db->update( 'blocks', $data );
		
		// done
		return true;
	}// edit
	
	
	/**
	 *  get blocks data from db
	 * @param array $data
	 * @return mixed
	 */
	function get_block_db( $data = array() ) {
		if ( !empty( $data ) ) {
			$this->db->where( $data );
		}
		
		$query = $this->db->get( 'blocks' );
		
		return $query->row();
	}// get_block_db
	
	
	/**
	 * get_block_data
	 * @param string $block_name
	 * @param string $block_file
	 * @param string $datatype
	 * @return string 
	 */
	function get_block_data( $block_name = '', $block_file = '', $datatype = 'title' ) {
		if ( file_exists( $this->config->item( 'modules_uri' ).$block_file ) ) {
			// load helper
			$this->load->helper( 'widget' );
			
			// include module block file.
			include_once( $this->config->item( 'modules_uri' ).$block_file );
			
			// initiate new class
			$fileobj = new $block_name;
			
			if ( property_exists( $fileobj, $datatype ) ) {
				$output = $fileobj->$datatype;
			} else {
				$output = $block_name;
			}
			
			return $output;
		}
	}// get_block_data
	
	
	/**
	 * get_latest_position
	 * @param string $theme_system_name
	 * @param string $area_name
	 * @return integer
	 */
	function get_latest_position( $theme_system_name = '', $area_name = '' ) {
		if ( empty( $theme_system_name ) || empty( $area_name ) ) {return 1;}
		
		$this->db->where( 'theme_system_name', $theme_system_name );
		$this->db->where( 'area_name', $area_name );
		$this->db->where( 'language', $this->lang->get_current_lang() );
		$this->db->order_by( 'position', 'desc' );
		
		$query = $this->db->get( 'blocks' );
		
		if ( $query->num_rows() <= 0 ) {
			$output = 1;
		} else {
			$row = $query->row();
			$output = ( $row->position+1 );
		}
		
		unset( $row );
		
		return $output;
	}// get_latest_position
	
	
	/**
	 * list all blocks in all areas in selected themes
	 * @param string $theme_system_name
	 * @return mixed 
	 */
	function list_blocks_in_areas( $theme_system_name = '' ) {
		// get all areas in this theme
		$list_areas = $this->themes_model->list_areas( $theme_system_name );
		
		// preset output
		$output = null;
		
		if ( is_array( $list_areas ) ) {
			foreach ( $list_areas as $area ) {
				$this->db->where( 'theme_system_name', $theme_system_name );
				$this->db->where( 'area_name', $area['area_system_name'] );
				$this->db->where( 'language', $this->lang->get_current_lang() );
				$this->db->order_by( 'position', 'asc' );
				
				$query = $this->db->get( 'blocks' );
				
				// set results
				$output[$area['area_system_name']] = $query->result();
				$query->free_result();
			}
		}
		
		return $output;
	}// list_blocks_in_areas
	
	
	/**
	 * just alias
	 * @param string $area_name
	 * @return string 
	 */
	function render_area( $area_name = '' ) {
		return $this->themes_model->render_area( $area_name );
	}// render_area
	
	
}

// EOF