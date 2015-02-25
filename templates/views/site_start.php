<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
	$request = parse_url($_SERVER['REQUEST_URI']);
	$path = $request["path"];

	$result = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');

	$result = explode('/', $result);
	$max_level = 2;
	//while ($max_level < count($result)) {
//	    unset($result[0]);
	//}
	//--//$result = '/'.implode('/', $result);
	$sitepath =  $result[0] ;

	session_name('lmsID' . SUBDOMAIN_NAME);
	session_set_cookie_params(86400,'/',$_SERVER['SERVER_NAME'],FALSE,TRUE);
	$GLOBALS['site_session_name'] = 'lmsID' . SUBDOMAIN_NAME;
	
	if(!isset($_SERVER['HTTPS'])){
		$https = "https://"; // there is a reason i did this but i'm not sure why anymore
		header('Location: https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
	}
	
	$timeout = 69 * 60; // minutes
	$fingerprint = md5('SECRTE-SATL'.$_SERVER['HTTP_USER_AGENT']);
	
	header("Expires: ".gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
	session_start();
	if ( (isset($_SESSION['last_active']) && (time() > ($_SESSION['last_active']+$timeout)))
		|| (isset($_SESSION['fingerprint']) && $_SESSION['fingerprint']!=$fingerprint)  
		|| (isset($_SESSION['last_id']) && $_SESSION['last_id']!=$_SESSION['userID']) ){
	base_func_logout();
}
	session_regenerate_id(); 
	$_SESSION['last_active'] = time();
	$_SESSION['fingerprint'] = $fingerprint;
	if(isset($_SESSION['userID'])){$_SESSION['last_id'] = $_SESSION['userID'];}
	date_default_timezone_set('UTC');
	$_SESSION['time_start'] = microtime(true); 
?>
