<?php  

/**
 * Reponse data 
 *
 * @param mixed 
 * @return 
 **/
function json_response($data)
{
	// header('Content-type: application/json; charset=UTF-8');
	echo json_encode($data);
	exit;
}

function str_replace_once($needle, $replace, $subject)
{
    $pos = strpos($subject, $needle);
    if ($pos !== false)
        $subject = substr_replace($subject, $replace, $pos, strlen($needle));
    return $subject;
}



function str_replace_once2($needle, $replace, $subject)
{
    $pos = strpos($subject, $needle);
    if ($pos !== false)

    	if ( $needle == '<li>' ) 
    	{
    		$subject = preg_replace_callback( '~<li[^>]*>(.*?)</li>~' , 'replace_li' , $subject);     
    		
    	}else if ( $needle == '<ol>' ) 
    	{
    		$subject = preg_replace('/(<ol.+?)+(>)/i', $replace , $pos ,  strlen($needle));
    	}


    return $subject;
}

function replace_ul( $match ) 
{
	return '- ' . $match[1] .'<br>';
}


function replace_ul_ol( $match ){ 
	if( $match[1] == 'ol' )
	{
		$GLOBALS['replace_li_number'] = 0;
		return preg_replace_callback( '~<li[^>]*>(.*?)</li>~' , 'replace_ol' , $match[2] );
	}
	return preg_replace_callback( '~<li[^>]*>(.*?)</li>~' , 'replace_ul' , $match[2] );
}

function replace_ol( $match ) 
{
	global $replace_li_number;
	$replace_li_number++;
	return $replace_li_number.' ' . $match[1] .'<br>';
}


function recursiveDelete($str){

    if(is_file($str)){
        return @unlink($str); 
    }
    elseif(is_dir($str)){
        $scan = glob(rtrim($str,'/').'/*');
        foreach($scan as $index=>$path){
            recursiveDelete($path);
        }
        return @rmdir($str);
    }
}


function export_email( $info = '' )
{
	$array = explode(",", $info);
	foreach ( $array as $key => $value ) 
	{
		$array[$key] = trim( $value );
	}

	return $array;
}


// FOR MODULE TYPE_SETTING ONLY
function get_type_name( $type = '' ) 
{
	
		switch ( $type ) 
		{
			case 'member_type':
				$overset_sub_menu = 'Member Type';
				break;

			case 'package_type':
				$overset_sub_menu = 'Package Type';
				break;

			case 'subject_contact_type':
				$overset_sub_menu = 'Subject Contact Type';
				break;

			case 'reservation_type':
				$overset_sub_menu = 'Reservation Type';
				break;

			case 'contact_type':
				$overset_sub_menu = 'Contact Type';
				break;	

			default:
				$overset_sub_menu =  '';
				break;
		}

	return $overset_sub_menu;	

}


function lang_get( $info ='' ) 
{

	include ABSPATH.'language/thai/frontend_lang.php';

	$OVER =& get_instance();

	$language_text = strtolower($OVER->session->userdata( 'lang_text' )); 

	if ( empty( $language_text ) ) 
	{
		$lang_id_default = $OVER->lang_model->get_lang_default();
		$OVER->db->where( 'id', $lang_id_default );
		$query = $OVER->db->get( 'language' );
		$data = $query->row();
		$language_text = strtolower($data->language_code);

	}

	if ( $language_text != 'th' ) 
	{
		return $info;
	}


	if ( ! empty( $lang[ $info ] ) ) 
	{
		return $lang[ $info ];
	}
	else
	{
		return $info;
	}

}

function is_array_empty($InputVariable)
{
   $Result = true;

   if (is_array($InputVariable) && count($InputVariable) > 0)
   {
      foreach ($InputVariable as $Value)
      {
         $Result = $Result && is_array_empty($Value);
      }
   }
   else
   {
      $Result = empty($InputVariable);
   }

   return $Result;
}


