<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content_config_model extends CI_Model 
{
	function __construct() {
		parent::__construct();
	}// __construct

	public function add( $type = '' , $content = '' , $language_id = '' )
	{
		$this->db->where( 'type_config', $type );
		if ( !empty($language_id) ) {
			$this->db->where( 'language_id', $language_id );
		}
		$query = $this->db->get( 'content_config' );
		$data = $query->row();

		if ( ! empty( $data ) ) 
		{
			$this->db->where( 'language_id', $language_id );
			$this->db->where( 'type_config', $type );
			$this->db->set( 'content', $content );
			$this->db->update( 'content_config' );
		}
		else
		{
			$this->db->set( 'language_id', $language_id );
			$this->db->set( 'type_config', $type );
			$this->db->set( 'content', $content );
			$this->db->insert( 'content_config' );
		}


	}

	public function get( $type = '' , $language_id = '' )
	{
		if ( ! empty( $language_id ) ) 
		{
			$this->db->where( 'language_id', $language_id );
		}

		$this->db->where( 'type_config', $type );
		$query = $this->db->get( 'content_config' );
		$data = $query->row();
		return $info = ( empty( $data->content ) ) ? '' : $data->content ;
	}



	public function get_all( $type = '' , $object = 'true' ) {
	
		$this->db->where( 'type_config', $type );
		$query = $this->db->get( 'content_config' );
		if ( $object ) {
			$data = $query->result();
			return $data;
		}

		$data = $query->result_array();
		return $retVal = ( ! empty( $data ) ) ? $data : array() ;
		
	}// END get_all 


	public function set_get_all( $type = '' ) {
	
		$this->db->where( 'type_config', $type );
		$query = $this->db->get( 'content_config' );
		$data = $query->result();
		$array = array();		
		foreach ( $data as $key => $value ) {
			$array[$value->language_id] = $value->content;
		}
		return $array;
		
	}// END set_get_all 



}