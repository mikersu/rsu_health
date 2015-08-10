<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class fhome_model extends CI_Model 
{

    function __construct() {
        parent::__construct();
    }// __construct


    public function list_slider( $language_id = 1 ) {
    
        $this->db->from( 'home_slider_config AS hsc' );
        $this->db->join( 'home_slider_detail AS hsd', 'hsc.id = hsd.ref_id', 'left' );
        $this->db->select( 'hsc.* , hsd.* , hsc.id AS id' );
        $this->db->where( 'hsd.language_id', $language_id );
        $this->db->where( 'hsc.status', 1 );
        $this->db->order_by( 'hsc.order_sort', 'ASC' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;
        
    }// END list_slider 

    public function get_product( $language_id = 1 ) {
    
        $this->db->from( 'products_config AS pc' );
        $this->db->join( 'products_detail AS pd', 'pc.id = pd.product_id', 'left' );
        $this->db->where( 'pc.status', 1 );
        $this->db->where( 'pd.language_id', $language_id );
        $this->db->order_by( 'pc.id', 'desc' );
        $this->db->select( 'pc.* , pd.* ,pc.id AS id' );
        $query = $this->db->get();
        $data = $query->row();

        return $data;
        
    }// END get_product 

    public function get_news( $id = '' , $language_id = 1 ) {
    
        $this->db->from( 'event_config AS ec' );
        $this->db->join( 'event_detail AS ed', 'ec.id = ed.event_id', 'left' );
        $this->db->where( 'ec.status', 1 );
        $this->db->select( 'ec.* , ed.* , ec.id AS id' );
        $this->db->where( 'ed.language_id', $language_id );
        $this->db->where( 'ec.id', $id );
        $query = $this->db->get();
        $data = $query->row();

        return $data;
        
    }// END get_news 

    public function logo_list() {
    
        $this->db->where( 'status', 1 );
        $query = $this->db->get( 'banner_logo' );
        $data = $query->result();
        return $data;
        
    }// END logo_list 



    public function get_product_gallery( $id = '' ) {
    
        $this->db->where( 'product_id', $id );
        $query = $this->db->get( 'product_gallery' );
        $data = $query->result();

        return $data;
        
    }// END get_product_gallery 


    public function list_news( $type = '' , $language_id = 1 ) {
    

        $this->db->from( 'event_config AS ec' );
        $this->db->join( 'event_detail AS ed', 'ec.id = ed.event_id', 'left' );
        $this->db->where( 'category_id', $type );
        $this->db->where( 'status', 1 );
        $this->db->where( ' ( ec.end_date > '. strtotime( 'now' ) . 
                 ' OR ec.end_date = 0 ) ', false , false );
        $this->db->where( ' ( ec.start_date < '. strtotime( 'now' ) . 
                 ' OR ec.start_date = 0 ) ', false , false );
        $this->db->where( 'ed.language_id', $language_id );
        $this->db->select( 'ec.*,ed.* , ec.id AS id' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;

    }// END list_news 


    public function list_banner() {
    
        $this->db->order_by( 'id', 'ASC' );
        $query = $this->db->get( 'banner_logo' );
        $data = $query->result();
        return $data;
        
    }// END list_banner 

    public function add_banner_list($info= array()) {
    
        $this->db->truncate('banner_logo'); 

        foreach ( $info['image_name_gallery'] as $key => $value ) {
            
            $this->db->set( 'image', $value );
            $this->db->set( 'link', $info['image_title_gallery'][$key] );
            $this->db->insert( 'banner_logo' );
        }
        
    }// END add_banner_list 


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

        return $data;
    }    

	

    // get data media  
    public function get_media()
    {
		$this->db->where( 'status', 1 );
        $this->db->order_by( 'order_sort', 'ASC' );
		$this->db->limit(1 ,0);
        $query = $this->db->get( 'media' );
        $data = $query->result();
        return $data;
    } 


	// get data social  
    public function get_social()
    {
		$this->db->where( 'status', 1 );
        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'social' );
        $data = $query->result();
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
        $this->db->where( 'language_id', $this->session->userdata( 'lang' ) );
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
	public function product_list(){


        $this->db->from( 'products_config AS pc' );
        $this->db->join( 'products_detail AS pd', 'pc.id = pd.product_id', 'left' );
        $this->db->where( 'pc.status', 1 );
        $this->db->where( 'pd.language_id', $this->session->userdata( 'lang' ) );
        $this->db->order_by( 'pc.order_sort , pc.id', 'ASC' );
        $this->db->select( 'pc.* , pd.* ,pc.id AS id' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;




    }
	
	public function get_category_list()
    {

        $this->db->from( 'products_category_config AS pcc' );
        $this->db->join( 'products_category_detail AS pcd', 'pcc.id = pcd.category_id', 'left' );
        $this->db->where( 'pcc.status', 1 );
        $this->db->where( 'pcd.language_id', $this->session->userdata( 'lang' ) );
        $this->db->order_by( 'pcc.order_sort , pcc.id', 'ASC' );
        $this->db->select( 'pcc.* , pcd.* , pcc.id AS id' );
        $query = $this->db->get();
        $data = $query->result();

        return $data;

    }
	public function marketing_list(){

        $this->db->from( 'event_config AS ec' );
        $this->db->join( 'event_detail AS ed', 'ec.id = ed.event_id', 'left' );
        $this->db->where( 'ec.status', 1 );
        $this->db->where( 'ed.language_id', $this->session->userdata( 'lang' ) );
        $this->db->order_by( 'ec.order_sort , ec.id', 'ASC' );
        $this->db->select( ' ec.*, ed.* , ec.id AS id' );
        $this->db->limit(5);
        $query = $this->db->get();
        $data = $query->result();

        return $data;


    }
	public function news_list(){

        $this->db->from( 'news_config AS nc' );
        $this->db->join( 'news_detail AS nd', 'nc.id = nd.news_id', 'left' );
        $this->db->where( 'nc.status', 1 );
        $this->db->where( 'nd.language_id', $this->session->userdata( 'lang' ) );
        $this->db->order_by( 'nc.order_sort , nc.id', 'ASC' );
        $this->db->select( ' nc.*, nd.* , nc.id AS id' );
        $this->db->limit(5);
        $query = $this->db->get();
        $data = $query->result();


        return $data;


    }
	
	public function get_gallery( $id = '' , $type = 'object' ){
    
        $this->db->where( 'news_id', $id );
		$this->db->limit(2 ,0);
        $query = $this->db->get( 'news_gallery' );

        if ( $type == 'object' ){
            $data = $query->result();
        }else{
            $data = $query->result_array();
        }

        return $data;
    
    } // END FUNCTION get_gallery
}