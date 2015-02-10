<?php
/**
 * Inclusion of all the files containing the functions and classes used by the ApolloLMS system,
 * as well as some functions that don't seem to fit anywhere else.
 * 
 * @package ApolloLMS
 * @author Stephan
 * @version 1.x
 */

require('func_security.php');
require('func_courses.php');
require('func_backup.php');
require('func_articles.php');
require('func_users.php');
require('func_mediaManage.php');
require('func_navigation.php');
require('func_tests.php');
require('func_groups.php');
require('func_echo.php');
require('func_roles.php');
require('func_help.php');
require('func_xml.php');
require('func_css.php');
require('func_pages.php');
require('func_modules.php');
require('func_email.php');
require('func_billing.php');
require('func_statistics.php');
require('func_search.php');
require('func_zip.php');
require('func_payments.php');
require('func_flagged.php');
require('func_sitesettings.php');
require('func_resources.php');
require('func_events.php');

require(CLASS_PATH . 'modules.php');
require(CLASS_PATH . 'test_item.php');
require(CLASS_PATH . 'events_class.php');
require(CLASS_PATH . 'templateEngine.php');
require(CLASS_PATH . 'resource_handler.php');
require(CLASS_PATH . 'smarty/libs/Smarty.class.php');
require(CLASS_PATH . 'php-svg/svglib/svglib.php');

/*
 * Really simple human readable filesize func
 * */
function misc_human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

/**
 * Check if the supplied time is within a specific month
 * @param
 * time1 - formatted time string
 * monthnum - number of the month in question
 */
function time_isInSelectedMonth($time1,$monthNum){
	$time1 = explode('-',$time1);
	
	if($time1[1] == $monthNum){
		return true;
		}else{
		return false;
		}
}

/**
 * Check if the supplied time is within the same month as another time
 * @param
 * time1 - formatted time string
 * time2 - formatted time string
 */
function time_isInSameMonth($time1,$time2){
	$time1 = explode('-',$time1);
	$time2 = explode('-',$time2);

	if($time1[1] == $time2[1]){
		return true;
		}else{
		return false;
}
}

/**
 * Calculates the time difference between two given times in the format that i seem to use.
 */
function time_difference($time1, $time2, $humanreadable = true){
	$time1 = explode('-',$time1);
	$time2 = explode('-',$time2);
	$time1T = mktime($time1[3],$time1[4],$time1[5],$time1[1],$time1[2],$time1[0]);	
	$time2T = mktime($time2[3],$time2[4],$time2[5],$time2[1],$time2[2],$time2[0]);
	
	
	$timeDiff = $time1T - $time2T;
	$timeDiffSecs = $timeDiff;
	if($timeDiff > 60){
		$timeDiff = $timeDiff / 60;
		if($timeDiff > 60){
			$timeDiff = $timeDiff / 60;
			if($timeDiff > 24){
				$timeDiff = $timeDiff / 24;
				$wordDiff = $timeDiff . " days";
			}else{
			$wordDiff = $timeDiff . " hours";
			}
		}else{
		$wordDiff = $timeDiff . " minutes";
	}
	}else{
		$wordDiff = $timeDiff . " seconds";
}
	if($humanreadable){
	return $wordDiff;
	}else{
	return $timeDiffSecs;
	}
}	

/**
 * Quickly checks that pages / articles still have corresponding course parents. If not...
 */
function verifyXML($whatTo, $wid){
	switch($whatTo){
		case 'courses':
			$colName = 'articles';
			$colNameR = 'ARTICLES';
		break;
		case 'articles':
			$colName = 'pages';
			$colNameR = 'PAGES';
		break;
	}
	
	$q = "SELECT * FROM $whatTo WHERE id='$wid' LIMIT 1";
	$r = sql_get(sql_execute($q));
	$xmldata = $r[$colNameR];
		$doc = new DOMDocument; 
		$doc->loadXML($xmldata);
		$docRoot = $doc->documentElement;
		
		foreach($docRoot->childNodes as $child){
		$nodeToRemove = null;
			if($child->hasAttributes()){
			$checkFor = $child->getAttribute('id');
			
			$q2 = "SELECT * FROM $colName WHERE id='$checkFor' LIMIT 1";
			$r2 = sql_execute($q2);
			if ((sql_numrows($r2) == 0 || (sql_numrows($r2) == false))){
						 $nodeToRemove = $child; 
						}
					}	
				if ($nodeToRemove != null){
					$docRoot->removeChild($nodeToRemove);	
				}
		$newData = $doc->saveHTML(); 		
	}
	$newData = $doc->saveHTML(); 		
	$q3 = "UPDATE $whatTo SET $colName='$newData' WHERE id='$wid'";
	$r3 = sql_execute($q3);
}

