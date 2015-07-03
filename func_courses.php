<?php
/**
 * Basic course related functions used by the site.
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * @version 1.0.0
 */


/**
 * Adds a resource to the specified course.
 * 
 * @param data - Contains _POST data
 */
function courses_func_addResource($data){
//	$resname = $data['resource_name'];
//	$resurl = urlencode($data['resource_url']);
	$cid = makeSafe($data['cid']);

	$q = "SELECT ARTICLES FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
//	$newCXML = addNode($rd['ARTICLES'], 'resource', array('url'=>$resurl,'name'=>$resname));
	
	if($rd['ARTICLES'] == ''){
		$rd['ARTICLES'] = '<articles></articles>';
	}
	
	$res = new Resource_Handler();
	$res->importXML($rd['ARTICLES']);
	$newCXML = $res->addResource($data);

	$q = "UPDATE courses SET articles='" . $newCXML . "' WHERE id='$cid'";
	$r = sql_execute($q);
	return 'success';
}

/**
 * Removes a specified resource from the course.
 * 
 */
function courses_func_removeResource($data){
	if(isset($data['id'])){
		$nodeNum = $data['id'];
	}else{
		return false;
	}
	
	if(isset($data['cid'])){
		$cid = $data['cid'];
	}else{
		return false;
	}
	
	$q = "SELECT ARTICLES FROM courses WHERE id='$cid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$res = new Resource_Handler();
	$res->importXML($rd['ARTICLES']);
	$xmldata = $res->removeResource($nodeNum);
	
//	$xmldata = $rd['ARTICLES'];
//	$xmldata = rmNodeX($xmldata, $nodeNum);
	
	$q = "UPDATE courses SET articles='$xmldata' WHERE id='$cid'";
	$d = sql_execute($q);
	return 'success';
}

/**
 * Updates a specified course resource.
 */
function courses_func_updateResource($data){
	if(isset($data['resid'])){
		$nodeNum = $data['resid'];
	}else{
		return false;
	}
	
	if(isset($data['cid'])){
		$cid = $data['cid'];
	}else{
		return false;
	}
	
	$q = "SELECT ARTICLES FROM courses WHERE id='$cid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$resdata['resource_name'] = sql_escape_string($data['resource_name']);
	$resdata['resource_url'] = sql_escape_string($data['resource_url']);
	$resdata['resid'] = $nodeNum;
	
	
	$res = new Resource_Handler();
	$res->importXML($rd['ARTICLES']);
	$finalxml = $res->updateResource($resdata);
	
	$q = "UPDATE courses SET articles='$finalxml' WHERE id='$cid'";
	$d = sql_execute($q);
	return 'success';
}

/**
 * BETA
 * Returns the tags of a specified course.
 */
function courses_func_check_tags(){
	$tag = $_GET['tag'];
	return $tag;
}

/**
 * Expires a currently registered for course so the user can purchase it again
 * */
function courses_func_expireRegistration($data){
		$cid = $data['cid'];
		$uid = $data['uid'];
	
	if((!isUserRegisteredForCourse($uid,$cid))){
		return false;
	}
		$q = "SELECT * FROM course_registrations WHERE uid='$uid' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
		
		$newActive = $d['REGISTERED'];
		$newExpired = $d['EXPIRED'];
	
		if($newExpired = ''){
			$newExpired = '<expired></expired>';
		}
		
		$purchrefA = xmlGetSpecifiedNode($newActive, array('tagname'=>'pend','cid'=>$cid,'purchaseRef'=>''));
		$purchref = isset($purchrefA['purchaseRef']) ? $purchrefA['purchaseRef'] : '0';
	
		$curdate = date("Y-m-d-H-i-s");
		$newExpired = addNode($newExpired,'exp',array('cid'=>$cid,'regtime'=>$curdate,'purchaseRef'=>$purchref));
		
		$newActive = rmNode($newActive,'reg', $cid, 'cid');
				
		$q = "UPDATE course_registrations SET expired='$newExpired', registered='$newActive' WHERE uid='$uid'";
		$d = sql_execute($q);
		
		$q = "SELECT * FROM courses WHERE id='" .$cid ."' LIMIT 1";
		$r = sql_get(sql_execute($q));
		
		$msgbody = "Your registration to " . $r['NAME'] . " has expired. If you would like to continue having access to the course material, please reregister.";
		mail_informUser($uid,'Course registration expired',$msgbody);
		
		return 'success';
}

