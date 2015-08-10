<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class ftype_setting_model extends CI_Model 
{

    function __construct() 
    {
        parent::__construct(); 
    }// __construct

    public function get_type( $type = '' )
    {
    	$this->db->select( 'tsc.id AS id , tsc.* , tsd.*' );
    	$this->db->from( 'type_setting_config AS tsc' );
    	$this->db->where( 'tsc.type', $type );
    	$this->db->where( 'tsc.status', 1 );
    	$this->db->join( 'type_setting_detail AS tsd', 'tsc.id = tsd.ref_id_config', 'left' );
    	$this->db->where( 'tsd.language_id', $this->session->userdata( 'lang' ) );
    	$query = $this->db->get();
    	$data = $query->result();
    
    	return $data;
    } // END FUNCTION get_type


    public function get_name_type( $id = '' )
    {
        $this->db->select( 'tsc.id AS id , tsc.* , tsd.*' );
        $this->db->from( 'type_setting_config AS tsc' );
        $this->db->where( 'tsc.id', $id );
        $this->db->where( 'tsc.status', 1 );
        $this->db->join( 'type_setting_detail AS tsd', 'tsc.id = tsd.ref_id_config', 'left' );
        $this->db->where( 'tsd.language_id', $this->session->userdata( 'lang' ) );
        $query = $this->db->get();
        $data = $query->row();
    
        return $data;
    } // END FUNCTION get_type


}