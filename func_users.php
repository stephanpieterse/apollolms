<?php
/**
 * Basic user functions.
 * 
 * @todo Most of these should be moved to a class for users.
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
/**
 * Checks if the current person accessing the site is logged in
 * */
function is_user_loggedIn(){
	if(isset($_SESSION['userID'])){
		return true;
	}else{
		return false;
	}
}

/**
 * Checks login details, then redirects or returns an error.
 */
function login_func_checkLogin($data){
	$user = $data['username'];
	$pass = $data['password'];
	$fromwhere = isset($data['fromURL']) ? $data['fromURL'] : null;
	
	$password = $pass;
	$username = makeSafe($user);
	$passwordref = $password;	
	$passwordref = hash('sha512',$passwordref);
	$password = substr($username,0,5) . $password;
	$password = hash('sha512',$password);

	$q = "SELECT * FROM members WHERE email='$username' LIMIT 1";
	$r = sql_execute($q);
	$c = sql_numrows($r);
	
	if($c == 0){
		return "wronguser";
	}

	$sql="SELECT * FROM members WHERE email='$username' and password='$passwordref' LIMIT 1";
	$result = sql_execute($sql);
	$count = sql_numrows($result);

	if($count==1){
		$sql = "UPDATE members SET password='$password' WHERE email='$username'";
		$result = sql_execute($sql);
	}

	$sql="SELECT * FROM members WHERE email='$username' and password='$password' LIMIT 1";
	$result=sql_execute($sql);
	$count = sql_numrows($result);

	if($count==1){
	//mysql_data_seek($result,0);
	$rows = sql_get($result);
	$role = $rows['ROLE'];
	$firsttimetest = $rows['FIRSTTIME'];
	$_SESSION['userID'] = $rows['ID'];
	$userID = $rows['ID'];
	$_SESSION['username'] = $rows['NAME'] . " " . $rows['SURNAME'];
	//$_SESSION['role'] = $role;
	$_SESSION['firsttime'] = $firsttimetest;
	$curdate = date("Y-m-d-H-i-s");
	$sql="UPDATE members SET lastlogin='$curdate' WHERE id='$userID'";
	$result=sql_execute($sql);
	//goHome();
	//echo 'Please wait while redirecting your login... if the page does not redirect please click <a href="index.php">here</a>';
	if(isset($fromwhere)){
		page_redirect($fromwhere);
	}else{
		return true;
	}
}else{
	sleep(3);
	return "wrongpassword";
	}
}

/**
 * 
 * Paramaters: Id of user, ID of course.
 * 
 * Checks the db if the current user is pending a request to be
 * registered for the current course.
 * 
 * Returns true/false
 */
function isUserPendingForCourse($uid, $cid){
	$q = "SELECT * FROM course_registrations WHERE uid='$uid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$isPending = false;
	
	$pendData = $d['PENDING'];
	
	if($pendData == ""){
		$pendData = "<pending></pending>";
	}
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($pendData);
	$rootNode = $xmlDoc->documentElement;
				
	foreach($rootNode->childNodes as $ci){
		if($ci->getAttribute('cid') == $cid){
			$isPending = true;
			break;
		}
	}
	return $isPending;
}

/**
 * 
 * Paramaters: Id of user, ID of course.
 * 
 * Checks the db if the current user is registered for the current course.
 * Returns true/false
 */
function isUserRegisteredForCourse($uid, $cid){
	$q = "SELECT * FROM course_registrations WHERE uid='$uid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$isRegistered = false;
	
	$regData = $d['REGISTERED'];
 //	$pendData = $d['PENDING'];
	
	if($regData == ""){
		$regData = "<registered></registered>";
	}
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($regData);
	$rootNode = $xmlDoc->documentElement;
				
	foreach($rootNode->childNodes as $ci){
		if($ci->getAttribute('cid') == $cid){
			$isRegistered = true;
			break;
		}
	}
	return $isRegistered;
}

