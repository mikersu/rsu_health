<?php 

/**
*
*** START INCLUDE FUNCTION AND inc_header.PHP
*
**/
if ( ! $this->session->userdata( 'lang' ) ) 
{
	$this->session->set_userdata( 'lang', $this->lang_model->get_lang_default() );
}

$this->session->set_userdata( 'history_back', $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] );

include( dirname(__FILE__).'/functions.php' ); 
include( dirname(__FILE__).'/inc_header.php' );


/** END INCLUDE FUNCTION AND inc_header.PHP **/



echo $page_content;



// INCLUDE inc_footer.PHP
include( dirname(__FILE__).'/inc_footer.php' ); 


?>
