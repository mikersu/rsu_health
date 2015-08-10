<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class fservice_model extends CI_Model 
{

    function __construct() 
    {
        parent::__construct(); 
    }// __construct


    public function list_category() {
    
        $this->db->where_in( 'status', 1 );
        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'service_category' );
        $data = $query->result();

        return $data;
        
    }// END list_category 


}