/**
 * Generic wrapper to remove items from the database.
 */
function removeItem($tablename, $iid, $comment = " "){
		$query = 'SELECT * FROM ' . $tablename . ' WHERE id="' . $iid . '"';
		$result = sql_get(sql_execute($query));
		backupData($result, ("Item Deletion " .  $iid . " " . $tablename . " " . $comment), $tablename);
		
		$query = 'DELETE FROM ' . $tablename . ' WHERE id="' . $iid . '"';
		$result = sql_execute($query);
		
		return true;
}

/**
 * Redirects the current page. First tries with php header(), then with javascript, then with a meta refresh tag.
 * 
 * @param
 * url - the relative url of the page
 * time - default 0 - how long to wait before redirecting
 * postdat - array - default null - any data to be included in the session as posted data
 */
function page_redirect($url,$time=0,$POSTDAT = '') {
	if(strpos($url,'http') === false){
		$needfullurl = true;
	}else{
		$needfullurl = false;
		$fullurl = $url;
	}
	
		$request = parse_url($_SERVER['REQUEST_URI']);
		$path = $request["path"];
		$result = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');
		//$result = explode('/', $result);
		//$max_level = 2;
		//$sitepath = $result[0];	
	
	if(is_array($POSTDAT)){
	//	do_post_request('https://' . $_SERVER['SERVER_NAME'] . '/' .$result .'/' .$url, $POSTDAT);
	//$_SESSION['SERV_ERR_MSG'] = ;
	$_SESSION = array_merge($_SESSION,$POSTDAT);
	//exit;
	}
	
	if($time = ''){
		$time = 0;
	}
	
	if ($needfullurl){
		$fullurl = 'http://' . $_SERVER['SERVER_NAME'] . '/' .$result .'/' .$url;
	}
	
    if(!headers_sent()) {
        //If headers not sent yet... then do php redirect
        if($time != 0){
        	sleep($time);
        }
        header('Location: ' . $fullurl );
        exit;
    } else {
        //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
        echo '<script type="text/javascript">'
        . "setTimeout(\"window.location.href='" . $fullurl . "'\"," . $time*60 . ")"
        . '</script>'
        . '<noscript>'
        . '<meta http-equiv="refresh" content="' . $time*60 . ';url='.$fullurl.'" />'
        . '</noscript>';
        exit;
    }
}

/**
 * Marks the url in the session
 */
function markLastPage($string){
	$_SESSION['getlastpage'] = $string;
}

/**
 * Goes to the last marked url in the session
 * */
function goToLastURL(){
	page_redirect($_SESSION['getlastpage']);
}

function base_func_goToLastPage($data){
	goToLastPage();
}

/**
 * Goes to the url saved previously in the session
 */
 
function goToLastPage($msg = ""){
	$link = isset($_SESSION['getlastpage']) ? $_SESSION['getlastpage'] : "index.php";
	if(!$msg == ""){
		$link .= '&msg=' . $msg;
	}
	page_redirect($link);
}
 
 /** THIS IS THE OLDER FUNC -
function goToLastPage($msg = ""){
	$data = isset($_SESSION['getlastpage']) ? $_SESSION['getlastpage'] : null;
	//$newLink = '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?';
	$newLink = 'index.php?'; 
	
	if(isset($data)){
			foreach($data as $key=>$val){
			if($key != 'msg'){
				$newLink = $newLink . $key . "=" . $val . "&";
				}
		}
		$newLink = $newLink . 'msg=' . $msg;
	}
	
	//$newLink = $newLink . '">';
	//echo $newLink;
	page_redirect($newLink);
}
*/

