<?php
/**
 * Quick and dirty functions originally used to identify the users browser and load styles / media accordingly
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
/**
 * Returns the current user agent.
 * */
function getUserAgent(){
	$agent = $_SERVER['HTTP_USER_AGENT'];
	return $agent;
}

/**
 * Try to identify a general device for use to base assumptions on
 * This is also used in some other media functions, eg to display flash when we know html5 is not available for a device
 * */
function getAgentType(){
	$type="desktop";
	
	$agent = getUserAgent();
	if(strpos($agent,"BlackBerry")){
		$type = "bb";
	}
	if(strpos($agent,"iPhone")){
		$type = "ios_small";
	}
	if(strpos($agent,"Android")){
		$type = "android_small";
	}
	return $type;
}

/**
 * Load any device specific css.
 * */
function loadCSS(){
	$_SESSION['userAgent'] = getAgentType();
	switch(getAgentType()){
		//case 'desktop': break;
		case 'bb':
		case 'ios_small':
		case 'android_small':
			//echo '<link rel="stylesheet" href="styles/mobile.css" type="text/css" />';
			echo '<meta name="viewport" content="width=device-width; initial-scale=1.0;" />';
		break;
	}
}
