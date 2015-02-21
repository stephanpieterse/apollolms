<?php
/**
@author Stephan Pieterse
@package ApolloLMS
*/


function cron_func_mediaConversion(){
	chdir(dirname(__FILE__));
	$fulldir = scanForFiles('uploads','uploads/',true,false);
	//var_dump($fulldir);
	foreach($fulldir as $file){
	//	echo $file;
		echo "Trying " . $file;
		media_func_convertFile($file);
	}
	exit;
}

?>
