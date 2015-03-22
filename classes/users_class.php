<?php
/*
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
 
class ALMS_UserItem {
	private $memberID;
	private $username;
	private $accessXML;
	
	private function setID($id){	
		$this->memberID = $id;
	}
	
	private function setUsername($name){
		$this->username = $name;
		}
	
	private function setAccess($xml){
		$this->accessXML = $xml;
	}
		
	public function load($id){
		$query = "SELECT * FROM members WHERE id='" . $id . "' LIMIT 1";
		$sqlresultMembers = sql_execute($query);
		$r = sql_get($query);	
		$this->setID($r['ID']);	
		$this->setUsername($r['USERNAME']);	
		$this->setAccess($r['ACCESS']);
		
		return true;
	}
	
	public function check_test_access($testUser){	
		if($testUser == $this->memberID){			
			$hasAccess = true;			
		}		
		return $hasAccess;	
		}
		
	public function check_course_access($courseUser){			
		if($courseUser == $this->memberID){			
			$hasAccess = true;			
		}		
		return $hasAccess;	
	}	
	
	public function removeUser(){		
		$query = 'SELECT * FROM members WHERE id="' . $memberID . '" LIMIT 1';		
		$result = sql_get(sql_execute($query));		
		backupData($result, ("User Deletion " .  $memberID));	
		$query = 'DELETE FROM members WHERE id="' . $memberID . '"';		
		$result = sql_execute($query);	
		
		return true;
	}	

	public function addNewUser($pdata){
		$name= makeSafe($pdata['name']);
		$surname=makeSafe($pdata['surname']);
		$emailad=makeSafe($pdata['emailad']);
		$role= makeSafe($pdata['role']);
		$contactnum=makeSafe($pdata['contactnum']);
		$passwordHash = 0;
		$query ="INSERT INTO members password='$passwordHash', name='$name', surname='$surname', email='$emailad', contactnum='$contactnum'";
		$result=sql_execute($query);
		
		if($result){
			return true;
		}else{
			return false;
		}
		}
	}

	public function updateUserItem($pdata){
		if(!isset($this->memberID)){
			return false;
		}
		
		$name= makeSafe($pdata['name']);
		$surname=makeSafe($pdata['surname']);
		$emailad=makeSafe($pdata['emailad']);
		$role= makeSafe($pdata['role']);
		$contactnum=makeSafe($pdata['contactnum']);
		$secuQ  = makeSafe($pdata['securityQ']);
		$secuA = makeSafe($pdata['securityA']);
		$query ="UPDATE members SET name='$name', surname='$surname', email='$emailad', contactnum='$contactnum', securityquestion='$secuQ', securityanswer='$secuA' WHERE id='" . $this->memberID . "'";
		$result=sql_execute($query);
		
		if($result){
			return true;
		}else{
			return false;
		}
		}

	public function checkLogin($data){
	$user = $data['username'];
	$pass = $data['password'];
	//$fromwhere = isset($data['fromURL']) ? $data['fromURL'] : null;
	
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

	$sql = "SELECT * FROM members WHERE email='$username' and password='$password' LIMIT 1";
	$result = sql_execute($sql);
	$count = sql_numrows($result);

	if($count==1){
		$rows = sql_get($result);
		$role = $rows['ROLE'];
		$firsttimetest = $rows['FIRSTTIME'];
		$_SESSION['userID'] = $rows['ID'];
		$userID = $rows['ID'];
		$_SESSION['username'] = $rows['NAME'] . " " . $rows['SURNAME'];
		//$_SESSION['role'] = $role;
		$_SESSION['firsttime'] = $firsttimetest;
		$curdate = date("Y-m-d-H-i-s");
		$sql = "UPDATE members SET lastlogin='$curdate' WHERE id='$userID'";
		$result = sql_execute($sql);

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
								
}
