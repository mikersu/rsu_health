<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class service_model extends CI_Model 
{

    function __construct() 
    {
        parent::__construct(); 
    }// __construct


    public function add_category( $data = array() ) {

        $string_image = json_encode( $data['image_logo'] );
        $status = ( ! empty( $data['status'] ) ) ? 1 : 0 ;

        $this->db->set( 'image', $string_image );
        $this->db->set( 'status', $status );
        $this->db->insert( 'service_category' );        
        
    }// END add_category 


    public function list_category() {
        
        $this->db->order_by( 'order_sort', 'ASC' );
        $this->db->order_by( 'id', 'desc' );
        $query = $this->db->get( 'service_category' );
        $data = $query->result();
        
        return $data;

    }// END list_category 


    public function get_category($id = '') {
    
        $this->db->where( 'id', $id );
        $query = $this->db->get( 'service_category' );
        $data = $query->row_array();
        
        $data_image = ( ! empty( $data['image'] ) ) ? json_decode($data['image']) : array() ;
        $array_image = array();
        foreach ( $data_image as $key => $value ) {
            $array_image[] = $value;
        }
        $data['image_logo'] = $array_image;

        return $data;

    }// END get_category 


    public function edit_category( $data = array() , $id = '' ) {
    
        $string_image = json_encode( $data['image_logo'] );
        $status = ( ! empty( $data['status'] ) ) ? 1 : 0 ;

        $this->db->where( 'id', $id );
        $this->db->set( 'image', $string_image );
        $this->db->set( 'status', $status );
        $this->db->update( 'service_category' );     
    
    }// END edit_category 

    // // check url slug in database has empty
    // public function check_slug_empty( $info = '' )
    // {
    //     $this->db->where( 'slug', $info );
    //     $query = $this->db->get( 'content' );
    //     $data = $query->result();

    //     if ( ! empty( $data ) ) 
    //     {
    //         return count( $data );
    //     }

    //     return 0;

    // }

    // // chek slug have in id it
    // public function check_slug( $id = '' , $info = '' )
    // {
    //     $this->db->where( 'id', $id );
    //     $this->db->where( 'slug', $info );
    //     $query = $this->db->get( 'content' );
    //     $data = $query->result();
    //     if ( ! empty( $data ) ) 
    //     {
    //         return FALSE;
    //     }
    //     return TRUE;
    // }


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



    public function add_management_data( $info = '' ) {
    
        $status = ( ! empty( $info['status'] ) ) ? $info['status'] : 0 ;
        $this->db->set( 'status', $status );
        $this->db->set( 'image', $info['image'] );
        $this->db->set( 'ref_category_id', $info['category_id'] );
        $this->db->insert( 'service_category_gallery_config' );
        $id = $this->db->insert_id();

        foreach ( $info['title'] as $key => $value ) {
            $this->db->set( 'title', $value );
            $this->db->set( 'detail', $info['detail'][$key] );
            $this->db->set( 'language_id', $key );
            $this->db->set( 'ref_id_gallery', $id );
            $this->db->insert( 'service_category_gallery_detail' );
        }

    }// END add_management_data 


    public function get_list_item( $category = '' ) {
    
        $default_lang = $this->lang_model->get_lang_default();

        $this->db->from( 'service_category_gallery_config AS scgc' );
        $this->db->join( 'service_category_gallery_detail AS scgd', 'scgc.id = scgd.ref_id_gallery', 'left' );
        $this->db->select( 'scgc.* , scgd.* , scgc.id AS id' );
        $this->db->where( 'scgc.ref_category_id', $category );
        $this->db->where( 'scgd.language_id', $default_lang );
        $this->db->order_by( 'scgc.order_sort', 'ASC' );
        $this->db->order_by( 'scgc.id', 'desc' );

        $query = $this->db->get();
        $data = $query->result();

        return $data;

    }// END get_list_item 


    public function detail_list_item( $id = '' ) {
    
        $this->db->where( 'id', $id );
        $query = $this->db->get( 'service_category_gallery_config' );
        $data = $query->row_array();

        $this->db->where( 'ref_id_gallery', $id );
        $query = $this->db->get( 'service_category_gallery_detail' );
        $data_detail = $query->result();

        foreach ( $data_detail as $key => $value ) {
            $data['title'][$value->language_id] = $value->title;
            $data['detail'][$value->language_id] = $value->detail; 
        }

        return $data;
        
    }// END detail_list_item 

    public function edit_management_data( $info = array() ,  $id = '' ) {
    
        $status = ( ! empty( $info['status'] ) ) ? $info['status'] : 0 ;
        $this->db->set( 'status', $status );
        $this->db->set( 'image', $info['image'] );
        $this->db->where( 'id', $id );
        $this->db->update( 'service_category_gallery_config' );

        foreach ( $info['title'] as $key => $value ) {
            $this->db->set( 'title', $value );
            $this->db->set( 'detail', $info['detail'][$key] );
            $this->db->where( 'language_id', $key );
            $this->db->where( 'ref_id_gallery', $id );
            $this->db->update( 'service_category_gallery_detail' );
        }
        
    }// END edit_management_data 


}