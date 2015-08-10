<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filemanager extends admin_controller {
	
	public $object_per_zone = 500;
	
	public function index()
	{
	
	}
	
	public function image($module = NULL, $id = NULL)
	{
		$this->_layout = FALSE;
		
		$connector_url = site_url('filemanager/connector');
		
		$data = array(
			'assets_url'    => $this->theme_path.'assets',
			'connector_url' => $connector_url,
			'allowed_mimes' => json_encode(array('image'))
		);
		
		$this->load->view('image', $data);
	}


	public function file($module = NULL, $id = NULL)
	{
		$this->_layout = FALSE;
		
		$connector_url = site_url('filemanager/connector');
		
		$data = array(
			'assets_url'    => $this->theme_path.'assets',
			'connector_url' => $connector_url,
			'allowed_mimes' => json_encode(array('application'))
		);
		
		$this->load->view('image', $data);
	}


	public function video($module = NULL, $id = NULL)
	{
		$this->_layout = FALSE;
		
		$connector_url = site_url('filemanager/connector');
		
		$data = array(
			'assets_url'    => $this->theme_path.'assets',
			'connector_url' => $connector_url,
			'allowed_mimes' => json_encode(array('video'))
		);
		
		$this->load->view('video', $data);
	}	
	
	public function connector($module = NULL, $id = NULL)
	{
		// this is ajax request, not render full page
		$this->_layout = FALSE;
		
		// default options for all roots
		// merge this config to your settings
		

		$default = array(
			// extended has override the rename check, never allow php
			'driver'        => 'LocalFileSystemExtended', 
			'path'          => FCPATH.'uploads/',
			'URL'           => base_url().'uploads/',
			'alias'         => '',
			'accessControl' => array($this, '_access_control'),
			// just a basic protection, still leave an attacking hole
			'uploadDeny'    => array(
				'text/x-php' 
			)
		);
		
		// roots container
		$roots = array();
		
		// default always show
		$roots[] = $default;
		
		$this->load->library('ci_elfinder', array('roots' => $roots), 'elfinder');
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 * Simple function to demonstrate how to control file access using "accessControl" callback.
	 * This method will disable accessing files/folders starting from  '.' (dot)
	 *
	 * @param  string  $attr  attribute name (read|write|locked|hidden)
	 * @param  string  $path  file path relative to volume root directory started with directory separator
	 * @return bool|null
	 **/
	public function _access_control($attr, $path, $data, $volume)
	{
		return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
			? ! ($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
			:  null;  
	}
	
	// -------------------------------------------------------------------------
	
	/**
	 *
	 *
	 **/
	public function _get_upload_dir($module, $object_id)
	{
		if ( ! is_scalar($module) OR empty($module) OR ! is_numeric($object_id) OR empty($object_id))
		{
			return FALSE;
		}
		
		$directory = implode(DIRECTORY_SEPARATOR, array($module, $this->get_object_zone($object_id), $object_id));
		
		if ( ! is_dir(UPLOADPATH.$directory) AND ! @mkdir(UPLOADPATH.$directory, 0777, TRUE))
		{
			return FALSE;
		}
		
		if ( ! is_writable(UPLOADPATH.$directory))
		{
			return FALSE;
		}
		
		return $directory;
	}
	
	protected function get_object_zone($id)
	{
		return ceil($id / $this->object_per_zone) * $this->object_per_zone;
	}
}


/* End filemanager.php */