function is_array_empty_validate($InputVariable)
{
	$info = array();
	if (is_array($InputVariable) && count($InputVariable) > 0)
	{

		foreach ( $InputVariable as $key => $value ) 
		{
			if ( empty( $value ) ) 
			{
				$info[] = $key;
			}
		}

	}

   return $info;


}


function check_keyword( $string = '' )
{
	$CI_SET =& get_instance();

	$CI_SET->db->where( 'status', 1 );
	$query = $CI_SET->db->get( 'webboard_block_keyword' );
	$data = $query->row();

	if ( empty( $data->tags_keyword ) ) 
	{
		return $string;
	}

	$array_key = explode( ",", $data->tags_keyword );

	$string = str_ireplace( $array_key, "***", $string );

	return $string;  

}


/**
*
*** START SET URL
*
**/

function http_check( $url = '' ) 
{
	if ( empty( $url ) OR $url == '#' ) {
		return '#';
	}

	if (strpos( $url ,'https://www') !== false) {
	    return $url;
	}else if ( strpos( $url , 'http://www' ) !== false  ) 
	{
		return $url; 
	}
	else if ( strpos( $url , 'http://' ) !== false ) 
	{
		return $url;
	}
	else
	{
		return '//'.$url ;
	}


}

/** END SET URL **/



/**
*
* Block comment
*
**/
function set_time_to_strtotime( $time , $tag = '/' )
{
	if ( empty( $time ) ) 
	{
		echo "this time is empty";
		die();
	}

	$array_time = explode( $tag , $time );
	return $array_time[2].'-'.$array_time[1].'-'.$array_time[0];

}
	


//------------------------------------------------------------------------
/**
 * truncate text to a specific length
 *
 * @param String $string
 * @param Integer $limit
 * @param String $suffix
 * @return String truncated string
 */
function limit_text($string, $limit, $suffix = '&hellip;')
{
	if (mb_strlen($string, 'UTF-8') > $limit)
	{
		$string = mb_substr($string, 0, $limit, 'UTF-8') . $suffix;
	}
	
	return $string;
}

/**
*
* Block comment
*
**/
function getDateFull($myDate, $Lang='th'){
	if($Lang=='th'){

		$myDateArray=explode("-",$myDate);
		if ($myDateArray[1] == 00) {
			return false;
		}
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) 
		{
			case "01" : $myMonth = "มกราคม";  break;
			case "02" : $myMonth = "กุมภาพันธ์";  break;
			case "03" : $myMonth = "มีนาคม"; break;
			case "04" : $myMonth = "เมษายน"; break;
			case "05" : $myMonth = "พฤษภาคม";   break;
			case "06" : $myMonth = "มิถุนายน";  break;
			case "07" : $myMonth = "กรกฎาคม";   break;
			case "08" : $myMonth = "สิงหาคม";  break;
			case "09" : $myMonth = "กันยายน";  break;
			case "10" : $myMonth = "ตุลาคม";  break;
			case "11" : $myMonth = "พฤศจิกายน";   break;
			case "12" : $myMonth = "ธันวาคม";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
        return($myDay . " " . $myMonth . " " . $myYear);	
	}
}


function getDateFullS($myDate, $Lang='1'){
	if($Lang=='1'){

		$myDateArray=explode("-",$myDate);
		if ($myDateArray[1] == 00) {
			return false;
		}
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) 
		{
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		// $myYear = $myDateArray[0];
        return($myDay . " " . $myMonth . " " . $myYear);	
	}
	else
	{

		$myDateArray=explode("-",$myDate);
		if ($myDateArray[1] == 00) {
			return false;
		}
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) 
		{
			case "01" : $myMonth = "Jan";  break;
			case "02" : $myMonth = "Feb";  break;
			case "03" : $myMonth = "Mar"; break;
			case "04" : $myMonth = "Apr"; break;
			case "05" : $myMonth = "May";   break;
			case "06" : $myMonth = "Jun";  break;
			case "07" : $myMonth = "Jul";   break;
			case "08" : $myMonth = "Aug";  break;
			case "09" : $myMonth = "Sep";  break;
			case "10" : $myMonth = "Oct";  break;
			case "11" : $myMonth = "Nov";   break;
			case "12" : $myMonth = "Dec";  break;
		}
		// $myYear = sprintf("%d",$myDateArray[0])+543;
		$myYear = $myDateArray[0];
        return($myDay . " " . $myMonth . " " . $myYear);	

	}


}


