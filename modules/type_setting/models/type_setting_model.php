<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class type_setting_model extends CI_Model 
{

    function __construct() 
    {
        parent::__construct(); 
    }// __construct



    public function get_name_type_only( $id = '' )
    {
        $this->load->model( 'lang_model' );


        $language_id = $this->lang_model->get_lang_default();

        $this->db->select( 'tsc.id AS id , tsc.* , tsd.*' );
        $this->db->from( 'type_setting_config AS tsc' );
        $this->db->where( 'tsc.id', $id );
        $this->db->where( 'tsc.status', 1 );
        $this->db->join( 'type_setting_detail AS tsd', 'tsc.id = tsd.ref_id_config', 'left' );

        $language_id = ( $this->session->userdata( 'lang' )  ) ? $this->session->userdata( 'lang' ) : $language_id ;

        $this->db->where( 'tsd.language_id', $language_id );
        $query = $this->db->get();
        $data = $query->row();
    
        return $name = ( ! empty( $data->name_type ) ) ? $data->name_type : '' ;
    } // END FUNCTION get_type



    // get data list  
    public function get_type_list( $type_setting = '' , $id = '' , $show = 'admin' , $type = 'object' )
    {

        $this->db->from( 'type_setting_config' );
        $this->db->where( 'type', $type_setting );

        // CHECK HAS ID
        if ( ! empty( $id ) ) 
        {
            $this->db->where( 'id', $id );
        }

        // SHOW IN FRONT END
        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status', 1 );
        }

        $this->db->order_by( 'order_sort', 'ASC' );
        $this->db->order_by( 'id', 'desc' );

        $query = $this->db->get();

        // RETURN QUERY 
        if ( ! empty( $id ) ) 
        {
            if ( $type != 'object' ) 
            {
                $data = $query->row_array();
            }
            else
            {
                $data = $query->row();
            }
        }
        else
        {
            if ( $type != 'object' ) 
            {
                $data = $query->result_array();
            }
            else
            {
                $data = $query->result();
            }
        }
        
        return $data;

    } 


    public function get_type_detail( $ref_id_config = '' )
    {
    
        $this->db->where( 'ref_id_config', $ref_id_config );
        $query = $this->db->get( 'type_setting_detail' );
        $data = $query->result();
        return $data;    
    
    } // END FUNCTION GET_IMAGE_DETAIL


    // EDIT DATA 
    public function edit( $type = '' , $id = '' , $info = '' )
    {

        // ADD GALLERY CONFIG
        $this->db->where( 'id', $id );
        $this->db->set( 'type', $type );
        $info['status'] = ( ! empty( $info['status'] ) ) ? $info['status'] : 0 ;
        $this->db->set( 'status', $info['status'] );
        $this->db->update( 'type_setting_config' );


        // EDIT DETIAL
        foreach ( $info['name_type'] as $key => $value ) 
        {
            $this->db->where( 'ref_id_config', $id );
            $this->db->where( 'language_id', $key );
            $this->db->set( 'name_type', $value );
            $this->db->update( 'type_setting_detail' );
        }
        

    }

    // ADD 
    public function add( $type = '' , $info = '' )
    {
        // ADD GALLERY CONFIG
        
        $info['status'] = ( ! empty( $info['status'] ) ) ? $info['status'] : 0 ;
        $this->db->set( 'status', $info['status'] );
        $this->db->set( 'type', $type );
        $this->db->set( 'order_sort', 0 );
        $this->db->insert( 'type_setting_config' );

        $id = $this->db->insert_id();

        // ADD DATA CONTENT GALLERY 
        foreach ( $info['name_type'] as $key => $value ) 
        {
            $this->db->set( 'ref_id_config', $id );
            $this->db->set( 'language_id', $key );
            $this->db->set( 'name_type', $value );
            $this->db->insert( 'type_setting_detail' );
        }

    } // END ADD


    // delete data
    public function delete( $id = '')
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'type_setting_config' );

        $this->db->where( 'ref_id_config', $id );
        $this->db->delete( 'type_setting_detail' );

    }


}