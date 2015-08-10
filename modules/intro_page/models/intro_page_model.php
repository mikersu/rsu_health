<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class intro_page_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct


    public function add( $info = '' )
    {
        $info['status'] = ( empty( $info['status'] ) ) ? 0 : 1 ;
        $this->db->insert( 'intro_page', $info );
    } 
	
    // get data list  
    public function get_list( $show = 'admin' )
    {
        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status', 1 );
        }
        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'intro_page' );
        $data = $query->result();
        return $data;
    }    

    // get data one product
    public function get_data( $id = '' , $show = 'admin' )
    {

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status', 1 );
        }
        $this->db->where( 'id', $id );
        $query = $this->db->get( 'intro_page' );
        $data = $query->row_array();
        return $data;

    }

    // edit data 
    public function edit( $id = '' , $info = '' )
    {
        $info['status'] = ( empty( $info['status'] ) ) ? 0 : 1 ;
        $this->db->where( 'id', $id );
        $this->db->update( 'intro_page', $info );
    }

    // delete data
    public function delete( $id = '')
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'intro_page' );
    }

    // check url slug in database has empty
    public function check_slug_empty( $info = '' )
    {
        $this->db->where( 'slug', $info );
        $query = $this->db->get( 'about' );
        $data = $query->result();

        if ( ! empty( $data ) ) 
        {
            return count( $data );
        }

        return 0;

    }

    // chek slug have in id it
    public function check_slug( $id = '' , $info = '' )
    {
        $this->db->where( 'id', $id );
        $this->db->where( 'slug', $info );
        $query = $this->db->get( 'about' );
        $data = $query->result();
        if ( ! empty( $data ) ) 
        {
            return FALSE;
        }
        return TRUE;
    }


    /**
     * Generate slug url for article, check other record in database
     * ensure we get a unique url for each article, append duplicate number if neccessary
     *
     * @param String  $title     object name represention, eg. category name, article title , whatever
     * @param Integer $object_id id of object itselves
     * @return String
     **/
    public function generate_slug($title, $object_id = NULL)
    {
        $title = make_url($title, 255);

        // we may need to exclude object itselve sfrom checking
        if (is_numeric($object_id) AND $object_id > 0)
        {
            $this->db->where( 'id !=', $object_id );
        }
        
        // get all slug match with generated title
        $items = $this->db->select( 'slug' )
        ->where('slug REGEXP BINARY \'^'.$this->db->escape_like_str($title).'(-[0-9]+)?$\'', NULL, FALSE)
        ->order_by( 'LENGTH(slug)', 'desc' )
        ->order_by( 'slug', 'desc' )
        ->get( 'webboard_topic_config' )
        ->row();

        // not found, we can use it
        if (empty($items))
        {
            return $title;
        }
        
        // start number tracking
        $num = 0;
        
        if (preg_match('~-([\d]+)$~', $items->slug, $match))
        {
            if ($match[1] > $num)
            {
                $num = $match[1];
            }

            $num++;
            $title = substr($title, 0, -2);
            $title .= '-'.$num; 
            return $title;
        }

        // add one to max number, this is the append number
        $num++;
        $title .= '-'.$num; 
        return $title;
    }




}