<?php
/**
 * @description
 * Class to handle the course packages
 * 
 * Usage:
 * load course package id
 * select user
 * generate purchref
 * register to courses
 * 
 * 
 * @author Stephan
 * @package ApolloLMS
 * @version 1.0.0
 */

class course_package{
	
	private $courseInfo = array(); 
	private $loadedID = 0;
	private $user = 0;
	private $packPurchRef = 0;
	
	function select_user($uid){
		$this->user = $uid
		return true;
	}
	
	function load($id){
		
		$q = "SELECT * FROM course_packages WHERE id='$id' LIMIT 1";
		$d = sql_execute($q);
		$this->courseInfo = sql_get($d);
		$this->loadedID = $id;
		
		return true;
		
	}
	
	function update_package($name, $includesArray, $cost, $tags, $html_content, $code){
		if($loadedID == 0){
			return 'No package loaded';
		}
		
		$includes = implode(',', $includesArray);
		$q = "UPDATE course_packages SET name='$name', includes='$includes', cost='$cost' WHERE id='" . $this->loadedID . "'";
		$d = sql_execute($q);
		
		$this->courseInfo = sql_get($d);
		
		return true;
	}
	
	function new_package($name, $includesArray, $cost, $tags, $html_content, $code){
		$includes = implode(',', $includesArray);
		$q = "INSERT INTO course_packages (name,includes,cost,tags,code,description) VALUES('$name','$includes','$cost','$tags','$code','html_content')";
		$d = sql_execute($q);
		
		$this->courseInfo = sql_get($d);
		
		$q = "SELECT ID FROM course_packages WHERE name='$name' AND includes='$includes' AND cost='$cost' AND tags='$tags' AND code='$code' AND description='$html_content'";
		$d = sql_execute($q);
		$retID = sql_get($d);
		
		$this->loadedID = $retID['ID'];
		return true;
	}
	
	function get_package_details(){
		return $this->courseInfo;
	}
	
	function generate_packPurhref(){
		$q = "SELECT name FROM members WHERE id='".$this->user."' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
	
		$username = $d['name'];
	
		$coursename = $this->courseInfo['NAME'];
		
		// ={userID}{p}{courseID}{usernameFirst3Digits}{coursenameFirst3Digits}{first5digits of ids hashed}
		$userandcourse = $this->user .'p'. $this->loadedID;
		$newRef =  $userandcourse . substr($username,0,3) . substr($coursename,0,3) . substr(hash("sha256",$userandcourse),0,5);
		return $newRef;
	}
	
	function register_user_to_package(){
		if($this->user == 0){
			echo "No user was selected";
			return false;
		}
		
		$includedCourse = explode(',',$this->courseInfo['INCLUDES']);
		
		$packRef = generate_packPurhref();
		
		foreach($includedCourse as $c){
			$arrData = array('no_catch'=>'1','uid'=>$this->user,'cid'=>$c,'purchRef'=>$packRef);
			$stat = courses_func_registerForCourse($arrData);
			$reqData = array('cid'=>$c,'uid'=>$this->user);
			$stat = courses_func_activateRequest($reqData);
		}
		return true;
	}
}
?>