/**
 * Returns the complete URL of the server.
 */
function get_serverURL() {
	$s = empty($_SERVER["HTTPS"]) ? ''
		: ($_SERVER["HTTPS"] == "on") ? "s"
		: "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
		: (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port;
}


/**
 * Returns the complete URL of the current page.
 */
function selfURL() {
	$s = empty($_SERVER["HTTPS"]) ? ''
		: ($_SERVER["HTTPS"] == "on") ? "s"
		: "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
		: (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}

/**
 * SLIIIDE TO THE LEFT!
 */
function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
}

/**
 * 
 * */
function buildPluginSectionsForm($plugins,$oldSections = "<none></none>"){
	
	$q = "SELECT * FROM modules_pluggable";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		$plugnames[$r['PLUGIN_NAME']] = $r['PLUGIN_DESCRIPTION'];
	}
	
	foreach($plugins as $i){
		$l = '<input type="checkbox" id="mod_plug_' . $i . '" name="mod_plug_' . $i . '" />';
		$l .= '<label for="">' . $plugnames[$i] . '</label>';
		echo $l;
	}
}

/**
 * todo: this can be a template file
 */
function buildLocationsForm($oldLocations = "<none></none>"){
	
echo '
	
Module Location:
<input type="checkbox" id="mod_loc-home" name="mod_loc-home"/>
<label for="mod_loc-home">Home</label>
<input type="checkbox" id="mod_loc-adminnav" name="mod_loc-adminnav"/>
<label for="mod_loc-adminnav">Admin Navbar</label>
<input type="checkbox" id="mod_loc-navbar" name="mod_loc-navbar"/>
<label for="mod_loc-navbar">Main Navigation</label>
<input type="checkbox" id="mod_loc-profile" name="mod_loc-profile"/>
<label for="mod_loc-profile">Profile</label>
<input type="checkbox" id="mod_loc-groups" name="mod_loc-groups"/>
<label for="mod_loc-groups">Groups</label>
<input type="checkbox" id="mod_loc-events" name="mod_loc-events"/>
<label for="mod_loc-events">Events</label>
<input type="checkbox" id="mod_loc-tests" name="mod_loc-tests"/>
<label for="mod_loc-tests">Tests</label>
<input type="checkbox" id="mod_loc-course_edit" name="mod_loc-course_edit"/>
<label for="mod_loc-course_edit">Course Edit Page</label>
';
}

/**
 * todo: move this to a template file and just include.
 */
function buildPermissionsForm($oldPermissions = "<none></none>"){
	/*
	echo '<div class="permissions_area_box" name="usersArea">';
	echo print_h1("Users: ");
	$query = "SELECT * FROM members";
	$result = sql_execute($query);
	while($row = sql_get($result)){
		echo '<input id="user-' . $row['ID'] . '" type="checkbox" name="add-user-' . $row['ID'] . '-' . $row['NAME'] . '" />' ;
		echo '<label for="user-' . $row['ID'] . '">' . $row['NAME'] . " " . $row['SURNAME'] .'</label>';
	}
	echo '</div>';
	br();
	*/
	echo '<div class="permissions_area_box fancyPress" name="groupsArea">';
	echo print_h1("Groups: ");
	$query = "SELECT * FROM groupslist";
	$result = sql_execute($query);
	while($row = sql_get($result)){
		$link = '<input id="group-' . $row['ID'] .'" type="checkbox" name="add-group-' . $row['ID'] . '-' . $row['NAME'] .'" ';
		if(xmlHasSpecifiedNode($oldPermissions,array('tagname'=>'group','id'=>$row['ID']))){
			$link .= ' checked ';
		}
		$link .= ' />';
		echo $link;
		echo '<label for="group-' . $row['ID'] .'">' . $row['NAME'] .'</label>';
	}
	echo '</div>';
	br();
	echo '<div class="permissions_area_box fancyPress" name="groupTypesArea">';
	echo print_h1("Group Types: ");
	$query = "SELECT * FROM groups_types";
	$result = sql_execute($query);
	while($row = sql_get($result)){
		echo '<input id="grouptype-' . $row['ID'] .'" type="checkbox" name="add-grouptype-' . $row['ID'] . '-' . $row['NAME'] . '" />';
		echo '<label for="grouptype-' . $row['ID'] .'">' . $row['NAME'] .'</label>';
	}
	echo '</div>';
	br();
	echo '<div class="fancyPress">';
	echo print_h1("Public: ");
	$link = '<input id="public" type="checkbox" name="add-public"';
	if(xmlHasSpecifiedNode($oldPermissions,array('tagname'=>'public'))){
			$link .= ' checked ';
		}
	$link .= ' />';
	echo $link;
	echo '<label for="public">' . "Public Access" .'</label>';
	echo '</div>';
}

