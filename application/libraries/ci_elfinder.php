<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('elFinder_Base', FCPATH.'public/themes/saha/assets/elfinder/php/');

require(elFinder_Base.'elFinderConnector.class.php');
require(elFinder_Base.'elFinder.class.php');
require(elFinder_Base.'elFinderVolumeDriver.class.php');
require(elFinder_Base.'elFinderVolumeLocalFileSystem.class.php');
require(elFinder_Base.'elFinderVolumeLocalFileSystemExtended.class.php');

class CI_elFinder {
	
	private static $instance;
	
	public function __construct($config = array())
	{
		if ( ! empty($config))
		{
			$this->initialize($config);
		}
	}
	
	public function initialize($config)
	{
		self::$instance = new elFinderConnector(new elFinder($config));
		self::$instance->run();
	}
	
	public function getInstance()
	{
		return self::$instance;
	}
}


/* End Ci_elfinder.php */