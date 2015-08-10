<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class sahadatabase_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct


    public function add( $info = '' )
    {

        $this->db->set( 'type', $info['type'] );
        $this->db->set( 'director', $info['director'] );
        $this->db->set( 'title', $info['title'] );
        $this->db->set( 'date', strtotime( set_time_to_strtotime( $info['date'] ) ) );
        $this->db->set( 'synopsis', $info['synopsis'] );
        $this->db->set( 'detail', $info['detail'] );
        $this->db->set( 'available', $info['available'] );
        $this->db->set( 'activity', $info['activity'] );
        $this->db->set( 'select_cover', $info['select_cover'] );
        $this->db->set( 'order_sort', $info['order_sort'] );

        // set data cover
        $data_cover_tmp = ( $info['select_cover'] == 1 ) ? $info['image_name_cover'] : $info['youtube_id_cover'] ;
        $this->db->set( 'data_cover', $data_cover_tmp );
        
        // generation code and set get in data
        $group_code = alphanumeric_rand(8);
        $this->db->set( 'group_poster_img', $group_code.'_poster' );
        $this->db->set( 'group_promotion_img', $group_code.'_promotion' );
        $this->db->set( 'group_gallery', $group_code.'_gallery' );
        $this->db->set( 'group_youtube', $group_code.'_youtube' );

        // set endcode slug url
        if ( ! empty( $info['slug'] ) ) 
        {
            // check data in table Do not repeat.
            $info['slug'] = $this->generate_slug( $info['slug'] );

            $this->db->set( 'slug', $info['slug'] );
            $this->db->set( 'slug_encode', md5( $info['slug'] ) );
        }
        else
        {
            // check data in table Do not repeat.
            $info['title'] = $this->generate_slug( $info['title'] );

            $this->db->set( 'slug', $info['title'] );
            $this->db->set( 'slug_encode', md5( $info['title'] ) );
        }

        $this->db->set( 'tag_keywords', $info['tag_keywords'] );
        $this->db->set( 'tag_description', $info['tag_description'] );

        $info['backgroud_image'] = ( ! empty( $info['backgroud_image'] ) ) ? $info['backgroud_image'] : '' ;
        $this->db->set( 'backgroud_image', $info['backgroud_image'] );

        $this->db->set( 'tab_color', $info['tab_color'] );

        $info['highlight'] = ( ! empty( $info['highlight'] ) ) ? 1 : 0 ;
        $this->db->set( 'highlight', $info['highlight'] );
        
        $info['status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $this->db->set( 'status', $info['status'] );
        $this->db->insert( 'sahadatabase' );

        // add gallery poster image
        if ( ! empty( $info['name_image_poster'] ) ) 
        {
            foreach ( $info['name_image_poster'] as $key => $value ) 
            {
                $this->db->set( 'name_image', $value );
                $this->db->set( 'group_gallery', $group_code.'_poster' );
                $this->db->set( 'type', 'poster' );
                $this->db->insert( 'sahadatabase_ref_images' );
            }
        }

        // add gallery promotion image
        if ( ! empty( $info['name_image_promotion'] ) ) 
        {
            foreach ( $info['name_image_promotion'] as $key => $value ) 
            {
                $this->db->set( 'name_image', $value );
                $this->db->set( 'group_gallery', $group_code.'_promotion' );
                $this->db->set( 'type', 'promotion' );
                $this->db->insert( 'sahadatabase_ref_images' );
            }
        }

        // add gallery gallery image
        if ( ! empty( $info['name_image'] ) ) 
        {
            foreach ( $info['name_image'] as $key => $value ) 
            {
                $this->db->set( 'name_image', $value );
                $this->db->set( 'group_gallery', $group_code.'_gallery' );
                $this->db->set( 'type', 'gallery' );
                $this->db->insert( 'sahadatabase_ref_images' );
            }
        }

        // add gallery youtube gallery
        if ( ! empty( $info['id_youtube'] ) ) 
        {
            foreach ( $info['id_youtube'] as $key => $value ) 
            {
                $this->db->set( 'id_youtube', $value );
                $this->db->set( 'group_youtube', $group_code.'_youtube' );
                $this->db->insert( 'sahadatabase_ref_youtube' );
            }
        }


    }

    // get data list  
    public function get_list( $show = 'admin' )
    {
        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status', 1 );
        }
        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'sahadatabase' );
        $data = $query->result();
        return $data;
    }    

    // get data one product
    public function get_data( $id = '' )
    {
        $this->db->where( 'id', $id );
        $query = $this->db->get( 'sahadatabase' );
        $output['data'] = $query->row();

        $output['data']->date = date( 'd/m/Y' , $output['data']->date );

        $this->db->select( 'name_image' );
        $this->db->where( 'group_gallery', $output['data']->group_poster_img );
        $this->db->where( 'type', 'poster' );
        $query = $this->db->get( 'sahadatabase_ref_images' );
        $poster = $query->result();

        // set array 
        $output['poster'] = array();
        foreach ( $poster as $key => $value ) 
        {
            $output['poster'][] = $value->name_image;
        }

        $this->db->select( 'name_image' );
        $this->db->where( 'group_gallery', $output['data']->group_promotion_img );
        $this->db->where( 'type', 'promotion' );
        $query = $this->db->get( 'sahadatabase_ref_images' );
        $promotion = $query->result();

        // set array 
        $output['promotion'] = array();
        foreach ( $promotion as $key => $value ) 
        {
            $output['promotion'][] = $value->name_image;
        }

        $this->db->select( 'name_image' );
        $this->db->where( 'group_gallery', $output['data']->group_gallery );
        $this->db->where( 'type', 'gallery' );
        $query = $this->db->get( 'sahadatabase_ref_images' );
        $gallery = $query->result();

        // set array 
        $output['gallery'] = array();
        foreach ( $gallery as $key => $value ) 
        {
            $output['gallery'][] = $value->name_image;
        }

        $this->db->select( 'id_youtube' );
        $this->db->where( 'group_youtube', $output['data']->group_youtube );
        $query = $this->db->get( 'sahadatabase_ref_youtube' );
        $youtube = $query->result();

        // set array 
        $output['youtube'] = array();
        foreach ( $youtube as $key => $value ) 
        {
            $output['youtube'][] = $value->id_youtube;
        }
        return $output;

    }

    // edit data 
    public function edit( $id = '' , $info = '' , $group_poster_img = '' , $group_promotion_img = '' , $group_gallery = '' , $group_youtube = ''   )
    {

        $this->db->set( 'type', $info['type'] );
        $this->db->set( 'director', $info['director'] );
        $this->db->set( 'title', $info['title'] );
        $this->db->set( 'date', strtotime( set_time_to_strtotime( $info['date'] ) ) );
        $this->db->set( 'synopsis', $info['synopsis'] );
        $this->db->set( 'detail', $info['detail'] );
        $this->db->set( 'available', $info['available'] );
        $this->db->set( 'activity', $info['activity'] );
        $this->db->set( 'select_cover', $info['select_cover'] );
        $this->db->set( 'order_sort', $info['order_sort'] );

        // set data cover
        $data_cover_tmp = ( $info['select_cover'] == 1 ) ? $info['image_name_cover'] : $info['youtube_id_cover'] ;
        $this->db->set( 'data_cover', $data_cover_tmp );
        
        // // generation code and set get in data
        // $group_code = alphanumeric_rand(8);
        // $this->db->set( 'group_poster_img', $group_code.'_poster' );
        // $this->db->set( 'group_promotion_img', $group_code.'_promotion' );
        // $this->db->set( 'group_gallery', $group_code.'_gallery' );
        // $this->db->set( 'group_youtube', $group_code.'_youtube' );

        // set endcode slug url
        if ( ! empty( $info['slug'] ) ) 
        {
            // check data in table Do not repeat.
            $info['slug'] = $this->generate_slug( $info['slug'] );

            $this->db->set( 'slug', $info['slug'] );
            $this->db->set( 'slug_encode', md5( $info['slug'] ) );
        }
        else
        {
            // check data in table Do not repeat.
            $info['title'] = $this->generate_slug( $info['title'] );

            $this->db->set( 'slug', $info['title'] );
            $this->db->set( 'slug_encode', md5( $info['title'] ) );
        }

        $this->db->set( 'tag_keywords', $info['tag_keywords'] );
        $this->db->set( 'tag_description', $info['tag_description'] );

        $info['backgroud_image'] = ( ! empty( $info['backgroud_image'] ) ) ? $info['backgroud_image'] : '' ;
        $this->db->set( 'backgroud_image', $info['backgroud_image'] );
        $this->db->set( 'tab_color', $info['tab_color'] );

        $info['highlight'] = ( ! empty( $info['highlight'] ) ) ? 1 : 0 ;
        $this->db->set( 'highlight', $info['highlight'] );
        
        $info['status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $this->db->set( 'status', $info['status'] );
        $this->db->update( 'sahadatabase' );

        // add gallery poster image
        $this->db->where( 'group_gallery', $group_poster_img );
        $this->db->where( 'type', 'poster' );
        $this->db->delete( 'sahadatabase_ref_images' );
        if ( ! empty( $info['name_image_poster'] ) ) 
        {
            foreach ( $info['name_image_poster'] as $key => $value ) 
            {
                $this->db->set( 'name_image', $value );
                $this->db->set( 'group_gallery', $group_poster_img );
                $this->db->set( 'type', 'poster' );
                $this->db->insert( 'sahadatabase_ref_images' );
            }
        }
        
        // add gallery promotion image
        $this->db->where( 'group_gallery', $group_promotion_img );
        $this->db->where( 'type', 'promotion' );
        $this->db->delete( 'sahadatabase_ref_images' );
        if ( ! empty( $info['name_image_promotion'] ) ) 
        {
            foreach ( $info['name_image_promotion'] as $key => $value ) 
            {
                $this->db->set( 'name_image', $value );
                $this->db->set( 'group_gallery', $group_promotion_img );
                $this->db->set( 'type', 'promotion' );
                $this->db->insert( 'sahadatabase_ref_images' );
            }
        }
        
        // add gallery gallery image
        $this->db->where( 'group_gallery', $group_gallery );
        $this->db->where( 'type', 'gallery' );
        $this->db->delete( 'sahadatabase_ref_images' );
        if ( ! empty( $info['name_image'] ) ) 
        {
            foreach ( $info['name_image'] as $key => $value ) 
            {
                $this->db->set( 'name_image', $value );
                $this->db->set( 'group_gallery', $group_gallery  );
                $this->db->set( 'type', 'gallery' );
                $this->db->insert( 'sahadatabase_ref_images' );
            }
        }

        // add gallery youtube gallery
        $this->db->where( 'group_youtube', $group_youtube );
        $this->db->delete( 'sahadatabase_ref_youtube' );
        if ( ! empty( $info['id_youtube']  ) ) 
        {
            foreach ( $info['id_youtube'] as $key => $value ) 
            {
                $this->db->set( 'id_youtube', $value );
                $this->db->set( 'group_youtube', $group_youtube );
                $this->db->insert( 'sahadatabase_ref_youtube' );
            }
        }



    }

    // delete data
    public function delete( $id = '')
    {

        // get data id code grup gallery and group youtube
        $this->db->select( 'group_poster_img , group_promotion_img , group_gallery , group_youtube' );
        $this->db->where( 'id', $id );
        $query = $this->db->get( 'sahadatabase' );
        $data_code = $query->row();

        $this->db->where( 'group_gallery', $data_code->group_poster_img );
        $this->db->where( 'type', 'poster' );
        $this->db->delete( 'sahadatabase_ref_images' );
        // end delete image group
        $this->db->where( 'group_gallery', $data_code->group_promotion_img );
        $this->db->where( 'type', 'promotion' );
        $this->db->delete( 'sahadatabase_ref_images' );
        // end delete image group
        $this->db->where( 'group_gallery', $data_code->group_gallery );
        $this->db->where( 'type', 'gallery' );
        $this->db->delete( 'sahadatabase_ref_images' );
        // end delete image group

        $this->db->where( 'group_youtube', $data_code->group_youtube );
        $this->db->delete( 'sahadatabase_ref_youtube' ); 
        // end delete id youtube

        $this->db->where( 'id', $id );
        $this->db->delete( 'sahadatabase' );
        // end delete data content

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


    public function get_director()
    {
        $this->db->select( 'director' );
        $query = $this->db->get( 'sahadatabase' );
        $array = $query->result();
        $str = '';
        if (! empty( $array ) ) 
        {
            $array_key = end(array_keys( $array ));
            
            foreach ( $array as $key => $value ) 
            {
                $str .= '"'.$value->director.'"';
                if ( $array_key != $key ) 
                {
                    $str .= ', ';
                }
            }
        }

       return $str;
    }




}