/**
 * Activates a pending request to a course.
 * 
 * @param $data Array with cid (course id) value and uid (user id)
 */
function courses_func_activateRequest($data){ //activate_user_to_course($cid, $uid){
		$cid = $data['cid'];
		$uid = $data['uid'];	
	
		$q = "SELECT * FROM course_registrations WHERE uid='$uid' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
		
		$newActive = $d['REGISTERED'];
		$newPending = $d['PENDING'];

		if($newActive == ""){
			$newActive = "<registrations></registrations>";
		}
	
		$purchrefA = xmlGetSpecifiedNode($newPending, array('tagname'=>'pend','purchaseRef'=>''));
		$purchref = isset($purchrefA['purchaseRef']) ? $purchrefA['purchaseRef'] : '0';
		
		if(!isUserRegisteredForCourse($uid,$cid)){
			$curdate = date("Y-m-d-H-i-s");
			$newActive = addNode($newActive,'reg',array('cid'=>$cid,'regtime'=>$curdate,'purchaseRef'=>$purchref));
		}

		if(isUserPendingForCourse($uid,$cid)){
			$newPending = rmNode($newPending,'pend',$cid, 'cid');
		}
			
							
		$q = "UPDATE course_registrations SET pending='$newPending', registered='$newActive' WHERE uid='$uid'";
		$r = sql_execute($q);
		
		$msgbody = "Congratulations! Your registration for a course has been approved and you can now access the material. We hope you enjoy this course!";
		mail_informUser($uid,'Course now open to you',$msgbody);
		return 'success';
}

/**
 * Register the selected user to the selected course
 * 
 * @param cid
 * @param uid
 * @param purchRef
 * @param captcha_code
 * @param no_catch
 */
