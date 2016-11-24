<?php
	/**
	 * This method find files with alphanumeric filenames
	 * and txt extension
	 * @param string $dir path
	 * @param string $extension of searching files
	 * @return array of files or false
	 */
	function fileFinder($dir = '.', $extension = 'txt') {
		$file_arr = array();
		
		if( is_dir($dir) ){
			$files = scandir($dir);
			foreach($files as $v) {
				if( pathinfo($v, PATHINFO_EXTENSION) == $extension && preg_match( '/^\w+$/', pathinfo($v, PATHINFO_FILENAME)) ) {
					array_push( $file_arr, $v);
				}
			}
		} else {
			return false;
		}

		if(natcasesort($file_arr)){
			return $file_arr;
		} else {
			return false;
		}
	}
?>
