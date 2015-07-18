<?php
/*
THIS FILE DEFINES THE CONSTANTS USED (RELATIVE FILEPATHS, DATABASE NAMES AND PASSWORDS ETC)
* 
* @package ApolloLMS
* @author Stephan Pieterse
*/

ini_set( "display_errors", true );
define( "DB_DSN_HOST", "localhost" );
define( "DB_DSN_DB", "alms_dev" );
define( "DB_USERNAME", "alms_dev" );
define( "DB_PASSWORD", "UPHUnnZ6oslL" );
define( "CLASS_PATH", "./classes/" );
define( "MODULE_PATH", "modules/" );
define( "TEMPLATE_PATH", "templates/" );
define( "ICONS_PATH", "./icons/silk/icons/" );
define( "STYLES_PATH", "./styles/" );
define( "TEST_CLASSES", "test_templates/" );
define( "SCRIPTS_PATH", "./scripts/");
define( "SITE_NAME", "Apollo LMS Development");
define( "SITE_COMPANY", "Apollo LMS");
define( "SITE_LOGO", "./media/logo.png");
define( "SITE_SLOGAN", "");
define( "SITE_EMAIL", "webmaster@apollolms.co.za");
define( "SITE_EMAIL_AUTOMATED", "no-reply@apollolms.co.za");
define( "SITE_OPEN_REGISTRATIONS", "true" );
define( "MAX_TOTAL_UPLOADS", "5242880");
define( "DEBUG_MODE", "on");
define( "NO_LOGIN_SCAN", "on");
define( "SUBDOMAIN_NAME", "dev");

function handleWarning($errno,$errstr){
	echo "Sorry, a problem occurred. Please try again later. <br />";
 	 error_log( $errno . $errstr );
 	 echo "Warning details: " . $errstr;
}

function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try again later. <br />";
  error_log( $exception->getMessage() );
  echo "Error details: " . $exception->getMessage();
 }

function sql_execute($query){
		$result = mysqli_query($GLOBALS['sqlcon'], $query) or die(mysqli_error($GLOBALS['sqlcon']));
		return $result;
}

function sql_get($data){
		$result = mysqli_fetch_assoc($data);
		return $result;
}

function sql_getrow($data){
		$result = mysqli_fetch_row($data);
		return $result;
}

function sql_numrows($data){
		$result = mysqli_num_rows($data);
		return $result;
}

function flag(){
	echo "Code execution has succeeded up to this point:";
}
 
	set_exception_handler( 'handleException' );
//	set_error_handler("handleWarning", E_WARNING);
	
	$GLOBALS['sqlcon'] = mysqli_connect(DB_DSN_HOST, DB_USERNAME, DB_PASSWORD, DB_DSN_DB) or die (mysqli_error($sqlcon));
	//$selectdbq = mysqli_select_db($sqlcon, DB_DSN_DB) or die(mysqli_error($sqlcon));
