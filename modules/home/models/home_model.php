<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class home_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct

    public function add( $info = '' )
    {

        $info['insert_date'] = strtotime( 'now' );
        // INSERT DATA home
        $this->db->insert( 'home', $info );

        // INSERT DATA IMAGE GALLERY
        $id = $this->db->insert_id();

        return $id;

    }

    // edit data 
    public function edit( $id = '' , $info = '' )
    {

        $this->db->where( 'id', $id );

        if ( empty( $info['youtube_id'] ) ) 
        {
            $info['youtube_id'] = '';
        }

        // UPDATE DATA home
        $this->db->update( 'home', $info ); 

    }



    // get data list  
    public function get_list( $language_id = '' , $show = 'admin' , $limit_page = '' , $start = 0 , $string = '' )
    {

        $this->db->where( 'language_id', $language_id );

        if ( $show != 'admin' ) 
        {
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
            $this->db->like( 'title', $string );
        }
        $this->db->order_by( 'id', 'desc' );
        $query = $this->db->get( 'home' );
        $data = $query->result();
        // echo $this->db->last_query();
        // die();
        return $data;
    }    



    // get data list  
    public function get_total( $show = 'admin' , $string = '' )
    {
        $this->db->from( 'home' );
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

        $this->db->where( 'id', $id );
        $query = $this->db->get( 'home' );
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


    // delete data
    public function delete( $id = '')
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'home' );

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
        $items = $this->db->select( 'slug' )->like( 'slug', $title , 'right')->get( 'content' )->result();

        // not found, we can use it
        if (empty($items))
        {
            return $title;
        }
        
        // start number tracking
        $number = 0;
        
        // find the most value number
        foreach ($items as $item)
        {
            if (preg_match('~^'.preg_quote($title).'-(?<number>\d+)$~', $item->slug, $match))
            {
                if ($match['number'] > $number)
                {
                    $number = $match['number'];
                }
            }
        }
        
        // add one to max number, this is the append number
        $number++;
        
        $title .= '-'.$number;
        
        return $title;
    }


    public function add_slider( $info = array() ) {
    
        $image = ( ! empty( $info['image'] ) ) ? $info['image'] : '' ;
        $link = ( ! empty( $info['link'] ) ) ? $info['link'] : '' ;
        $status = ( ! empty( $info['status'] ) ) ? $info['status'] : '0' ;

        $this->db->set( 'image', $image );
        $this->db->set( 'link', $link );
        $this->db->set( 'status', $status );
        $this->db->insert( 'home_slider_config' );
        $id = $this->db->insert_id();

        foreach ( $info['title'] as $key => $value ) {
            $this->db->set( 'ref_id', $id );
            $this->db->set( 'language_id', $key );
            $this->db->set( 'title', $value );
            $this->db->set( 'detail', $info['detail'][$key] );
            $this->db->insert( 'home_slider_detail' );
        }

        return true;
        
    }// END add_slider 


    public function edit_slider( $id = '' , $info = array() ) {
    
        $image = ( ! empty( $info['image'] ) ) ? $info['image'] : '' ;
        $link = ( ! empty( $info['link'] ) ) ? $info['link'] : '' ;
        $status = ( ! empty( $info['status'] ) ) ? $info['status'] : '0' ;

        $this->db->where( 'id', $id );
        $this->db->set( 'image', $image );
        $this->db->set( 'link', $link );
        $this->db->set( 'status', $status );
        $this->db->update( 'home_slider_config' );

        foreach ( $info['title'] as $key => $value ) {
            $this->db->where( 'ref_id', $id );
            $this->db->where( 'language_id', $key );
            $this->db->set( 'title', $value );
            $this->db->set( 'detail', $info['detail'][$key] );
            $this->db->update( 'home_slider_detail' );
        }

        return true;    
        
    }// END edit_slider 

    public function list_slider( $language_id = 1 ) {
    
        $this->db->from( 'home_slider_config AS hsc' );
        $this->db->join( 'home_slider_detail AS hsd', 'hsc.id = hsd.ref_id', 'left' );
        $this->db->select( 'hsc.* , hsd.* , hsc.id AS id' );
        $this->db->order_by( 'order_sort', 'ASC' );
        $this->db->where( 'hsd.language_id', $language_id );
        $query = $this->db->get();
        $data = $query->result();
        
        return $data = ( ! empty( $data ) ) ? $data : array() ;

    }// END list_slider 


    public function get_slider($id = '') {
   
        $this->db->from( 'home_slider_config AS hsc' );
        $this->db->join( 'home_slider_detail AS hsd', 'hsc.id = hsd.ref_id', 'left' );
        $this->db->select( 'hsc.* , hsd.* , hsc.id AS id' );
        $this->db->where( 'hsc.id', $id );
        $query = $this->db->get();
        $data = $query->result();
        return $data;
        
    }// END get_slider 



}