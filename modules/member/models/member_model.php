<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class member_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct


    public function add( $info = '' )
    {

        // load date helper for gmt
        $this->load->helper( 'date' );
        
        // set new values for add to db
        $data['account_password'] = $this->encrypt_password( $info['account_password'] );
        $data['account_birthdate'] = ( ! empty( $info['account_birthdate'] ) ) ? $info['account_birthdate'] : '' ;
        $data['gender'] = ( ! empty( $info['gender'] ) ) ? $info['gender'] : '' ;
        $data['account_create'] = date( 'Y-m-d H:i:s', time() );
        $data['account_create_gmt'] = date( 'Y-m-d H:i:s', local_to_gmt( time() ) );
        $data['account_status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $data['account_avatar'] = ( ! empty( $info['account_avatar'] ) ) ? $info['account_avatar'] : '' ;
        $data['account_email'] = ( ! empty( $info['account_email'] ) ) ? $info['account_email'] : '' ;
        $data['account_username'] = ( ! empty( $info['account_email'] ) ) ? $info['account_email'] : '' ;
        $data['account_fullname'] = ( ! empty( $info['account_fullname'] ) ) ? $info['account_fullname'] : '' ;
        $data['nickname'] = ( ! empty( $info['nickname'] ) ) ? $info['nickname'] : '' ;
        // add to db
        $this->db->insert( 'accounts', $data );
        
        // get account id
        $account_id = $this->db->insert_id();
        
        // add level
        $this->db->set( 'level_group_id', '3' );
        $this->db->set( 'account_id', $account_id );
        $this->db->insert( 'account_level' );
        
        // any APIs add here.
        // $this->modules_plug->do_action( 'account_register', $data );


    }

    // get data list  
    public function get_list( $show = 'admin' , $generation = '' , $business_type = '' , $string = '' , $sex = '' )
    {
        $this->db->from( 'accounts AS a' );
        $this->db->join( 'account_level AS al', 'a.account_id = al.account_id', 'left' );
        $this->db->where( 'al.level_group_id', 3 );

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'a.account_status', 1 );
        }
        $this->db->order_by( 'a.account_id', 'desc' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }   

    // get data list  
    public function get_list_admin(  )
    {
        $this->db->from( 'accounts AS a' );
        $this->db->join( 'account_level AS al', 'a.account_id = al.account_id', 'left' );
        $this->db->where( 'al.level_group_id !=', 3 );
        $this->db->where( 'a.account_id !=', 0 );
        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }        

    // get data one product
    public function get_data( $id = '' )
    {
        $this->db->from( 'accounts' );
        $this->db->where( 'account_id', $id );
        $query = $this->db->get();
        $data = $query->row_array();

        return $data;
    }

    // edit data 
    public function edit( $id = '' , $info = '' )
    {

        // load date helper for gmt
        $this->load->helper( 'date' );
        
        // set new values for add to db

        if ( ! empty( $info['account_password'] ) ) 
        {
            $info['account_password'] = $this->encrypt_password( $info['account_password'] );
        }
        else
        {
            unset( $info['account_password'] );
        }

        $info['account_username'] = $info['account_email'];

        $info['account_status'] = ( ! empty( $info['account_status'] ) ) ? 1 : 1 ;

        $data['account_email'] = ( ! empty( $info['account_email'] ) ) ? $info['account_email'] : '' ;

        // add to db


        $this->db->where( 'account_id', $id );
        $this->db->update( 'accounts', $info );
    }

    // delete data
    public function delete( $id = '')
    {
        $this->db->where( 'account_id', $id );
        $this->db->delete( 'accounts' );

        $this->db->where( 'account_id', $id );
        $this->db->delete( 'account_level' );

        $this->db->where( 'account_id', $id );
        $this->db->delete( 'accounts_detail' );

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


    /**
     * encrypt_password
     * @param string $password
     * @return string
     */
    function encrypt_password( $password = '' ) {
        $this->load->library( 'encrypt' );
        return $this->encrypt->sha1( $this->config->item( 'encryption_key' ).'::'.$this->encrypt->sha1( $password ) );
    }// encrypt_password


    public function check_email( $email = '' , $id = '')
    {
        $this->db->where( 'account_id !=', $id );
        $this->db->where( 'account_email', $email );
        $query = $this->db->get( 'accounts' );
        $data = $query->result();
        if ( ! empty( $data ) ) 
        {
           return true;
        }

        return false;
    }


    public function generation_add( $info = '' )
    {
        $data['status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $data['generation_name'] = ( ! empty( $info['generation_name'] ) ) ? $info['generation_name'] : '' ;
        $data['order_sort'] = ( ! empty( $info['order_sort'] ) ) ? (int)$info['order_sort'] : 0 ;
        $this->db->insert( 'generation' , $data );
    }

    public function generation_edit( $id = '' , $info = '' )
    {

        $this->db->where( 'id', $id );
        $data['status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $data['generation_name'] = ( ! empty( $info['generation_name'] ) ) ? $info['generation_name'] : '' ;
        $data['order_sort'] = ( ! empty( $info['order_sort'] ) ) ? (int)$info['order_sort'] : 0 ;    
        $this->db->update( 'generation' , $data );
    }

    public function generation_list( $id = '' , $show = 'admin' )
    {
        if ( ! empty( $id ) ) 
        {
            $this->db->where( 'id', $id );
        }

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status', 1 );
        }

        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'generation' );

        $data = $query->result();

        return $data;

    }




    public function business_type_add( $info = '' )
    {

        $data['status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $data['business_type_name'] = ( ! empty( $info['business_type_name'] ) ) ? $info['business_type_name'] : '' ;
        $data['order_sort'] = ( ! empty( $info['order_sort'] ) ) ? (int)$info['order_sort'] : 0 ;
        $this->db->insert( 'business_type' , $data );
    }

    public function business_type_edit( $id = '' , $info = '' )
    {
        $this->db->where( 'id', $id );
        $data['status'] = ( ! empty( $info['status'] ) ) ? 1 : 0 ;
        $data['business_type_name'] = ( ! empty( $info['business_type_name'] ) ) ? $info['business_type_name'] : '' ;
        $data['order_sort'] = ( ! empty( $info['order_sort'] ) ) ? (int)$info['order_sort'] : 0 ;
        $this->db->update( 'business_type' , $data );
    }

    public function business_type_list( $id = '' , $show = 'admin' )
    {
        if ( ! empty( $id ) ) 
        {
            $this->db->where( 'id', $id );
        }

        if ( $show != 'admin' ) 
        {
            $this->db->where( 'status', 1 );
        }
        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'business_type' );

        $data = $query->result();

        return $data;

    }




    public function front_edit_member( $id = '' , $info = '' )
    {
        if ( empty( $id ) OR empty( $info ) ) 
        {
            return false;
        }

        if ( ! empty( $info['password'] ) ) 
        {
            $data['account_password'] = $this->encrypt_password( $info['password'] );
        }

        if ( ! empty( $info['account_avatar'] ) ) 
        {
            $data['account_avatar'] = $this->encrypt_password( $info['account_avatar'] );
        }

        $this->db->where( 'account_id', $id );
        $this->db->update( 'accounts', $data );



        $set['facebook'] = $info['facebook'];
        $set['mobile_phone'] = $info['mobile_phone'];
        $set['phone'] = $info['phone'];
        $set['fax'] = $info['fax'];
        $set['address'] = $info['address'];

        $this->db->where( 'account_id', $id );
        $this->db->update( 'accounts_detail', $set );


    }


    public function get_total_webboard( $id = '' )
    {
       // $data_account = $this->account_model->get_account_cookie( 'member' );
       $this->db->where( 'account_id', $id );
       $this->db->where( 'sub_id', 0 );
       $this->db->where( 'status', 1 );
       $query = $this->db->get( 'webboard' );
       $num_row = $query->num_rows();

       return $num_row;



    }


    public function get_type( $id = '' )
    {
        
        $this->db->where( 'ref_id_config', $id );
        $query = $this->db->get( 'type_setting_detail' );
        $data = $query->row();
        return $data;
    
    } // END FUNCTION get_member_type






}