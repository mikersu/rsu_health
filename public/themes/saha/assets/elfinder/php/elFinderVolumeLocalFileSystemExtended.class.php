<?php

class elFinderVolumeLocalFileSystemExtended extends elFinderVolumeLocalFileSystem {
	
	/**
	 * Rename file and return file info
	 *
	 * @param  string  $hash  file hash
	 * @param  string  $name  new file name
	 * @return array|false
	 * @author Dmitry (dio) Levashov
	 **/
	public function rename($hash, $name) {
		
		// find extension from original file name by period
		$extension = explode('.',$this->decode($hash));
		
		// last value is the etension
		$extension = array_pop($extension);
	
		// this is only needed if the file name is not submitted
		$newName = $name;
		
		// find extension from submitted value and remove it from string
		$name = explode('.',$name);
		
		// remove last value (being the extension)
		array_pop($name);
	
		// put the newname back together if the extension exists when submitted
		if (count($name) > 0)
		{
			$name = implode(".", $name).'.'.$extension;
		}
		else
		{
			// if no extension existed in rename return name with the original extension
			$name = $newName.'.'.$extension;
		}
		// end extended
		
		
		if ($this->commandDisabled('rename')) {
			return $this->setError(elFinder::ERROR_PERM_DENIED);
		}
		
		if (!$this->nameAccepted($name)) {
			return $this->setError(elFinder::ERROR_INVALID_NAME, $name);
		}
		
		if (!($file = $this->file($hash))) {
			return $this->setError(elFinder::ERROR_FILE_NOT_FOUND);
		}
		
		if ($name == $file['name']) {
			return $file;
		}
		
		if (!empty($file['locked'])) {
			return $this->setError(elFinder::ERROR_LOCKED, $file['name']);
		}
		
		$path = $this->decode($hash);
		$dir  = $this->_dirname($path);
		$stat = $this->stat($this->_joinPath($dir, $name));
		if ($stat) {
			return $this->setError(elFinder::ERROR_EXISTS, $name);
		}
		
		if (!$this->allowCreate($dir, $name)) {
			return $this->setError(elFinder::ERROR_PERM_DENIED);
		}

		$this->rmTmb($file); // remove old name tmbs, we cannot do this after dir move


		if (($path = $this->_move($path, $dir, $name))) {
			$this->clearcache();
			return $this->stat($path);
		}
		return false;
	}
	
}