//------------------------------------------------------------------------
function getDateFull_All_time($myDate, $Lang='th'){
	if($Lang=='th'){

		$myDateArray=explode("-",$myDate);
		if ($myDateArray[1] == 00) {
			return ' ไม่ระบุ ';
		}
		$all_time = explode( " ",$myDateArray[2] );
		$myDay = sprintf( "%d",$myDateArray[2] );
		switch($myDateArray[1]) 
		{
			case "01" : $myMonth = "มกราคม";  break;
			case "02" : $myMonth = "กุมภาพันธ์";  break;
			case "03" : $myMonth = "มีนาคม"; break;
			case "04" : $myMonth = "เมษายน"; break;
			case "05" : $myMonth = "พฤษภาคม";   break;
			case "06" : $myMonth = "มิถุนายน";  break;
			case "07" : $myMonth = "กรกฎาคม";   break;
			case "08" : $myMonth = "สิงหาคม";  break;
			case "09" : $myMonth = "กันยายน";  break;
			case "10" : $myMonth = "ตุลาคม";  break;
			case "11" : $myMonth = "พฤศจิกายน";   break;
			case "12" : $myMonth = "ธันวาคม";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
		$all_time = ( ! empty( $all_time[1] ) ) ? $all_time[1] : 'ไม่ระบุ' ;
        return( $myDay . " " . $myMonth . " " . $myYear . ' เวลา '.$all_time );	
	}
}
//------------------------------------------------------------------------


/**
*
* Block comment
*
**/
function show_date($date_create){
	
	$date_m = explode(' ',$date_create);
	$ex_date = explode('-',$date_m[0]);

	if($ex_date[1] == '01'){
		$month = 'Jan';
	}else if($ex_date[1] == '02'){
		$month = 'Feb';
	}else if($ex_date[1] == '03'){
		$month = 'Mar';
	}else if($ex_date[1] == '04'){
		$month = 'Apr';
	}else if($ex_date[1] == '05'){
		$month = 'May';
	}else if($ex_date[1] == '06'){
		$month = 'Jun';
	}else if($ex_date[1] == '07'){
		$month = 'Jul';
	}else if($ex_date[1] == '08'){
		$month = 'Aug';
	}else if($ex_date[1] == '09'){
		$month = 'Sep';
	}else if($ex_date[1] == '10'){
		$month = 'Oct';
	}else if($ex_date[1] == '11'){
		$month = 'Nov';
	}else if($ex_date[1] == '12'){
		$month = 'Dec';
	}
	 
	echo $month.' '.$ex_date[2];
}

/**
*
* Block comment
*
**/
function preview_error( $info = array() ) 
{

	$html = '';

	if ( ! empty( $info ) ) 
	{
	   	$html .= '<div class="alert alert-error">';
	   	$html .=     '<button class="close" data-dismiss="alert"></button>';

	   	foreach ( $info as $key => $value ) 
	   	{
		   	$html .=     '<strong>'.lang_get('Error').'! </strong>';
		   	$html .=     $value;
		   	if ( end($info) != $value ) 
		   	{
		   		$html .= '<br>';
		   	}

	   	}

	   	$html .= '</div>';
	}

	return $html;
}

/**
*
* Block comment
*
**/
function preview_success( $info = '' ) 
{
	$html = '';	
	$html .= '<div class="alert alert-success">';
	$html .= '<button class="close" data-dismiss="alert"></button>';
	$html .= '<strong>Success! </strong>';
	
	if ( ! empty( $info ) ) 
	{
		$html .= $info;
	}
	else
	{
		$html .= 'The page has been save success.';
	}

	$html .= '</div>';

	return $html;

}

/**
*
*** START DELETE SUCCESS
*
**/

function delete_success()
{
	$html = '';	
	$html .= '<div class="alert alert-success">';
	$html .= '<button class="close" data-dismiss="alert"></button>';
	$html .= '<strong>Success! </strong>';
	$html .= 'Delete content and save success.';
	$html .= '</div>';

	return $html;
}

/** END DELETE SUCCESS **/


/**
*
* Block comment
*
**/
function reset_format_date( $date = '' , $info_old = '/' , $info_new = '-' , $format_old = 'd-m-y' , $format_new = 'y-m-d' ) 
{
	$array_date = explode( $info_old , $date );

	$format_old = explode( '-' , $format_old );

	$format_new = explode( '-' , $format_new );

	foreach ( $array_date as $key => $value ) 
	{
		$set[ $format_old[$key] ] = $value ;
	}

	foreach ( $format_new as $key => $value ) 
	{
		$new[] = $set[ $value ];
	}	

	return implode( $info_new , $new );
		
}




/**
*
* Block comment
*
**/
function repair_string( $info = '' , $number = 0 ) 
{
	
	$array_info = explode("-", $info);

	$number++;

	if ( ! empty( $number ) )
	{
		$number = '-'.$number;
	}
	else
	{
		$number = '';
	}

	$string = $array_info[0].$number;

	return $string;
}

/**
*
* Block comment
*
**/
function make_url($string, $length = 0, $separator = '-')
{
	$string = make_plain($string);
	$string = preg_replace('~[^a-z0-9ก-๙\s\-]~iu', '', $string);
	
	if (is_numeric($length) AND $length > 0 AND mb_strlen($string, 'UTF-8') > $length)
	{
		$string = mb_substr($string, 0, $length);
	}
		
	$string = trim($string);
	$string = preg_replace('~\s+~', $separator, $string);
	$string = strtolower($string);
	
	return $string;
}

/**
*
* Block comment
*
**/
function make_plain($string)
{
	$string = strip_tags($string);
	$string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
	// clean whitespace
	$string = preg_replace('~\s+~', ' ', $string);
	// clean whitespace again for heading and trailing whitespace
	$string = trim($string, ' '.chr(194).chr(160));
	$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	
	return $string;
}

/**
*
* Block comment
*
**/
function remove_underscore( $string )
{
	$string = str_replace("_", " ", $string );		
	return $string;
}


/**
*
* functon alphanumeric_rand has return random char A-z and 0-9
*
**/
function alphanumeric_rand($num_require=8) {
	$randomstring = '';

	$arr1 = range( 'A' , 'Z');
	$arr2 = range( 'a' , 'z');
	$arr3 = range( '0' , '9');
    $alphanumeric =	array_merge( $arr1 , $arr2 , $arr3 );

	if($num_require > sizeof($alphanumeric)){
		echo "Error alphanumeric_rand(\$num_require) : \$num_require must less than " . sizeof($alphanumeric) . ", $num_require given";
		return;
	}

	// set string
	$randomstring = '';
	for ( $i=0; $i < $num_require; $i++ ) 
	{ 
		$index_arr = array_rand( $alphanumeric );
		$randomstring .= $alphanumeric[$index_arr];
	}

	return $randomstring;
}


function set_time_format( $info = '' ) 
{
	$array_date = explode("/", $info);
	return $array_date[2].'-'.$array_date[1].'-'.$array_date[0];
}

function call_image_site( $path = '' , $width = 0 , $height = 0 , $no_image = '' , $show = 'admin' , $account = false , $theme = 'square' ) 
{
 	$tmp_path = $path;

 
	// CHECK PATH HAS EMPTY
	if ( empty( $path ) ) 
	{
		return false;
	}

	// CHECK '/' IN FIRST PATH
	if ( $path[0] == '/' ) 
	{
		$path = substr( $path , 1 );
	}


	if ( ! is_file( $path ) ) 
	{
		$path = ( ! empty( $no_image ) ) ? $no_image : 'images/no_image.png' ;
	}


	// START SET INCLUDE PHPTHUMB
	include_once APPPATH.'libraries/phpthumb/ThumbLib.inc.php';

	//  GET PATH ARRAY
	$path_parts = pathinfo( $path );
	// --- EXP
	// --- echo $path_parts['dirname'], "<br>";
	// --- echo $path_parts['basename'], "<br>";
	// --- echo $path_parts['filename'], "<br>";
	// --- echo $path_parts['extension'], "<br>";

	// CHECK NAME FILE IS NOT EMPTY
	if ( empty( $path_parts['basename'] ) AND empty( $path_parts['filename'] ) ) 
	{
		return false;
	}

	// // CHECK AND CREATE FOLDER
	makeAll( 'cache/'.$path_parts['dirname'] );
	
	// SET NEW NAME FILE
	$new_name = 'cache/'.$path_parts['dirname'].'/'.$path_parts['filename'].$width.'x'.$height.'.'.$path_parts['extension'];


	// CHECK FILE HAS NOT EMPTY
	if ( is_file( $new_name ) ) 
	{
		return  $new_name;
	}

	$over_set = $new_name;


	// RENDER FILE RESIZE
	$thumb = PhpThumbFactory::create( $path );  

	if ( $account != false ) 
	{
		if (  $account == 'mabin' ) {
			$thumb->resize( $width ,  0 )->crop( 0 , 0 , $width , $height )->save( $new_name );
		}elseif ($account == 'ape') {
			
			$size = getimagesize($path);

			switch ( $theme ) {
				case 'square':
					
					if ( $size[0] > $size[1] ) 
					{
						$thumb->resize( 0 ,  $width )->cropFromCenter( $width )->save( $new_name );
					}
					else
					{
						$thumb->resize( $width ,  0 )->cropFromCenter( $width )->save( $new_name );
					}

					break;

				case 'rectangle':

					$thumb->resize( $width ,  0 )->cropFromCenter( $width ,  $height )->save( $new_name );

					break;	

				case 'rectangle_h':

					$thumb->resize( 0 ,  $height )->cropFromCenter( $width ,  $height )->save( $new_name );

					break;		
				
				default:
					$thumb->cropFromCenter( $width )->save( $new_name );	
			}


		} 
		else {
			$thumb->cropFromCenter( $width )->save( $new_name );
		}
		

	} 
	else 
	{
		$thumb->resize( $width ,  $height )->save( $new_name );
	}
	
	return $new_name;
}



function makeTree($parent, $array)
{
  if (!is_array($array) OR empty($array)) return FALSE;

  $output = '<ul class="submenu__list" >';

  foreach($array as $key => $value):
    if ($value['sub_id'] == $parent):
        $output .= '<li>';

        if ($value['sub_id'] == NULL):
            $output .= '<a href="'.site_url( 'products/category/'.$value['slug'] ).'">'.$value['detail'].'</a>';

            $matches = array();

            foreach($array as $subkey => $subvalue):
                if ($subvalue['sub_id'] == $value['id']):
                    $matches[$subkey] = $subvalue;
                endif;
            endforeach;

            $output .= makeTree($value['id'], $matches);

        else:
            $output .= '<a href="'.site_url( 'products/category/'.$value['slug'] ).'">'.$value['detail'].'</a>';
            $output .= '</li>';
        endif;
    endif;

  endforeach;

  $output .= '</ul>';

  return $retVal = ( $output == '<ul class="submenu__list" ></ul>' ) ? '' : $output;
}



?>