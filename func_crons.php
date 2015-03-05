<?php
/**
@author Stephan Pieterse
@package ApolloLMS
*/

function cron_createLock(){
	chdir(dirname(__FILE__));
	if(file_exists("crons.lock")){
		return false;
	}else{
		echo shell_exec("touch crons.lock");
		return true;
	}
}

function cron_removeLock(){
	chdir(dirname(__FILE__));
	if(file_exists("crons.lock")){
		return unlink("crons.lock");
	}else{
		return false;
	}
}

function cron_func_mediaConversion(){
	if(cron_createLock()){
	chdir(dirname(__FILE__));
	$fulldir = scanForFiles('uploads','uploads/',true,false);
	//var_dump($fulldir);
	foreach($fulldir as $file){
	//	echo $file;
		echo "Trying " . $file;
		media_func_convertFile($file);
	}
	cron_removeLock();
	exit;
	}
	
}

function cron_func_killCaches(){
        chdir(dirname(__FILE__));
        shell_exec("find . -name .vid_res -exec rm -rf {} \;");
	shell_exec("find . -name .aud_res -exec rm -rf {} \;");
	return true;
}


?>
