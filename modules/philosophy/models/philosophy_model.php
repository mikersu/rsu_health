<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class philosophy_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct
	
    public function get_category( $id = '' , $type = 'object' )
    {
		if($id!='')
	    $this->db->where( 'id', $id );
		
        $query = $this->db->get( 'philosophy_category' );
        if ( $type == 'object' ) 
        {
            $data = $query->row();
        }
        else
        {
            $data = $query->row_array();
        }
        return $data;
    
    } // END FUNCTION get_category
	
    public function add_category($info ,$id = '')
    {
		
		if($id==''){
        // INSERT DATA get_category
        $this->db->insert( 'philosophy_category', $info );
        $id = $this->db->insert_id();
		}else{
        $this->db->where( 'id', $id );
        // UPDATE DATA get_category
        $this->db->update( 'philosophy_category', $info );
		}


        return $id;
    
    } // END FUNCTION add_category	
	
    public function list_category( $language_id = '' , $type = 'object' )
    {
    
        $this->db->where( 'language_id', $language_id );
        $query = $this->db->get( 'philosophy_category' );

        if ( $type == 'object' ) 
        {
            $data = $query->result();
        }
        else
        {
            $data = $query->result_array();
        }

        return $data;
    
    } // END FUNCTION list_category
	
    public function del_category( $id = '')
    {
    
        $this->db->where( 'id', $id );
        $this->db->delete( 'philosophy_category' );
    
    } // END FUNCTION del_category	

	public function get_subcategory( $id = '' , $type = 'object' )
    {
		if($id!='')
	    $this->db->where( 'id', $id );
        $query = $this->db->get( 'philosophy_subcategory' );
        if ( $type == 'object' ) 
        {
            $data = $query->row();
        }
        else
        {
            $data = $query->row_array();
        }
        return $data;		
    
    } // END FUNCTION get_category
	
    public function add_subcategory($info ,$id = '')
    {
		
		if($id==''){
        // INSERT DATA get_subcategory
        $this->db->insert( 'philosophy_subcategory', $info );
        $id = $this->db->insert_id();
		}else{
        $this->db->where( 'id', $id );
        // UPDATE DATA get_subcategory
        $this->db->update( 'philosophy_subcategory', $info );
		}


        return $id;
    
    } // END FUNCTION add_category	
	
    public function list_subcategory( $language_id = '' , $type = 'object' )
    {
    
        $this->db->where( 'language_id', $language_id );
        $query = $this->db->get( 'philosophy_subcategory' );

        if ( $type == 'object' ) 
        {
            $data = $query->result();
        }
        else
        {
            $data = $query->result_array();
        }

        return $data;
    
    } // END FUNCTION list_subcategory
	
    public function del_subcategory( $id = '')
    {
    
        $this->db->where( 'id', $id );
        $this->db->delete( 'philosophy_subcategory' );
    
    } // END FUNCTION del_category

	
    public function get_gallery( $id = '' , $type = 'object' )
    {
    
        $this->db->where( 'gallery_id', $id );
        $query = $this->db->get( 'philosophy_gallery' );

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


    public function add( $info = '' )
    {

        $status = ( ! empty( $info['status'] ) ) ? $info['status'] : '' ;

        $title = ( ! empty( $info['slug'] ) ) ? $info['slug'] : reset($info['title']) ;
        $slug = $this->generate_slug( $title );

        $this->db->set( 'slug', $slug );
        $this->db->set( 'hash', md5($slug) );
        // $this->db->set( 'image', $info['image'] );
        $this->db->set( 'insert_date', strtotime( 'now' ) );
        $this->db->set( 'status', $status );
        $this->db->insert( 'philosophy_config' );

        $last_id = $this->db->insert_id();

        foreach ( $info['title'] as $key => $value ) {
            $this->db->set( 'title', $value );
            $this->db->set( 'detail', $info['detail'][$key] );
            $this->db->set( 'language_id', $key );
            $this->db->set( 'philosophy_id', $last_id );
            $this->db->insert( 'philosophy_detail' );

        }

        if ( ! empty( $info['name_image'] ) ) {
            foreach ( $info['name_image'] as $key => $value ) {
                $this->db->set( 'philosophy_id', $last_id );
                $this->db->set( 'image', $value );
                $this->db->insert( 'philosophy_gallery' );
            }
        }


        return $last_id;


    }

    // edit data 
    public function edit( $id = '' , $info = '' )
    {

        $status = ( ! empty( $info['status'] ) ) ? $info['status'] : '0' ;

        $title = ( ! empty( $info['slug'] ) ) ? $info['slug'] : reset($info['title']) ;
        $slug = $this->generate_slug( $title , $id );

        $this->db->where( 'id', $id );
        $this->db->set( 'slug', $slug );
        $this->db->set( 'hash', md5($slug) );
        // $this->db->set( 'image', $info['image'] );
        $this->db->set( 'status', $status );
        $this->db->update( 'philosophy_config' );

        foreach ( $info['title'] as $key => $value ) {
            $this->db->set( 'title', $value );
            $this->db->set( 'description', $info['description'][$key] );
            $this->db->set( 'detail', $info['detail'][$key] );
            $this->db->where( 'language_id', $key );
            $this->db->where( 'philosophy_id', $id );
            $this->db->update( 'philosophy_detail' );

        }


        $this->db->where( 'philosophy_id', $id );
        $this->db->delete( 'philosophy_gallery' );

        if ( ! empty( $info['name_image'] ) ) {


            foreach ( $info['name_image'] as $key => $value ) {
                $this->db->set( 'philosophy_id', $id );
                $this->db->set( 'image', $value );
                $this->db->insert( 'philosophy_gallery' );
            }
        }


        return $id;

    }



    // get data list  
    public function get_list()
    {
        $lang = $this->lang_model->get_lang_default();    

        $this->db->from( 'philosophy_config AS nc' );
        $this->db->join( 'philosophy_detail AS nd', 'nc.id = nd.philosophy_id', 'left' );
        $this->db->where( 'nd.language_id', $lang );
        $this->db->order_by( 'order_sort', 'ASC' );
        $this->db->order_by( 'nc.id', 'DESC' );
        $this->db->select( 'nc.* , nd.* , nc.id AS id' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;


    }    



    // get data list  
    public function get_total( $show = 'admin' , $string = '' )
    {
        $this->db->from( 'philosophy' );

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status !=', 0 );
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
    public function get_data( $id = '' )
    {
        $this->db->where( 'id', $id );
        $query = $this->db->get( 'philosophy_config' );
        $data_config = $query->row();

        $this->db->where( 'philosophy_id', $id );
        $query = $this->db->get( 'philosophy_detail' );
        $data = $query->result();


        $this->db->where( 'philosophy_id', $id );
        $query = $this->db->get( 'philosophy_gallery' );
        $data_gallery = $query->result();



        $info = array();

        foreach ( $data as $key => $value ) {
            $info['title'][$value->language_id] = $value->title;
            $info['description'][$value->language_id] = $value->description;
            $info['detail'][$value->language_id] = $value->detail;
        }


        $info['image'] = $data_config->image;
        $info['select_cover'] = $data_config->select_cover;
        $info['philosophy_date'] = date( 'd/m/Y' , $data_config->philosophy_date );
        $info['status'] = $data_config->status;
        $info['youtube_id'] = $data_config->youtube_id;
        $info['file_video'] = $data_config->file_video;
        $info['slug'] = $data_config->slug;

        foreach ( $data_gallery as $key => $value ) {
            $info['name_image'][] = $value->image;
        }

        return $info;


    }


    // delete data
    public function delete( $id = '')
    {
        $this->db->where( 'id', $id );
        $this->db->delete( 'philosophy' );

        $this->db->where( 'gallery_id', $id );
        $this->db->delete( 'philosophy_gallery' );

    }



    public function update_view( $id = '' )
    {
        $this->db->where( 'id', $id );
        $this->db->set('over_view', '`over_view`+1', FALSE);
        $this->db->update( 'philosophy' );
    }



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
        $items = $this->db->select( 'slug' )
        ->where('slug REGEXP BINARY \'^'.$this->db->escape_like_str($title).'(-[0-9]+)?$\'', NULL, FALSE)
        ->order_by( 'LENGTH(slug)', 'desc' )
        ->order_by( 'slug', 'desc' )
        ->get( 'philosophy_config' )
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