/**
 * Log the user out and destroy the session
 */
function base_func_logout(){
	if(isset($GLOBALS['sqlcon'])){
		mysqli_close($GLOBALS['sqlcon']);
	}
    session_destroy();
	unset($_SESSION['userID']);
	page_redirect('index.php');
	return true;
}

/**
 * TODO: should also maybe refactor this and clean it up a bit
 */
function lostPassword2(){
	$identifiedBy = $_POST['usermail'];
	$identified = false;
			$query = "SELECT * FROM members WHERE email='$identifiedBy' LIMIT 1";
			$result = sql_execute($query);
			$count = sql_numrows($result);
			
	if($count == 1){
				$identified = true;
			}
			
			/*if($count != 1){
					$sqlquery = "SELECT * FROM members WHERE contactnum='$identifiedBy'";
					$result = mysql_query($sqlquery) or die("query failed");
					$newcount = mysql_num_rows($result);
				if($newcount != 1){
					echo "User not found. Please check your spelling and formatting and try again.";
				}else{
					$identified = true;
				}
			}else{
				$identified = true;
			}
			*/
		
	if($identified){
		
			$email = $identifiedBy;
			$req_time = time();
			$newcode = randomAlphaNum(9);
			
			$q = "DELETE FROM tmp_password_reset WHERE email='$email'";
			$insTemp = sql_execute($q);
			
			$q = "INSERT INTO tmp_password_reset(email,code,request_time) VALUES('$email','$newcode','$req_time')";
			$insTemp = sql_execute($q);
			
			$mailbody = 'A request has been logged to reset a password from this email address. Please enter the supplied code on the page you sent the request from to continue. <br/><br>' . print_bold($newcode);
			mail_inform($email, 'Site password reset request', $mailbody);
		
			$row = sql_get($result);
			echo print_bold('Please enter the code you will have received via e-mail:');
			//echo "Please answer the following security question:</br>";
			//echo $row['SECURITYQUESTION'];
			require ( TEMPLATE_PATH . "form_lostPassword2.php" );
			}else{
				page_redirect("index.php",'',array('SITE_ERROR_MSG'=>'The details you have supplied were invalid.'));
			}
}

/**
 * TODO: should refactor this function - name is slightly confusing
 */
function checkSecurityQ(){
		$typedAns = makeSafe($_POST['secAns']);
		$nameCell = makeSafe($_POST['identifier']);
		$query = "SELECT * FROM tmp_password_reset WHERE email='$nameCell'";
		//$query = "SELECT * FROM members WHERE email='$nameCell' LIMIT 1";
		$result = sql_execute($query);
		$count = sql_numrows($result);
		$row = sql_get($result);
		$dbAns = $row['CODE'];
		
		if(time() > $row['REQUEST_TIME'] + 3600){
			$q = "DELETE FROM tmp_password_reset WHERE email='$nameCell'";
			$d = sql_execute($q);
			page_redirect("index.php",'',array('SITE_ERROR_MSG'=>'The reset request from the specified adress has expired.'));
		}

if($dbAns == $typedAns){
	echo "Please enter a new password:";
	$_SESSION['nameCell'] = $nameCell;
	echo '
		<form name="newPassForm" method="post" action="index.php?action=updatePasswordOnly">
		<input type="text" name="newPass" id="newPass" >
		<input type="submit" name="submit" value="Update">
		</form>"';	
	$q = "DELETE FROM tmp_password_reset WHERE email='$nameCell'";
	$d = sql_execute($q);
	}else{
		sleep(5);
		echo "Supplied code was incorrect";
	}
}

