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
function scanForFiles($dir, $prefix = '',$recurse = false, $includeHidden = true){
  $origdir = $dir; 
  $dir = rtrim(dirname(__FILE__) . '/' .$dir, '\\/');
  $result = array();
    foreach (scandir($dir) as $f) {
      if (($f !== '.') && ($f !== '..')) {
        if($recurse){
			if (is_dir("$dir/$f")) {
			  $result = array_merge($result, scanForFiles("$origdir/$f", "$prefix", $recurse, $includeHidden));
			}
		}
			if($includeHidden){
				$result[] = $prefix.$f;
			}else{
				if(strpos($f,'.') !== 0){
					$result[] = $prefix.$f;
				}
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
	$fileName = $data['media'];
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
function media_func_renameFile($data){
	$origName = $data['orignalName'];
	$newName = $data['newName'];
	$dirName = $data['originalDir'];

	chdir(dirname(__FILE__));
	if(copy($origName,( $dirName . $newName ))){
		unlink($origName);
		return true;
	}else{
		return false;
	}
}

/*
 * We need web playble files as h264, webm, and ogv
 * 
 * we should pull the data from a sql db
 * we should daily scan all dirs for files that may have been deleted
 * */
function media_func_convertVideo($fname){
	chdir(dirname(__FILE__));
	
	$filename = pathinfo($fname,PATHINFO_FILENAME);
	$safedir = pathinfo($fname,PATHINFO_DIRNAME);
	
	$finaldir = $safedir.'/.vid_res/';
	
	$ext = pathinfo($fname, PATHINFO_EXTENSION); 
	$vidarr = array('mpg','mpeg','mp4','flv','f4v','webm','ogv','vob');
	if(!in_array($ext,$vidarr)){
		return false;
	}

	if(!file_exists($finaldir)){
		mkdir($finaldir);
	}
	if(!file_exists($finaldir . $filename . ".jpg")){
		echo $filename . " as jpg poster";
		shell_exec('./classes/ffmpeg/ffmpeg -y -i "' . $fname . '" -ss 0:00:15.000 -vframes 1 "' . $finaldir . $filename . '.jpg"');
	}
	
	if(!file_exists($finaldir . $filename . ".mp4")){
		echo $filename . 'as mp4';
		shell_exec('./classes/ffmpeg/ffmpeg -y -i "' . $fname . '" -b:v 1500k -movflags faststart "' . $finaldir . $filename . '.mp4"');
	}	
	if(!file_exists($finaldir . $filename . ".webm")){
		echo $filename . 'as webm';
		shell_exec('./classes/ffmpeg/ffmpeg -y -i "' . $fname . '" -b:v 1500k "' . $finaldir . $filename . '.webm"');
	}
	if(!file_exists($finaldir . $filename . ".ogv")){
		echo $filename . 'as ogv';
		shell_exec('./classes/ffmpeg/ffmpeg -y -i "' . $fname . '" -b:v 1500k "' . $finaldir . $filename . '.ogv"');
	}
	
	if(file_exists($finaldir . $filename . ".mp4") && file_exists($finaldir . $filename . ".webm") && file_exists($finaldir . $filename . ".ogv")){
		return true;
	}else{
		return false;
	}
}

/*
 * We need smaller audios such as mp3
 * 
 * we should pull the data from a sql db
 * we should daily scan all dirs for files that may have been deleted
 * */
function media_func_convertAudio($fname){
	chdir(dirname(__FILE__));
	
	$filename = pathinfo($fname,PATHINFO_FILENAME);
	$safedir = pathinfo($fname,PATHINFO_DIRNAME);
	
	$finaldir = $safedir.'/.aud_res/';
	
	if(!file_exists($finaldir)){
		mkdir($finaldir);
	}

	$ext = pathinfo($fname, PATHINFO_EXTENSION);
	$audarr =array('wav','mp2','ogg','mp3','aac','flac');

	if(!in_array($ext,$audarr)){
		return false;
	}

	if(file_exists($finaldir . $filename . ".mp3")){
		shell_exec('./classes/ffmpeg/ffmpeg -i "' . $fname . '" "' . $finaldir . $filename . '.mp3"');
	}
	
	if(file_exists($finaldir . $filename . ".mp3")){
		return true;
	}else{
		return false;
	}
}

function media_func_convertFile($fname){

	$ext = pathinfo($fname,PATHINFO_EXTENSION);
		$audarr =array('wav','mp2','ogg','mp3','aac','flac');

	if(in_array($ext,$audarr)){
		media_func_convertAudio($fname);
	}	
	$vidarr =array('mpg','mpeg','mp4','flv','f4v','webm','ogv','vob');

	if(in_array($ext,$vidarr)){
		media_func_convertVideo($fname);
	}
}

function media_func_scanForOrphanedConverts(){
	// scan entire directory tree
	// check for .vid_res and .aud_res folders
	// check if parent folder contains same name file 
	// if not... delete it
}

/**
	Add a job to a db table of a file to convert
*/
function media_func_addConversionJob($fname){
	$fname = mysqli_real_escape_string($GLOBALS['sqlcon'],trim($fname));
	$q = "INSERT INTO conv_jobs(name)VALUES('$fname')";
	$r = sql_execute($q);
	
	return true;
}

function media_func_getLatestandConvert(){
	$q = "SELECT * FROM conv_jobs";
	$r = sql_execute($q);
	
	while($d = sql_get($r)){	
		$stat = media_func_convertFile($d['NAME']);
		
		if($stat){
			$q2 = "DELETE FROM conv_jobs WHERE ID='" . $d['ID'] . "'";
			$r2 = sql_execute($q2);
		}
	}
}
?>
