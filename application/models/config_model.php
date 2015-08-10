<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */

class config_model extends CI_Model {

	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * delete_cache
	 * @param string $partial_name
	 * @return boolean 
	 */
	function delete_cache( $partial_name = '' ) {
		if ( empty( $partial_name ) ) {return false;}
		
		// if partial is ALL (clean cache)
		if ( $partial_name == 'ALL' || $partial_name == 'clean' ) {
			$this->load->driver( 'cache' );
			
			//return $this->cache->clean();// << DO NOT use this method because it is delete all index.html and .htaccess files
			$map = scandir( 'application/cache' );
			
			if ( is_array( $map ) && !empty( $map ) ) {
				foreach ( $map as $key => $item ) {
					if ( $item != '.' && $item != '..' && $item != 'index.html' && $item != '.htaccess' ) {
						unlink( 'application/cache/'.$item );
					}
				}
			}
		}
		
		// delete cache
		$map = scandir( 'application/cache' );
		if ( is_array( $map ) && !empty( $map ) ) {
			foreach ( $map as $key => $item ) {
				if ( strpos( $item, $partial_name ) !== false ) {
					unlink( 'application/cache/'.$item );
				}
			}
		}
		
		return true;
	}// delete_cache
	
	
	/**
	 * load config from db
	 * @param array $fields
	 * @return array 
	 */
	function load( $fields = array() ) {

		if ( ! is_array( $fields ) ) {return $this->load_single( $fields );}
		if ( empty( $fields ) ) {return array();}
		
		$this->db->where_in( 'config_name', $fields );
		$query = $this->db->get( 'config' );
		
		if ( $query->num_rows() > 0 ) {
			foreach ( $query->result() as $row ) {
				$output[$row->config_name]['value'] = $row->config_value;
				$output[$row->config_name]['core'] = $row->config_core;
				$output[$row->config_name]['description'] = $row->config_description;
			}
			$query->free_result();		
			return $output;
		}
		$query->free_result();

		return array();
	}// load
	
	
	function load_single( $config_name = '', $return_field = 'config_value' ) {
		if ( empty( $config_name ) ) {return null;}
		
		// load cache driver
		$this->load->driver( 'cache', array( 'adapter' => 'file' ) );
		
		// check cached
		if ( false === $cfg_val = $this->cache->get( 'cfgload_'.$config_name.'_'.$return_field ) ) {
			if ( $config_name == 'content_frontpage_category' ) {
				$this->db->where( 'language', $this->lang->get_current_lang() );
				$query = $this->db->get( 'frontpage_category' );
				
				if ( $query->num_rows() > 0 ) {
					$row = $query->row();
					$query->free_result();
					unset( $query );
					
					$this->cache->save( 'cfgload_'.$config_name.'_'.$return_field, $row->tid, 2678400 );
					
					return $row->tid;
				}
				$query->free_result();
				
				return null;
			} else {
				$this->db->where( 'config_name', $config_name );
				$query = $this->db->get( 'config' );
				
				if ( $query->num_rows() > 0 ) {
					$row = $query->row();
					$query->free_result();
					unset( $query );
					
					$this->cache->save( 'cfgload_'.$config_name.'_'.$return_field, $row->$return_field, 2678400 );
					
					return $row->$return_field;
				}
				$query->free_result();
				
				return null;
			}
		}
		
		return $cfg_val;
	}// load_single
	
	
	function save( $data = array() ) {
		if ( empty( $data ) ) {return false;}
		if ( !is_array( $data ) ) {return false;}
		
		foreach ( $data as $key => $item ) {
			$this->db->set( 'config_value', $item );
			$this->db->where( 'config_name', $key );
			$this->db->update( 'config' );
		}
		
		$this->save_frontpage_category( $data );
		
		// clear cfgload cache
		$this->delete_cache( 'cfgload_' );
		$this->delete_cache( 'chkacc_' );
		
		// done
		return true;
	}// save
	
	
	function save_frontpage_category( $data = array() ) {
		if ( !isset( $data['content_frontpage_category'] ) ) {return false;}
		
		$this->db->where( 'language', $this->lang->get_current_lang() );
		$query = $this->db->get( 'frontpage_category' );
		
		if ( $query->num_rows() > 0 ) {
			// exists, use update
			$this->db->where( 'language', $this->lang->get_current_lang() );
			$this->db->set( 'tid', $data['content_frontpage_category'] );
			$this->db->update( 'frontpage_category' );
		} else {
			// not exists, use insert
			$this->db->set( 'language', $this->lang->get_current_lang() );
			$this->db->set( 'tid', $data['content_frontpage_category'] );
			$this->db->insert( 'frontpage_category' );
		}
		
		return true;
	}// save_frontpage_category
	

}