/**
 * Updates the password for a user.
 * 
 * @param $newPass - the new password
 * @param $nameCell - email address of the user
 */
function updatePasswordOnly($newPass, $nameCell){
	$password = substr($nameCell,0,5) . $password;
	$password = hash("sha512",$newPass);
	//$nameCell = $_SESSION['nameCell'];
	$sql="UPDATE members SET password='$password' WHERE email='$nameCell' LIMIT 1";
	$r = sql_execute($sql);
	page_redirect("index.php?msg=editusersuccess");
}

/**
 * Log the visited URI to the users account
 * 
 * @param array GET data array
 * 
 */
function logAction($getDataSet,$customData = ""){
	if(!isset($_SESSION['userID'])){
		return false;
	}
	$q = "SELECT * FROM member_view_history WHERE uid='" . $_SESSION['userID'] . "' LIMIT 1";
	$r = sql_execute($q);
	if(sql_numrows($r) != 1){
		$qi = "INSERT INTO member_view_history (uid, history) VALUES ('" . $_SESSION['userID'] . "','<history></history>')";
		$ri = sql_execute($qi);
	}
	$row = sql_get($r);
	$xmlDoc = new DOMDocument();
		$data = $row['HISTORY'];
		if($data == ''){
			$data = "<history></history>";
		}
	$xmlDoc->loadXML($data);
	$rootNode = $xmlDoc->documentElement;
	
		$newNode = $xmlDoc->createElement("def");
		foreach($getDataSet as $key=>$val){
			$newNode->setAttribute($key,$val);
		}
		
		$newNode->setAttribute("time", date("Y-m-d-H-i-s"));
		$newNode->setAttribute("page", $_SERVER['SCRIPT_NAME']);
		if(is_array($customData)){
			foreach($customData as $key=>$val){
				$newNode->setAttribute($key,$val);
			}
		}
		$ref = $rootNode->appendChild($newNode);			
		
	$xmlData = $xmlDoc->saveHTML();
	$xmlData = mysqli_real_escape_string($GLOBALS['sqlcon'],$xmlData);
	$q = "UPDATE member_view_history SET history='$xmlData' WHERE uid='" . $_SESSION['userID'] . "'";
	$r = sql_execute($q);
	
	return true;
}

/**
 * Used in Test feature, check if the time of the last request is greater than the time
 * allowed by the test.
 * 
 */
function checkForTimeout($maxTime){
	$session_life = time() - $_SESSION['TimeoutStarted'];
	if(($maxTime != 0) && ($session_life > $maxTime)){
		return true;
	}else{
		return false;
	}
}

/**
 * Generate the default homepage.
 */
function defaultHome(){
	if(isset($_SESSION['userID'])) {
		$username = $_SESSION['userID'];
	
		// Check if first time logged in.
	if((isset($_SESSION['firsttime'])) && ($_SESSION['firsttime'] == 1)){
		$query = "UPDATE members SET FIRSTTIME='0' WHERE id='" . $username . "'";
		$r=sql_execute($query);
     }
	 //end firstime
	  loadPageModules("home");
	}else{
		//include("default_homepage.php");
		$q = "SELECT value FROM site_settings WHERE item='default_homepage' LIMIT 1";
		$d = sql_get(sql_execute($q));
		echo '<div class="defaultContent">' . $d['value'] . '</div>';
		if(SITE_OPEN_REGISTRATIONS == 'true'){
			include(TEMPLATE_PATH . "form_adduseritem.php");
		}
		echo '<br class="clear"/>';
		echo '<a href="open_course_loader.php">View our public content</a>';
	}
}

/**
 * Goes to the link specified
 * 
 * Parameters:
 * linkpage - url to navigate to
 * stamsg - msg from db to display
 */
function goToPage($linkpage,$statMsg = ""){
	$link = '<meta http-equiv="refresh" content="0;url='.$linkpage;
	if($link != ""){
	$link .= '?msg=' . $statMsg;
	}
	$link .= '">';
	echo $link;
}

/**
 * Refreshes HTML back to index
 * 
 * Parameters:
 * 	statmsg - a msg index from the stats table to display
 * 
 */
