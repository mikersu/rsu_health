<?php 

	$info = 'img_logo';

	//upload images
	require_once( 'application/libraries/phpthumb/ThumbLib.inc.php' );			
	//--- change name -------------------
	$file_name = explode('.',$_FILES['uploadfile']['name']);
	$md = md5( $_FILES['uploadfile']['name'] . uniqid( time() ) );  
	$filename = $md.'.'.$file_name[1];  
	
	$array_type = array( 'jpg', 'gif' , 'png' );


	if ( empty( $file_name[1] ) ) {
		return false;
		die();
	}

	if ( ! in_array( $file_name[1], $array_type) ) {
		return false;
		die();
	}	


	$uploaddir = 'public/upload/'.$info.'/';   //path name save
	$file = $uploaddir . $filename;	
			 
	if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) 
	{ 
	
		$thumb = PhpThumbFactory::create( $uploaddir.$filename );
		
		if ( true ) {
			$thumb->adaptiveResize( 250,250 );
		} else {
			$thumb->adaptiveResize( 100,100 );
		}

		$thumb->save( $uploaddir.'mid-'.$filename );
		if (file_exists($file)) {
			unlink($file);
		}
		
		$name_filemid = 'mid-'.$filename;			
	}  


	$object = new stdClass();
	$object->name_img = $_FILES['uploadfile']['name'];
	$object->name_filemid = '/public/upload/img_logo/'.$name_filemid ;


	echo json_encode( $object );


?>