/**
 * 
 * Parameters: path to file , extra data
 * 
 * reads a csv file and adds the details to the user database.
 * 
 * extra options:
 * 	addToGID : id of group to automatically add all users to
 * 
 * doesn't return anything
 */
function importCSVFileToUser($file, $extra){
	
	$ext = pathinfo($file['uploadedfile']['name'], PATHINFO_EXTENSION);
	if(($ext != 'csv')){
		return false;
	}
	
	$fileDat = fopen($file['uploadedfile']['tmp_name'], 'r');
	
	$totalrecords = 0;
	
	while(!feof($fileDat)){
		$totalrecords++;
	
		$line = fgets($fileDat);
		$csvArr = translateCSVtoUser($line);
		//var_dump($csvArr);
		$csvArr['randomPass'] = 1;
		
		if(isset($extra['autogroup'])){
		$gid = makeSafe($extra['autogroup']);
		$addtogid = explode('-',$gid);
		$csvArr['addToGID'] = $addtogid[0];
	}else{
		$csvArr['addToGID'] = 0;
		}
		
		$stat = users_func_addUserItem($csvArr, array('nomail_admin'=>'1'));
		if ($stat != true){ echo $stat; echo $csvArr['emailad']; $totalrecords--;}
		}
		br();
		echo "Import completed. " . $totalrecords . " items imported.";
		
		$mailBody = $totalrecords . " new users have been imported to the site by user id " . $_SESSION['userID'];
		mail_informAdmin('New users have been added', '');
		return true;
}

/**
 * Parameters:
 * one live of comma seperated data
 * 
 * returns array containing
 * name (name + surname)
 * emailad
 * contactnum
 */
function translateCSVtoUser($csvData){
	//format: name, surname, email, contact number,
	$dataArr = explode(',',$csvData);
	
	$retDat['name'] = $dataArr[0] . ' ' . $dataArr[1];
	$retDat['emailad'] = $dataArr[2];
	$retDat['contactnum'] = $dataArr[3];
	
	return $retDat;
	}

/**
 * Paramaters: width (default 50), user id for pic (default current user)
 * 
 * returns an img tag linked to the profile pic
 */
function showProfilePic($width = '50', $picUID = 0){
	if($picUID === 0){
		$picUID = $_SESSION['userID'];		
	}
	
	chdir(dirname(__FILE__));
	
	$imgPath = 'members/profile_images/';
	$scanPath = dirname(__FILE__) . '/members/profile_images/';
	// . $picUID . '';
	$picExt = '';
	
	$prefix ='';
 	//$dir = rtrim($imgPath, '\\/');
 	$dir = $scanPath;
 	$result = array();
    foreach (scandir($dir) as $f) {
      if ($f !== '.' and $f !== '..') {
      	$filename = pathinfo($f, PATHINFO_FILENAME);
      	$ext = pathinfo($f, PATHINFO_EXTENSION);
		if($picUID == $filename){
			$picExt = $ext;
			break;
		}
      }
    }

	$imgPath .= $picUID . '.' . $picExt;
	
	if(file_exists($imgPath)){
		$link = '<img alt="Edit Profile" class="roundImage" src="' . $imgPath . '" width="' . $width . '"/>';
	}else{
		$q = "SELECT GENDER FROM members WHERE id='" . $picUID . "'";
		$r = sql_execute($q);
		$d = sql_get($r);
		
		if($d['GENDER'] == 0){
			$picN = 'male.png';
			}else{
			$picN = 'female.png';
				}
		
		$link = '<img alt="' . $picN . '"style="background: #ffffff; float:right; margin: 10px;" src="members/profile_images/' . $picN . '" width="' . $width . '"/>';
	}
	return $link;
}

/**
 * Sends a verification password to an email address.
 * 
 * @todo - Implement this completely
 * */
