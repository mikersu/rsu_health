<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//------------------------------------------------------------- [ content ]

/**
 * PATH and URL auto detection
 *
 * @author Porawit Poboonma
 * @since 2012-03-20 12:31:53
 */

define('ABSPATH',  str_replace('\\', '/', realpath(dirname(__FILE__) . '/..')) . '/');
define('DOCROOT', rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/', '/'));
define('DOMAIN', 'http://' . $_SERVER['HTTP_HOST'] . '/');
define('ABSURL', DOMAIN . str_replace(DOCROOT, '', ABSPATH));

define('FRONT_C', base_url().'public/themes/wedding/front/' );
define('LIB_FRONT', str_replace('application/', '', FRONT_C));

define('LIB_COMPONENTS', base_url().'public/components/');
define('LINK_REALWEDDING', base_url().'realwedding/brick/realwedding_brick/');
define('LINK_IMAGE_FRONT', base_url().'public/themes/wedding/front/images/');
define('LINK_JS',base_url().'public/js/');
define('LIB_UPLOAD', base_url().'public/upload/');
 
//------------------------------------------------------------- [ content ]