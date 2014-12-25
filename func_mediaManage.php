<?php
/**
 * Basic media management functions
 * 
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
function media_func_fileUploadBasic(){
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

/*
 * Recursively deletes entire folder and subs.
 * */

function media_func_rmFolder($data){
	$fileName = $data['folder'];
	chdir(dirname(__FILE__));
	if (check_user_permission('media_remove')){
		
		if(file_exists($fileName)){
			foreach(scanForFiles($fileName) as $fname){
				$cname = $filename . '/' . $fname;
				if(is_dir($cname)){
						media_func_rmFolder(array('folder'=>$cname));
				}else{
					unlink($fileName . '/' . $fname);
				}
			}
			rmdir($fileName);
			return true;
		}
	}
	return false;
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
function media_func_removeFile($data){
	$filename = $data['media'];
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

/*
 * We need web playble files as h264, webm, and ogv
 * 
 * we should pull the data from a sql db via cron job
 * we should daily scan all dirs for files that may have been deleted
 * */
function media_func_convertFile($fname){
	chdir(dirname(__FILE__));
	
	$filename = pathinfo($fname,PATHINFO_BASENAME);
	$safedir = pathinfo($fname,PATHINFO_DIRNAME);
	
	if(!file_exists($safedir.'/vid_res')){
		mkdir($safedir.'/vid_res');
	}
	
	$finaldir = $safedir.'/vid_res/';
	
	shell_exec("./classes/ffmpeg/ffmpeg -y -i " . $fname . " " . $finaldir . $filename . ".mp4");
	shell_exec("./classes/ffmpeg/ffmpeg -y -i " . $fname . " " . $finaldir . $filename . ".webm");
	shell_exec("./classes/ffmpeg/ffmpeg -y -i " . $fname . " " . $finaldir . $filename . ".ogv");
	
	if(file_exists($finaldir . $filename . ".mp4") && file_exists($finaldir . $filename . ".webm") && file_exists($finaldir . $filename . ".ogv")){
		return true;
	}else{
		return false;
	}
}
?>