function courses_func_registerForCourse($data){
	$cid = $data['cid'];
	$uid = (isset($data['uid'])) ? $data['uid'] : $_SESSION['userID'];
	//$paymentData = (isset($data['paymentData'])) ? $data['paymentData'] : null;
	$paymentData['purchRef'] = (isset($data['purchRef'])) ? $data['purchRef'] : null;
	$paymentData['captcha_code'] = (isset($data['captcha_code'])) ? $data['captcha_code'] : null;
		
		if((isUserRegisteredForCourse($uid,$cid)) || (isUserPendingForCourse($uid,$cid))){
			page_redirect('courses.php?f=viewCourses','',array('SITE_INFO_MSG'=>'You have already been registered or a request is still pending for your registration.'));
		}
		
		$q = "SELECT * FROM course_registrations WHERE uid='$uid' LIMIT 1";
		$r = sql_execute($q);
		if(sql_numrows($r) != 1){
			$q = "INSERT INTO course_registrations (uid, pending, registered) VALUES('$uid','<pending></pending>','<register></register>')";
			$r = sql_execute($q);
			$q = "SELECT * FROM course_registrations WHERE uid='$uid' LIMIT 1";
			$r = sql_execute($q);
		}
		
		$d = sql_get($r);
		
		$newPending = $d['PENDING'];
		
		if($newPending == ''){
			$newPending = "<pending></pending>";
		}
		
		// GOTCHA : the r and d vars for sql change here. didnt notice this. sat a while with an issue with this.
		//		it doesnt need to change, just watch out when adding new things.
		
		$q = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
		
		//if($d['AUTOJOIN'] != 1 && $d['PRICE'] != 0){
	//		page_redirect('courses.php?f=paymentForm&cid=' . $cid);
	//		}
		
		if(is_array($paymentData)){
		
			if(isset($paymentData['purchRef'])){
				$purchRef = makeSafe($paymentData['purchRef']);
			}
			if(isset($paymentData['captcha_code'])){
				require_once('scripts/securimage/securimage.php');
	 			$securimage = new Securimage(array('session_name'=>'lmsID' . SUBDOMAIN_NAME));
	 			//$securimage->session_name = 'lmsID' . SUBDOMAIN_NAME; //$GLOBALS['site_session_name'];//session_name();
	 			echo $paymentData['captcha_code'];
	 			//var_dump( $securimage->getCode(true,true));
				if($securimage->check($paymentData['captcha_code']) === false){
		 			 echo "The security code entered was incorrect.<br /><br />";
		 			 echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
		 			 exit;
		 			 //return false;
				}else{
					$catch = true;
				}
			}
			
			if(isset($data['no_catch'])){
				$catch = true;
			}
			
			if(isset($purchRef) && $catch === true){	
				$newPending = addNode($newPending,'pend',array('cid'=>$cid,'purchaseRef'=>$purchRef));
				$q = "UPDATE course_registrations SET pending='$newPending' WHERE uid='$uid'";
				$d = sql_execute($q);
			//	var_dump($newPending);
				$msgbody = "A user is requesting to be registered for a paid course. <br/>Details: Purchase Ref: " . $purchRef;
				mail_informAdmin('User requesting registration for paid course.',$msgbody);
				page_redirect('courses.php?f=viewCourses','',array('SITE_INFO_MSG'=>'A request for your registration has been sent to the course administrator.'));	
				return true;
			}
		}
		
		if($d['PRICE'] == 0 && $d['AUTOJOIN'] != 1){
			$newPending = addNode($newPending,'pend',array('cid'=>$cid));
			$q = "UPDATE course_registrations SET pending='$newPending' WHERE uid='$uid'";
			$d = sql_execute($q);	
			
			$msgbody = "A user is requesting to be registered for a course. Details:";
			mail_informAdmin('User requesting registration for course.',$msgbody);
			page_redirect('courses.php?f=viewCourses','',array('SITE_INFO_MSG'=>'A request for your registration has been sent to the course administrator.'));
		}		
		
		if($d['AUTOJOIN'] == 1 && $d['PRICE'] == 0){
			courses_func_activateRequest(array('uid'=>$uid,'cid'=>$cid));
			page_redirect('courses.php?f=displayCourse&cid=' . $cid);
		}
		return 'success';
}

/**
 * @param $data - Array containing all the variables needed
 * courseName
 * courseDescription
 * courseIntroContent
 * publishedStatus
 * autojoin - as POST
 * price
 * tags (array)
 * open_for_d
 * open_for_m
 * open_for_y
 * open_since_d
 * open_since_m
 * open_since_y
 * open_till_d
 * open_till_m
 * open_till_y
 */
function courses_func_addCourse($data){
	$newcourse = new ALMS_CourseItem;
	$res = $newcourse->insertNew($data);

	set_course_permissions($res['id'], $data);
	
	$plugDataSet = modules_backend_plugin_stripData($data);

	if(modules_backend_plugin_addData($plugMid,$plugCol,$plugName,$plugData)){
			//nice
	}

	if($res['published'] == 1){
		inform_users_aboutNewCourse($res['id']);
	}
	
	return 'success';
}

/**
 * Updates a course with the new info submitted via form
 * @param $data - Array of all the needed variables.
 */