function set_tempEmailVerify($email){
	$code = randomAlphaNum(8);
	$timestamp = time();
	
	$q = "SELECT id FROM tmp_email_validation WHERE email='$email'";
	$d = sql_execute($q);
	
	if(sql_numrows($d) == 1){
		$q = "UPDATE tmp_email_validation SET code='$code' WHERE email='$email'";
		$d = sql_execute($q);
	}else{
		$q = "INSERT INTO tmp_email_validation (email,code,request_time) VALUES ('$email','$code','$timestamp')";
		$d = sql_execute($q);
	}

	$msgbody = 'A request has been made to our site for you to be registered as a user. Please enter the following code when prompted at the site: <br/> <p>' . $code . '</p>';
	mail_inform($email,'E-mail address confirmation', $msgbody);
	
	return true;
}

function login_func_addUserItem($data){
	return users_func_addUserItem($data);
}

/**
 * possible tags:
 * 		nomail_admin - doesnt inform the admin user of the site
 * 
 */
function users_func_addUserItem($data, $tags = null){
	$retval = true;
	
	if(isset($data['randomPass']) && $data['randomPass'] == 1){
		$password = randomAlphaNum(9);
		$passwordref = $password;
	}else{
		$password=$data['password'];
		$passwordConf = $data['confirmpassword'];
		$passwordref = $password;
	}
	
	$name=makeSafe($data['name']);
	//$surname=makeSafe($_POST['surname']);
	$emailad=($data['emailad']);
	$role= "User"; //$_POST['role'];
	$contactnum=makeSafe($data['contactnum']);
	$secuQ  = 'NA';//makeSafe($data['securityQ']);
	$secuA = 'NA';//makeSafe($data['securityA']);
	
	if((isset($data['addToGID'])) && ($data['addToGID'] != 0)){
		$groups = '<groups><group id="' . $data['addToGID'] . '"></group></groups>';
	}else{
		$groups = "<groups></groups>";
	}
	
	$loginPass = $password;
	$password = substr($emailad,0,5) . $password;
	$password = hash('sha512',$password);

	$firsttime = 1;
	$canadduser = true;
	$allfieldscorrect = true;

	$sql="SELECT * FROM members WHERE email='" . $emailad . "' LIMIT 1";
	$result = sql_execute($sql);
	while ($row = sql_get($result)){
	    if($emailad == $row['EMAIL']){
	        $canadduser = false;
	        break;
	    }
	}
	
	//$allfieldscorrect = (check_email_address($emailad) && check_cellphone_number($contactnum) && ($passwordref == $passwordConf));
	$allfieldscorrect = (check_email_address($emailad) && ($passwordref == $passwordConf));

	if($canadduser){
		if($allfieldscorrect){
			$regdate = date("Y-m-d-H-i-s");
			$sql="INSERT INTO members(regdate, password, name, email, role, contactnum, firsttime, securityquestion, securityanswer, groups)VALUES('$regdate','$password', '$name', '$emailad', '$role', '$contactnum', '$firsttime', '$secuQ', '$secuA', '$groups')";
			$result=sql_execute($sql);
				
			if((isset($tags) && !isset($tags['nomail_admin'])) || !isset($tags)){
					$msgBody = "A new user has registered on your site! Name: $name";
					mail_informAdmin('New User Registered',$msgBody);
			}
			$msgBody = "You have been succesfully registered on the site. Your details are as follows:<br/>Username: " . $emailad . " <br/>Password: " . $passwordref . ". <br/> Be sure to save this e-mail for future reference." ;
			mail_inform($emailad,'Welcome',$msgBody);
			
			if(($data['shouldLogin'] == 1) || ($data['shouldLogin'] == true)){
				//checkLogin($emailad, $loginPass);
				return login_func_checkLogin(array('username'=>$emailad,'password'=>$passwordref));				
			}
		}else{
		//	$retval = "Some of the required fields are incorrect. Please make sure you are using a valid email address and that the passwords you have entered match.";
			return "err_register_invalid_data";
		}
	}else{
	//$retval = "The e-mail you have entered is already in use, please choose another and try again."; 
	$retval = "err_register_email_taken";
	}
	return $retval;
}

