<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class seotag_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct

    // add
    public function add( $info = '' )
    {

    }


    // get data list  
    public function this_tag( $module_name = '' , $id = '' , $language_id = '' )
    { 
        $this->db->select( 'tag_name , value' );
        $this->db->where( 'module_name', $module_name );
        $this->db->where( 'id_item', $id );
        // $this->db->where( 'tag_name', $tag_name );
        $this->db->where( 'language_id', $language_id );
        $query = $this->db->get( 'seotag' );
        $data = $query->result();

        // $output = new stdClass();

        // $output->tag_name = ( ! empty( $data->tag_name ) ) ? $data->tag_name : '' ;
        // $output->value = ( ! empty( $data->value ) ) ? $data->value : '' ;   
        
        return $data;   

    }    

    // get data one product
    public function get_data( $module_name = '' , $id = '' )
    {

        $this->db->where( 'module_name', $module_name );
        $this->db->where( 'id_item', $id );
        // $this->db->where( 'tag_name', $tag_name );
        // $this->db->where( 'language_id', $language_id );
        $query = $this->db->get( 'seotag' );
        $data = $query->result();

        // $output = new stdClass();

        // $output->tag_name = ( ! empty( $data->tag_name ) ) ? $data->tag_name : '' ;
        // $output->value = ( ! empty( $data->value ) ) ? $data->value : '' ;   
        
        return $data;            

    }

    // edit data 
    public function edit_seotag( $module_name = '' , $id = '' , $data = '' )
    {


        foreach ( $data['seotag'] as $key => $value ) 
        {
            $this->db->where( 'id_item', $id );
            $this->db->where( 'module_name', $module_name );
            $this->db->where( 'language_id', $key );
            $this->db->delete( 'seotag' );

            foreach ( $value as $tag_name => $value_data ) 
            {
                $this->db->set( 'module_name', $module_name );
                $this->db->set( 'id_item', $id );
                $this->db->set( 'tag_name', $tag_name );
                $this->db->set( 'value', $value_data );
                $this->db->set( 'language_id', $key );
                $this->db->insert( 'seotag' );
            }


        }

    }

    // delete data
    public function delete( $id = '')
    {

    }

    // check url slug in database has empty
    public function check_slug_empty( $info = '' )
    {
        $this->db->where( 'slug', $info );
        $query = $this->db->get( 'seotag' );
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
        $query = $this->db->get( 'seotag' );
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
        $items = $this->db->select( 'slug' )->like( 'slug', $title , 'right')->get( 'seotag' )->result();

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




}