<?php
/**
 * Basic media management functions
 * 
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
function fileUpload(){
	if((bill_calculateSpaceUsed() * 1024 + $_FILES['uploadedfile']['size']) > MAX_TOTAL_UPLOADS){
		return false;
		}
	
	// Where the file is going to be placed
	$target_path = "uploads/";
	/* Add the original filename to our target path.
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

	$ext = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
	if(($ext != 'php') && ($ext != 'asp') && ($ext != 'js')){
	
	if(file_exists($target_path)){
		unlink($target_path);
	}	

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	echo "The file ". basename( $_FILES['uploadedfile']['name']) . " has been uploaded";
	} else{
	echo "There was an error uploading the file, please try again!";
	}
	}else{
		echo "You cannot upload files of this type.";
	}
}

/**
 * Returns an array of filenames with dir prefixes
 * */
function scanForFiles($dir,$prefix = ''){
  $dir = rtrim(dirname(__FILE__) . '/' .$dir, '\\/');
  $result = array();
    foreach (scandir($dir) as $f) {
      if ($f !== '.' and $f !== '..') {
        if(1==2){
		//if (is_dir("$dir/$f")) {
        //  $result = array_merge($result, scanForFiles("$dir/$f", "$prefix$f/"));
        }
		else {
          $result[] = $prefix.$f;
        }
      }
    }
  return $result; 
}

/**
 * Makes a new folder
 * */
function media_func_mkNewFolder($data){
	$newDir = dirname(__FILE__) .'/'. $data['rootDirPath'] . $data['newFolderName'];
	if(file_exists($newDir)){
		return false;
	}
	mkdir($newDir, 0777, true);
	return true;
}

/**
 * Deletes a file
 * */
function removeFile($fileName){
	chdir(dirname(__FILE__));
	if (check_user_permission('media_remove')){
		if(file_exists($fileName)){
			unlink($fileName);
			return true;
		}
	}
	return false;
}

/**
 * Renames a file
 * */
function renameFile($origName, $newName){
	chdir(dirname(__FILE__));
	if(copy($origName, $newName)){
		unlink($origName);
		return true;
	}
	//	$retval = rename($origName, $newName);
	return false;
}
?>
