<?php
/**
 * Basic security functions
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
 /**
  * Encrypts a given text with password (salt param)
  * @param $salt
  * @param $text
  * */
function simple_encrypt($salt,$text){
	return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_CBC, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND))));
}

/**
  * Decrypts a given text with password (salt param)
  * 
  * @param $salt
  * @param $text
  * */
function simple_decrypt($salt,$text){
	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_CBC, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND)));
}

/**
 * Checks if a given number appears to be a valid cellphone number
 * 
 * @param $number A cellphone number
 * */
function check_cellphone_number($number){
	$status = false;
	if(is_numeric($number)){
		if(strlen($number) <= 11){
			$status = true;
		}
	}
	return $status;
}

/**
 * Checks if a given email appears to be a valid email address
 * 
 * @param $email
 * 
 * */
function check_email_address($email){
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
  	 if(!preg_match("@^(([A-Za-z0-9!#$%&'*+//=?^_`{|}~-][A-Za-z0-9!#$%&?'*+//=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$@",$local_array[$i])){
    //if(!preg_match("/^(([A-Za-z0-9!#$%&'*+=?^_`{|}~-][A-Za-z0-9!#$%&?'*+=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/",$local_array[$i])){
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
?([A-Za-z0-9]+))$/",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

/**
 * Strips extranous whitespace from a given string
 * 
 * @param $string
 * */
function strip_extra_whitespace($string){
	$string = preg_replace('/\s+/', ' ', trim($string));
	return $string;
}

/**
 * Strips numbers from a given string
 * 
 * @param $string
 * */
function strip_alpha_chars($string){
	$string = preg_replace( "/[^0-9]/", "", $string );
	return $string;
}

/**
 * Strips special characters from a given string
 * 
 * @param $stringVar
 * */
function strip_special_chars($stringVar){
	$badChars = array('=','<','>','/','\\','`','~','\'','$','%','#');
	$stringVar = str_replace($badChars, '', $stringVar);
	return $stringVar;
}

/**
 * Strips a set of html tags from a given string
 * 
 * @param $stringVar
 * */
function strip_html_tags($stringVar){
	$stringVar = preg_replace(
	array(
		'@<head[^>]*?>.*?</head>@siu',
		'@<style[^>]*?>.*?</style>@siu',
		'@<script[^>]*?>.*?</script>@siu',
		'@<object[^>]*?>.*?</object>@siu',
		'@<embed[^>]*?>.*?</embed>@siu',
		'@<applet[^>]*?>.*?</applet>@siu',
		'@<noframes[^>]*?>.*?</noframes>@siu',
		'@<noscript[^>]*?>.*?</noscript>@siu',
		'@<noembed[^>]*?>.*?</noembed>@siu',
	),
	array ('','','','','','','','',''),
	$stringVar
	);
	return $stringVar;
}

/**
 * Wrapper to do a few strips to make sql injection much harder
 * 
 * @param $stringVar
 * */
function makeSafe($stringVar){
	$stringVar = strip_html_tags($stringVar);
	$stringVar = strip_special_chars($stringVar);
	if(isset($GLOBALS['sqlcon'])){
		$stringVar = mysqli_real_escape_string($GLOBALS['sqlcon'],trim($stringVar));
	}
	return $stringVar;
}

function sql_escape_string($stringVar){
	if(isset($GLOBALS['sqlcon'])){
		$stringVar = mysqli_real_escape_string($GLOBALS['sqlcon'],trim($stringVar));

	}
	return $stringVar;
}