function goHome($statMsg = ""){
	$link = '<meta http-equiv="refresh" content="0;url=index.php';
	if($link != ""){
	$link .= '?msg=' . $statMsg;
	}
	$link .= '">';
	echo $link;
}

/**
 * 
 * @param $data
 */
function base_func_report_item($data){
	$msg = '';
	if(isset($data['offensive'])){$msg .= ' - Offensive';};
	if(isset($data['false'])){$msg .= ' - False / Misleading';};
	if(isset($data['copyright'])){$msg .= ' - Copyright Issues';};
	
	$subBy = (isset($_SESSION['userID'])) ? $_SESSION['userID'] : -1; 
	
	$msgBody = "One of the pages on the site has been reported as having content with the following issues: " . $msg . ' The short URL of the content is ' . $data['reporturl'];
	mail_informAdmin('Some of the site content has been reported to have issues','');
	
	//$q = "INSERT INTO flagged_items SET link='" . $data['reporturl'] . "' reasons='" . $msg . "'";
	$q = "INSERT INTO flagged_items(link,reasons,submitted_by) VALUES('".$data['reporturl']."','".$msg."','".$subBy."') ";
	$r = sql_execute($q);
	
	return true;
}

/**
 * Generates a random alphanumeric character.
 * NOTE: has a maximum maybe 12 (maybe 10) (maybe i need to be more specific)
 */
function randomAlphaNum($length){
    $rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36
    $rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36
    $base10Rand = mt_rand($rangeMin, $rangeMax);
    $newRand = base_convert($base10Rand, 10, 36); //convert it
   
    return $newRand;
}

/**
 * Used for online payments and such, converts the current USD rate to ZAR
 * for use of paypal and such where Rands aren't available
 */
function get_current_exchange_rate(){
	$renewData = true;
	$usdVal = 1;
	$zarVal = 1;
                
	$q = "SELECT * FROM site_settings WHERE item='usd-zar_rate' LIMIT 1";
	$d = sql_execute($q);
	
	if(sql_numrows($d) == 1){
		$r = sql_get($d);
		$values = explode(',', $r['VALUE']);
		
		$prevtime = $values[0];
		
		if(time() < ($prevtime + 43200)){ // 43200 = half a day
			$renewData = true;
		}
	}
	
	if($renewData){		
	//For this command you will need the config option allow_url_fopen=On (default)
    $XMLContent = file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
    //the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
			
	if($XMLContent == false){
		$usdVal = 1;
		$zarVal = 12;
		$exhangeVal = $usdVal / $zarVal;
	return $exhangeVal;
	}
				
    foreach($XMLContent as $line){
        if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){
            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a currency code
                //echo'1&euro;='.$rate[1].' '.$currencyCode[1].'<br/>';

				switch($currencyCode[1]){
					case 'USD':
						$usdVal = $rate[1];
						break;
					case 'ZAR':
						$zarVal = $rate[1];
						break;
				}
				
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------               
            }
        }
	}
		$exchangeVal = $usdVal / $zarVal;
		
		$q = "DELETE FROM site_settings WHERE item='usd-zar_rate'";
		$d = sql_execute($q);
				
		$dbEntry = time() . ',' . $exchangeVal;
		$q = "INSERT INTO site_settings (name,item,value) VALUES ('Current USD-ZAR Exchange Rate','usd-zar_rate','$dbEntry')";
		$d = sql_execute($q);
		
	}else{
		$exchangePrev = $values[1];
		$exchangeVal = $exchangePrev;
	}		
	 	
	return $exchangeVal;
}

/**
 * Attempts to check if the supplied URL is valid and accessible 
 *
 * @param
 * the full url of the site
 * 
 */
