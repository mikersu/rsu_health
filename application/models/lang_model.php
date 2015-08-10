<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class lang_model extends CI_Model 
{
	
	
	function __construct() 
	{
		parent::__construct();
	}// __construct


	public function add_lang( $info = '' )
	{
		if ( empty( $info['status'] ) ) 
		{
			$info['status'] = 0;
		}

		if ( ! empty( $info['language_default'] ) ) 
		{

			$this->db->where( 'config_name', 'language_default' );
			$query = $this->db->get( 'config' );
			$data = $query->row();

			if ( ! empty( $data ) ) 
			{
				$this->db->where( 'config_name', 'language_default' );
				$this->db->set( 'config_value', $info['language_default'] );
				$this->db->set( 'config_core', 1 );
				$this->db->update( 'config' );
			} 
			else 
			{
				$this->db->set( 'config_name', 'language_default' );
				$this->db->set( 'config_value', $info['language_default'] );
				$this->db->set( 'config_core', 1 );
				$this->db->insert( 'config' );
			}

			unset( $info['language_default'] );

		}


		$this->db->insert( 'language', $info );
	}

	public function get_list( $id = '' , $show = 'admin' )		
	{

		// IF HAS ID
		if ( ! empty( $id ) ) 
		{
			$this->db->where( 'id', $id );
		}

		// SHOW FRONT END 
		if ( $show != 'admin' ) 
		{
			$this->db->where( 'status', 1 );
		}

		$this->db->order_by( 'order_sort', 'ASC' );
		$query = $this->db->get( 'language' );

		if ( ! empty( $id ) ) 
		{
			$data = $query->row();
		}
		else
		{
			$data = $query->result();
		}

		return $data;

	}

	public function edit_lang( $id = '' , $info = '' )
	{
		if ( empty( $info['status'] ) ) 
		{
			$info['status'] = 0;
		}

		if ( ! empty( $info['language_default'] ) ) 
		{

			$this->db->where( 'config_name', 'language_default' );
			$query = $this->db->get( 'config' );
			$data = $query->row();

			if ( ! empty( $data ) ) 
			{
				$this->db->where( 'config_name', 'language_default' );
				$this->db->set( 'config_value', $info['language_default'] );
				$this->db->set( 'config_core', 1 );
				$this->db->update( 'config' );
			} 
			else 
			{
				$this->db->set( 'config_name', 'language_default' );
				$this->db->set( 'config_value', $info['language_default'] );
				$this->db->set( 'config_core', 1 );
				$this->db->insert( 'config' );
			}

			unset( $info['language_default'] );

		}


		$this->db->where( 'id', $id );
		
		$this->db->update( 'language' , $info );
	}

	public function get_name_lang( $id = '' )
	{
		$this->db->where( 'id', $id );
		$query = $this->db->get( 'language' );
		$data = $query->row();
		$info = ( ! empty( $data->language_name ) ) ? $data->language_name : '' ;
		return $info;
	}


	public function get_lang_default()
	{
		$this->db->select( 'config_value' );
		$this->db->where( 'config_name', 'language_default' );
		$query = $this->db->get( 'config' );
		$data = $query->row();
		return $lang_id = ( ! empty( $data->config_value ) ) ? $data->config_value : '0' ;
	}


	
	


}