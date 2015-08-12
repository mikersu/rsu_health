<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class fabout_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct



    // get data list  
    public function get_list( $language_id = '' , $show = 'admin' , $limit_page = '' , $start = 0 , $string = '' )
    {

        $this->db->from( 'about_config AS nc' );
        $this->db->join( 'about_detail AS nd', 'nc.id = nd.about_id', 'left' );

        $this->db->where( 'nd.language_id', $language_id );

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'nc.status !=', 0 );
            if ( ! empty( $limit_page ) ) 
            {
                $start = ( ! empty( $start ) ) ? $start : 0 ;

                if ( $start <= 0 ) 
                {
                    $start = 0;
                } 
                else 
                {
                    $start = ($limit_page*$start)-$limit_page;  
                }

                $this->db->limit( $limit_page , $start );
            }
        }

        if ( ! empty( $string ) ) 
        {
            $this->db->like( 'nd.title', $string );
        }

        $this->db->order_by( 'nc.order_sort', 'ASC' );
        $this->db->order_by( 'nc.id', 'desc' );
        $this->db->select( 'nc.*, nd.* , nc.id AS id' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }    


    // get data list  
    public function calendar_list( $start = '' , $end = '' )
    {

    	$this->db->where( 'about_date >=', $start );
    	$this->db->where( 'about_date <=', $end );
        $this->db->where( 'language_id', $this->session->userdata( 'lang' ) );

        $this->db->where( 'show_calendar', 1 );

        $this->db->order_by( 'order_sort', 'ASC' );
        $this->db->order_by( 'id', 'desc' );
        $query = $this->db->get( 'about' );
        $data = $query->result();

        return $data;
    } 




    // get data list  
    public function get_total( $show = 'admin' , $string = '' )
    {
        $this->db->from( 'about_config' );

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status !=', 0 );
            //$this->db->where( ' ( ( `end_date` >= '. strtotime( date("Y-m-d") ) . ' AND `start_date` <= ' . strtotime( date("Y-m-d") ) . ' ) OR end_date = 0 ) ', false , false );
        }

        if ( ! empty( $string ) ) 
        {
            $this->db->like( 'title', $string );
        }
        $query = $this->db->get();
        $total = $query->num_rows();
        return $total;
    }  



    // get data one product
    public function get_data( $id = '' , $type = 'object' )
    {

        $lang = ( $this->session->userdata( 'lang' ) ) ? $this->session->userdata( 'lang' ) : 1 ;

        $this->db->from( 'about_config AS nc' );
        $this->db->join( 'about_detail AS nd', 'nc.id = nd.about_id', 'left' );
        $this->db->where( 'nc.id', $id );
        $this->db->where( 'nd.language_id', $lang );
        $query = $this->db->get();
        if ( $type == 'object' ) 
        {
            $data = $query->row();
        }
        else
        {
            $data = $query->row_array();
        }
        return $data;

    }

    public function get_gallery( $id = '' , $type = 'object' )
    {
    
        $this->db->where( 'about_id', $id );
        $query = $this->db->get( 'about_gallery' );

        if ( $type == 'object' ) 
        {
            $data = $query->result();
        }
        else
        {
            $data = $query->result_array();
        }

        return $data;
    
    } // END FUNCTION get_gallery


}