function check_is_valid_url ( $url ){
		$url = @parse_url($url);

		if ( ! $url) {
			return false;
		}
		$url = array_map('trim', $url);
		$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
		$path = (isset($url['path'])) ? $url['path'] : '';
		if ($path == '')
		{
			$path = '/';
		}
		$path .= ( isset ( $url['query'] ) ) ? "?$url[query]" : '';
		if ( isset ( $url['host'] ) AND $url['host'] != gethostbyname ( $url['host'] ) )
		{
			if ( PHP_VERSION >= 5 )
			{
				$headers = get_headers("$url[scheme]://$url[host]:$url[port]$path");
			}
			else
			{
				$fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);
				if ( ! $fp )
				{
					return false;
				}
				fputs($fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n");
				$headers = fread ( $fp, 128 );
				fclose ( $fp );
			}
			$headers = ( is_array ( $headers ) ) ? implode ( "\n", $headers ) : $headers;
			return ( bool ) preg_match ( '#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers );
		}
		return false;
}

/**
 * New common function to generate the xml used by the permissions system
 * 
 */ 
function common_set_permissions($access){
	$testRow['PERMISSIONS'] = "<access></access>";
	$docXML = new DOMDocument;
	$docXML->loadXML($testRow['PERMISSIONS']);
	$rootNode = $docXML->documentElement;

	foreach($access as $key=>$value){
				
		$ofValue = '';
		
		$commands = explode('-', $key);
		$action = $commands[0];
		if(isset($commands[1])){
			$ofType = $commands[1];
			if(isset($commands[2])){
				$ofValue = $commands[2];
			}
		}
		
		if($action == "add" && isset($ofType)){
			$childBase = $docXML->createElement("$ofType");
			if(isset($ofValue)){
				$childBase->setAttribute('id', $ofValue);
			}
			$childRef = $rootNode->appendChild($childBase);	
		}
		// not usable now - might be when permissions set becomes too large?
		/**
		if($action == "rem"){
		$nodeToRemove = null;
		foreach($rootNode->childNodes as $child){
		if($child->name == $ofType){
			if($child->hasAttributes()){
			foreach($child->attributes as $attr){
					if(($attr->value) == $ofValue) {
						 $nodeToRemove = $child; 
						 break;
					}
					}	
				}
			}
			}
		if ($nodeToRemove != null){
		$rootNode->removeChild($nodeToRemove);
		$newGroups = $docXML->saveHTML();
		}
			}
			*/	
	}
	$newDoc = $docXML->saveHTML();
	return $newDoc;
}

/**
 * 
 * Very quick and dirty function to change the extension of a file.
 * 
 * Using this as part of the Smarty Template Engine.
 * 
 */
function changeExtension($nameString, $newExt){
	$dir = pathinfo($nameString,PATHINFO_DIRNAME);
	$base = pathinfo($nameString,PATHINFO_FILENAME);
	
	$changedName = $dir;
	$changedName .=  '/' . $base;
	
	$changedName .= '.' . $newExt;
	
	return $changedName;
}

/**
 * A recursive directory scanning function
 * */
function scanMkDir($dir, $prefix = ''){
	$dir = rtrim($dir, '\\/');
	$result = array();

	foreach (scandir($dir) as $f) {
	  if ($f !== '.' and $f !== '..') {
		if (is_dir("$dir/$f")) {
		 $result[] = $prefix.$f;
		  $result = array_merge($result, scanMkDir("$dir/$f", "$prefix$f/"));
		 
		}
		else {
		 // $result[] = $prefix.$f;
		}
	  }
	}
	
	return $result;
}

/**
 * Gets the image to be used for the site logo in whichever standard format it may be
 * @TODO maybe i need to specify valid extensions?
 * */
function siteLogoUrl(){	
	chdir(dirname(__FILE__));
	
	$imgPath = 'media/';
	$scanPath = dirname(__FILE__) . '/media/';
	$picExt = '';
	
	$prefix ='';
 	$dir = $scanPath;
 	$result = array();
    foreach (scandir($dir) as $f) {
      if ($f !== '.' and $f !== '..') {
      	$filename = pathinfo($f, PATHINFO_FILENAME);
      	$ext = pathinfo($f, PATHINFO_EXTENSION);
		if('logo' == $filename){
			$picExt = $ext;
			break;
		}
      }
    }

	$imgPath .= 'logo' . '.' . $picExt;
	
	if(file_exists($imgPath)){
		//$link = '<img alt="" src="' . $imgPath . '"/>';
		$link = '<a href="index.php" class="fl_left sitelogo"><img alt="" src="' .$imgPath .'" /></a>';
	}else{
		$link = '<a href="index.php" class="fl_left sitelogo></a>';
	}
	return $link;
}
?>
