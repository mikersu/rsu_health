<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fseotag_model extends CI_Model {

    function __construct() 
    {
        parent::__construct();
    }// __construct
	

    public function cll_content()
    {
		// SET DEFAULT
    	$language_id = ( ! empty( $language_id ) ) ? $language_id : $this->session->userdata( 'lang' );

    	$this->db->from( 'seotag' );
    	$this->db->where( 'language_id', $language_id );
    	$query = $this->db->get();
    	$data = $query->row();

    	return $data;

    }


}

/* End of file fseotag_model.php */
/* Location: .//Applications/MAMP/htdocs/bansuannam/modules/seotag/models/fseotag_model.php */