function courses_func_updateCourse($data){
	$cid = $data['id'];
	$courseName = makeSafe($data['courseName']);
	$courseDesc = sql_escape_string( $data['courseDescription']);
	$htmlContent = sql_escape_string($data['courseIntroContent']);
	$publishedStatus = makeSafe($data['publishedStatus']);
	
	if(isset($_POST['autojoin'])){
		$autojoin = 1;
	}else{
		$autojoin = 0;
	}
	
	$pubStat = 0;
	if($publishedStatus == "Yes"){
		$pubStat = 1;
		$publishedDate = date("Y-m-d-H-i-s");
	}
	
	$courseCode = makeSafe( $data['courseCode'] );
	$dateCreated = date("Y-m-d-H-i-s");
	$publishedBy = $_SESSION['userID'];
	$partime = makeSafe($data['partime']);
	$partime = preg_replace( "/[^0-9]/", "", $partime );
	$price = makeSafe($data['price']);
	$price = preg_replace( "/[^0-9]/", "", $price );
	
	$ntags = makeSafe($data['tags']);
	$tags = preg_replace('/\s+/', ' ', trim($ntags));
	
	$availForDays = strip_alpha_chars(makeSafe($data['open_for_d']));
	$availForMonths = strip_alpha_chars(makeSafe($data['open_for_m']));
	$availForYears = strip_alpha_chars(makeSafe($data['open_for_y']));
	$availFor = $availForDays . '-' . $availForMonths .'-' . $availForYears;
	
	$avBetweenSinceDay = strip_alpha_chars(makeSafe($data['open_since_d']));
	$avBetweenSinceMonth = strip_alpha_chars(makeSafe($data['open_since_m']));
	$avBetweenSinceYear = strip_alpha_chars(makeSafe($data['open_since_y']));
	$avBetweenSince = $avBetweenSinceDay .'-' . $avBetweenSinceMonth .'-'. $avBetweenSinceYear;
	
	$avBetweenTillDay = strip_alpha_chars(makeSafe($data['open_till_d']));
	$avBetweenTillMonth = strip_alpha_chars(makeSafe($data['open_till_m']));
	$avBetweenTillYear = strip_alpha_chars(makeSafe($data['open_till_y']));
	$avBetweenTill = $avBetweenTillDay .'-'. $avBetweenTillMonth .'-' . $avBetweenTillYear;
	
	$avBetweenDates = $avBetweenSince . '%' . $avBetweenTill;
	
	$q = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	if($d['MODIFIED_DATE'] == ""){
		$rXMLdata = "<modified></modified>";
	}else{
		$rXMLdata = $d['MODIFIED_DATE'];
	}
	$modificationdata = addNode($rXMLdata,'updated',array('uid'=>$_SESSION['userID'],'time'=>$publishedDate,));
	
	$query="UPDATE courses SET
	name='$courseName',
	description='$courseDesc',
	html_content='$htmlContent',
	created_date='$dateCreated',
	published_date='$publishedDate',
	published_user='$publishedBy',
	published_status='$pubStat', 
	code='$courseCode',
	par_hours='$partime',
	modified_date='$modificationdata',
	autojoin='$autojoin',
	price='$price',
	tags='$tags',
	avail_for='$availFor',
	avail_during='$avBetweenDates'
	WHERE id='$cid'";
	$result = sql_execute($query);

	$q = "SELECT * FROM courses WHERE published_date='$publishedDate' AND name='$courseName'";
	$r = sql_get(sql_execute($q));
	
	set_course_permissions($r['ID'], $data);

	$plugDataSet = modules_backend_plugin_stripData($data);

	if(modules_backend_plugin_updateData($plugMid,$plugCol,$plugName,$plugData)){
		//nice
	}
	
	if($pubstat == 1){
		inform_users_aboutNewCourse($cid);
	}
	
	return 'success';
}

/**
 * Sets the permissions for access to a given course.
 * 
 */