/**
 * updates the member with the appropirate new fields
 * 
 * @param $data - $_POST data and a uid merged with it if not part of the original data set.
 * 
 */
function users_func_updateUserItem($data){
	$uid = $data['uid'];
	
	$q = "SELECT EMAIL FROM members WHERE id='$uid'";
	$r = sql_execute($q);
	$d = sql_get($r);
	$oldEmail = $d['EMAIL'];

	$name= makeSafe($data['name']);
	$emailad=makeSafe($data['emailad']);
	
	$q = "SELECT * FROM roles";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		$roles[$r['ROLENAME']] = $r['ID'];
	}
	
	$role = (isset($roles[$data['role']])) ? $roles[$data['role']] : '0';
	$contactnum=makeSafe($data['contactnum']);
	//$secuQ  = makeSafe($data['securityQ']);
	//$secuA = makeSafe($data['securityA']);
	
	$birthYear = makeSafe($data['birthy']);
	$birthMonth = makeSafe($data['birthm']);
	$birthDay = makeSafe($data['birthd']);
	
	$birthDate = $birthYear . '-' . $birthMonth . '-' . $birthDay;
	
	if($data['gender'] == 'Female'){
			$gender = 1;
		}else{
			$gender = 0;
			}
	
	if($oldEmail != $emailad){
		$msgBody = "Your details have been updated on the site. Updates as follows:<br/>E-Mail: " . $emailad . " <br/><br/>. If you did not request this change, please notify the systems administrator" ;
		mail_inform($emailad,'Details updated',$msgBody);
		$msgBody = "Your details have been updated on the site, and one of them was your e-mail address. Your e-mail was updated to " . $emailad . ". If you did not request this change, please message your site administrator to revoke the change." ;
		mail_inform($oldEmail,'Details updated',$msgBody);
	}
			// removed securityquestion='$secuQ', securityanswer='$secuA',
	$sqlqueryA = "UPDATE members SET name='$name', email='$emailad', contactnum='$contactnum', role='$role', gender='$gender', birthdate='$birthDate' WHERE id='$uid'";
	$result = sql_execute($sqlqueryA);
	
//	page_redirect("users.php?f=admin_UserManage");
	return "success";
}

function users_func_updateGroupsOnly($data){
	$uid = $data['uid'];
	
	$newGroupsData = common_set_permissions($data);
	
	$sqlqueryA = "UPDATE members SET groups='" . $newGroupsData . "' WHERE id='$uid'";
	$result = sql_execute($sqlqueryA);
	
	return "success";
}

/**
 * Uploads a file as the users profile picture
 * 
 * @param $filedata A passed $_FILES array
 * */
function upload_ProfilePicture($filedata){
	if($filedata['uploadedfile']['error'] == 1){
		return false;
	}
	
	chdir(dirname(__FILE__));
	include(SCRIPTS_PATH . 'thumbFunc.php');
	
	$target_path = "members/profile_images/";
	$ext = strtolower(pathinfo($filedata['uploadedfile']['name'], PATHINFO_EXTENSION));

	$picExtensions = array('jpg','jpeg','png');
	if(in_array($ext, $picExtensions)){

	$target_path = $target_path . $_SESSION['userID'] . '.';//basename( $_FILES['uploadedfile']['name']);

	foreach($picExtensions as $extTest)
	if(file_exists($target_path.$extTest)){
		unlink($target_path.$extTest);
	}
	
	$target_path .= $ext;
	
	//if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	if(saveThumb($filedata['uploadedfile']['tmp_name'], $target_path,256,256)){
	//echo "Your profile picture has been successfully uploaded.";
		return "success";
	} else{
	//echo "There was an error uploading your image, please try again!";
		return "err_upload";
	}
	}else{
		//echo "The file needs to be of image format png or jpeg.";
		return "err_photo_format";
	}	
}
