<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */

class index extends MY_Controller {
	
	
	function __construct() {
		parent::__construct();
		
		// load model
		//$this->load->model( array( 'posts_model' , 'account_model' ) );
		
		// set post_type
		//$this->posts_model->post_type = 'article';
		
		// load helper
		$this->load->helper( array( 'date', 'language' ) );
		
		// load language
		$this->lang->load( 'post' );

	}// __construct
	
	
	// function _remap( $att1 = '' ) {
	// 	if ( is_numeric( $att1 ) || $att1 == null || $att1 == 'index' ) {
	// 		$this->index();
	// 	}
	// }// _remap
	
	
/*	function index() {


		redirect( site_url( 'home' ) );

		// get frontpage category from config
		$fp_category = $this->config_model->load_single( 'content_frontpage_category', $this->lang->get_current_lang() );
		
		if ( $fp_category != null ) {
			// load category for title, metas
			$this->db->where( 'tid', $fp_category );
			$query = $this->db->get( 'taxonomy_term_data' );
			if ( $query->num_rows() <= 0 ) {
				// not found category
				unset( $_GET['tid'] );
			} else {
				$row = $query->row();
				if ( $row->theme_system_name != null ) {
					// set theme
					$this->theme_path = base_url().config_item( 'agni_theme_path' ).$row->theme_system_name.'/';// for use in css
					$this->theme_system_name = $row->theme_system_name;// for template file.
				}
			}
			$query->free_result();
			unset( $query );			
		}
		
		// list posts---------------------------------------------------------------
		if ( $fp_category != null && is_numeric( $fp_category ) ) {
			$_GET['tid'] = $fp_category;
		}
		$output['list_item'] = $this->posts_model->list_item( 'front' );
		if ( is_array( $output['list_item'] ) ) {
			$output['pagination'] = $this->pagination->create_links();
		}
		// end list posts---------------------------------------------------------------
		
		// head tags output ##############################
		if ( isset( $row ) && $row->meta_title != null ) {
			$output['page_title'] = $row->meta_title;
		} else {
			$output['page_title'] = $this->html_model->gen_title();
		}
		// meta tags
		$meta = '';
		if ( isset( $row ) && $row->meta_description != null ) {
			$meta[] = '<meta name="description" content="'.$row->meta_description.'" />';
		}
		if ( isset( $row ) && $row->meta_keywords != null ) {
			$meta[] = '<meta name="keywords" content="'.$row->meta_keywords.'" />';
		}
		$output['page_meta'] = $this->html_model->gen_tags( $meta );
		unset( $meta );
		// link tags
		// script tags
		// end head tags output ##############################
		// output


		$this->generate_page( 'front/templates/index', $output );

	}// index
	*/


	public function index()
	{
		// SET VALUE
		$output = '';

		$language_id = $this->session->userdata( 'lang' );

		if ( empty( $language_id ) ) 
		{
			$this->session->set_userdata( 'lang', '1' );
		}

		// --------------
		$this_lang = $this->lang_model->get_lang_default();
		$this_lang = ( ! empty( $this_lang ) ) ? $this_lang : $this->lang_model->get_lang_default() ;
		$data_tag = $this->seotag_model->this_tag( 'page_intro' , 'home_page_intro' , $this_lang );

		$meta = array();
		foreach ( $data_tag as $key => $value ) 
		{
			if ( $value->tag_name == 'title' ) 
			{
				$output['page_title'] = $value->value;
			}
			else
			{
				$meta[] = '<meta name="'.$value->tag_name.'" content="'.$value->value.'" />';
			}
		}	
		$output['meta_tag'] = $this->html_model->gen_tags( $meta );

		// --------------
		
        $this->db->where( 'status', 1 );
		$this->db->where( ' ( end_date >= '. strtotime(date('Y-m-d 00:00:00')) . 
                 ' OR end_date = 0 ) ', false , false );
        $this->db->order_by( 'order_sort', 'ASC' );
        $query = $this->db->get( 'intro_page' );
        $data = $query->row();

        $value = $data;

        if ( empty($data) ){
        	redirect( site_url( 'home' ) );
        }		

		$output['data_intro'] = '';

		$output['data_value'] = $data;

		switch($value->select_cover){
			case '1';
				$retVal = ( $value->open_this_page == 2 ) ? 'target="_blank" ' : '' ;	
				$output['data_intro']='<a '.$retVal.' href="'.http_check($value->link_url).'" title=""><img style="max-width: 60%;" class="hover_image" src="'.base_url( $value->image_name_cover).'" href="'.base_url( $value->image_name_cover).'" alt="'.$value->title.'" title="'.$value->title.'"></a>';
				break;
			case '2';
				// $output['data_intro']='<iframe width="700" height="394" src="http://www.youtube.com/watch?v='.$value->youtube_id_cover.'" frameborder="0" allowfullscreen></iframe>';
				$output['data_intro']= '<iframe width="539" height="335" src="//www.youtube.com/embed/'.$value->youtube_id_cover.'" frameborder="0" wmode="Opaque" allowfullscreen></iframe>';

				break;
			case '3';
				$output['data_intro']='
				<center>
					<video width="700" height="394"	autoplay="autoplay"	controlbar="none" id="container">
					<source src="'.str_replace('%2F','/',base_url($value->file_video_cover)).'" type="video/mp4; codecs=\'avc1.42E01E, mp4a.40.2\'">
					</video>
					<script type="text/javascript">
						jwplayer("container").setup({
							width: 700,
							height: 394,
							file: "'.str_replace('%2F','/',base_url($value->file_video_cover)).'",
							logo: "",
							controlbar: "none",
							autostart: true,
							icons: false,
							modes: [
							{ type: "flash", src: "'.base_url('public/js/jwplayer/jwplayer.flash.swf').'" },
							{ type: "html5"},
							{ type: "download" }
							]
						});
					</script>
				</center>
				';
				break;
			case '4';
				$output['data_intro'] = '<div class="box-content" style="max-width: 55em; width: auto; display: inline-block;" >'.$value->intro_text.'</div>';
				break;
			default:$output['data_intro'] = '';
		}

		if ( empty( $output['data_intro'] ) ) {
			redirect( site_url( 'home' ) );
		}	

		$this->load->view( 'front/templates/intro', $output );


	}


	public function change_language( $info = '' , $intro = '' )
	{

		
		if ( ! empty( $info ) ) 
		{
			$this->session->set_userdata( 'lang', $info );
		}
		else
		{
			return false;
		}

		$this->db->where( 'id', $info );
		$query = $this->db->get( 'language' );
		$data = $query->row();

		if ( ! empty( $data ) ) 
		{
			$this->session->set_userdata( 'lang_text', $data->language_code );
		}

		$lang = $this->session->userdata( 'lang' );

		$url = http_check( $this->session->userdata('history_back') );	

		switch ( $url ) {
			case '#':
				$url = site_url();
				break;
			
			default:
			
		}

		if ( ! empty( $intro ) ) 
		{
			$this->session->set_userdata( 'lang', $info );

			redirect( site_url( 'home' ) );
		}

		header( 'Location: '.$url ); 

	} 



	// START delete_cache
	public function delete_cache() {
	

		$path_cache = FCPATH.'cache/';
		
		recursiveDelete( $path_cache );

		
	}// END delete_cache 

	
}