function set_course_permissions($id, $access){
if(!check_user_permission('content_modify')){
	return false;
	}
	/**
	$query = "SELECT * FROM courses WHERE id='$id' LIMIT 1";
	$result = sql_execute($query);
	$testRow = sql_get($result);
	
	$docXML = new DOMDocument;
	
	if($testRow['PERMISSIONS'] == ""){
		$testRow['PERMISSIONS'] = "<access></access>";
	}
	
	 * 
	 */
	
	$newDoc = common_set_permissions($access);
	
	$query = "UPDATE courses SET permissions='$newDoc' WHERE id='$id'";
	$result = sql_execute($query);
	
	return true; //no need to return though
}

/**
 * Checks wether a selected group has access to specified course content.
 */
function groupHasCoursePermission($groupID, $courseID){
	$q = "SELECT PERMISSIONS FROM courses WHERE id='$courseID' LIMIT 1";
	$d = sql_get(sql_execute($q));
	
	$stat = xmlHasSpecifiedNode($d['PERMISSIONS'], array('tagname'=>'group','id'=>$groupID));
	return $stat;	
}

/**
 * Checks wether a selected user has access to specified course content.
 * Wraps XML function
 */
function userHasCoursePermission($memberID, $courseID){
	$q = "SELECT * FROM courses WHERE id='$courseID' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$xmldata = $d['PERMISSIONS'];
 	return userHasCoursePermissionXML($memberID,$xmldata);
}

/**
 * Checks wether a selected group has access to specified course content.
 * Function checks XML data
 */
function userHasCoursePermissionXML($memberID,$xmldata){
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($xmldata);
	$xmlDocRoot = $xmlDoc->documentElement;
	$hasAccess = false;
	
	foreach($xmlDocRoot->childNodes as $option){
		$name = $option->tagName;
		if($name == "public"){
			$hasAccess = true;
			break;
		}
		
		if($name == "time"){
			$hasAccess = true;
			break;
		}

		if($name == "group"){
			if(isUserInGroup(($memberID),($option->getAttribute("id")))){
			$hasAccess = true;
			break;
		}
		}
		
/*
		if($name == "grouptype"){
			if(isUserInGroup(($memberID),($option->getAttribute("id")))){
			$hasAccess = true;
			break;
		}
		}
*/
	}
	return $hasAccess;
}

/**
 * @param $uid - Id of the user to check
 * @param $cid - id of the course to check
 * */
