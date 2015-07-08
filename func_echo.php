<?php
/**
 * These are basic functions to assist with print certain html tags from php. Since we started implementing Smarty template engine,
 * these functions have no foreseeable use and could be deprecated once all the code has been refactored.
 * 
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
 
function print_h1($text){
	$newString = "<h2>" . $text . "</h2>";
	return $newString;
}
function print_bold($text){
	$newString = "<b>" . $text . "</b>";
	return $newString;
}

/**
 * DONT DEPRECATE THIS
 * 
 * */
function tooltip($tip, $link = ""){

	if($link != ""){
	$item='<a tabindex="-1" target="_blank" href="http://wiki.apollolms.co.za/index.php/' . $link . '"><img alt="Help on '. $tip . '" src="' . ICONS_PATH . 'help.png" title="' . $tip . '" /></a>';
	}else{
	$item = '<img alt="Help on '. $tip . '" src="' . ICONS_PATH . 'help.png" title="' . $tip . '" />';
	}
return $item;
}

function br(){
	echo "<br />";
}
function br_clear(){
	echo '<br class="clear" />';
}