function userHasCourseTime($uid,$cid){
	// set up all the data needed to asses
	$q = "SELECT registered FROM course_registrations WHERE uid='$uid' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$regXML = $r['registered'];
	$userRegNode = xmlGetSpecifiedNode($regXML,array('tagname'=>'reg','cid'=>$cid,'regtime'=>''));
	$userRegTime = $userRegNode['regtime'];
	$regTimeArr = explode('-',$userRegTime);
	
	$q = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$timeAvail = $r['AVAIL_FOR'];
	$timeDuring = $r['AVAIL_DURING'];
	
	$thisTime = date("d-m-Y");
	$curTime = explode('-',$thisTime);
	for($x = 0;$x < sizeof($curTime); $x++){
		$curTime[$x] = $curTime[$x] + 0;
	}
	
	$avBetDates = explode('%',$timeDuring);
	$avFor = explode('-',$timeAvail);

	if($avFor[0] == 0 && $avFor[1] == 0 && $avFor[2] == 0){
		$avFor[0] = 999;
		$avFor[1] = 999;
		$avFor[2] = 9999;
	}

	if(!isset($avFor[0])){$avFor[0] = 999;}
	if(!isset($avFor[1])){$avFor[1] = 999;}
	if(!isset($avFor[2])){$avFor[2] = 9999;}

	for($x = 0;$x < sizeof($avFor); $x++){
		$avFor[$x] = $avFor[$x] + 0;
	}

	$avBetSince = explode('-',$avBetDates[0]);
	$avBetTill = isset($avBetDates[1]) ? explode('-',$avBetDates[1]) : null;
	
	if(!isset($avBetSince[0])){$avBetSince[0] = 0;}
	if(!isset($avBetSince[1])){$avBetSince[1] = 0;}
	if(!isset($avBetSince[2])){$avBetSince[2] = 0;}
	
	if(!isset($avBetTill[0]) || $avBetTill[0] == 0){$avBetTill[0] = 999;}
	if(!isset($avBetTill[1]) || $avBetTill[1] == 0){$avBetTill[1] = 999;}
	if(!isset($avBetTill[2]) || $avBetTill[2] == 0){$avBetTill[2] = 99999;}
		
	for($x = 0;$x < sizeof($avBetSince); $x++){
		$avBetSince[$x] = $avBetSince[$x] + 0;
	}	
	
	for($x = 0;$x < sizeof($avBetTill); $x++){
		$avBetTill[$x] = $avBetTill[$x] + 0;
	}
	// done setting up - finally start checking
	
	//checks if current time in bounds
	if(($curTime[2] < $avBetSince[2]) || ($curTime[2] > $avBetTill[2])){
		return false;
	}else{
		$stillduringyear = true;
		if($curTime[2] == $avBetSince[2]){$sameyearsince = true;}else{$sameyearsince = false;}
		if($curTime[2] == $avBetTill[2]){$sameyeartill = true;}else{$sameyeartill = false;}
	}
	
	if((($curTime[1] < $avBetSince[1]) && $sameyearsince) || ($sameyeartill && ($curTime[1] > $avBetTill[1]))){
		return false;
	}else{
		$stillduringmonth = true;
		if($curTime[1] == $avBetSince[1]){$samemonthsince = true;}else{$samemonthsince = false;}
		if($curTime[1] == $avBetTill[1]){$samemonthtill = true;}else{$samemonthtill = false;}
	}
	
	if((($curTime[0] < $avBetSince[0]) && $samemonthsince) || ($samemonthtill &&($curTime[0] > $avBetTill[0]))){
		return false;
	}
	
	// checks if year expired
	
	$expiredSecs = time();
	$neededSecs = $avFor[0] * 24 * 60 * 60;
	$neededSecs = $neededSecs + ($avFor[1] * 30 * 24 * 60 * 60);
	$neededSecs = $neededSecs + ($avFor[2] * 365 * 24 * 60 * 60);
	$registeredTime = mktime($regTimeArr[3],$regTimeArr[4],$regTimeArr[5],$regTimeArr[1],$regTimeArr[2],$regTimeArr[0]);
	
	if($expiredSecs > ($registeredTime + $neededSecs)){
		return false;
	}
	
	return true;
}

/**
 * @todo: the function itself seems to work now, so maybe integrate it into somewhere
 */
function make_certificate($certificateBody, $user){
	//$svg = SVGDocument::getInstance( $certificateBody );
	chdir(dirname(__FILE__));
	$svg = new SVGDocument(file_get_contents($certificateBody));
	$style = new SVGStyle($svg); 
	#set fill and stroke
	$style->setFill('#f2f2f2');
	$style->setStroke('#e1a100');
	
	$svg->addShape( SVGText::getInstance( 120, 250, 'myText', 'This is a text', $style) ); #create a text
	$svg->addShape( SVGPath::getInstance( array('m 58,480','639,1'), 'myPath', 'fill:none;stroke:#000000;stroke-width:1px;') );#create a path
	
	#many types of output
	$svg->asXML('output.svg'); #svg
	//$svg->export('output.png'); #png
	//$svg->export('output/output.jpg'); #jpg
	//$svg->export('output/output.gif'); #gif
	//$svg->export('output/thumb16x16.png',16,16,true); #png resized using imagemagick
	//$svg->export('output/thumb32x32.png',32,32,true);
	//$svg->export('output/thumb64x64.png',64,64,true);
	
	#output to browser
	$svg->output(); //to browser, with
	return true;
}
