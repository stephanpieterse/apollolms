<?php
/*
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
 
class ALMS_UserItem {
	private $memberID;
	private $username;
	private $useremail;
	private $userlocked;
	private $userQueryDump;
	private $userlastlogin;
	private $userGroups;
	
	public function get_userQueryDump(){
		return $this->userQueryDump;
	}
	
	private function setID($id){	
		$this->memberID = $id;
	}
		
	public function getName(){
		return $this->username;
	}	
	
	public function getEmail(){
		return $this->useremail;
	}	
	
	public function getID(){
		return $this->memberID;
	}	
	
	public function isLocked(){
		return $this->userlocked;
	}
	
	public function getLastLogin(){
		return $this->userlastlogin;
	}
		
	public function load($id){
		$query = "SELECT * FROM members WHERE id='" . $id . "' LIMIT 1";
		$sqlresultMembers = sql_execute($query);
		$r = sql_get($sqlresultMembers);	
		$this->setID($r['ID']);	
		$this->username = ($r['NAME']);	
		$this->useremail = ($r['EMAIL']);	
		$this->userlocked = ($r['LOCKED']);
		$this->userGroups = $r['GROUPS'];
		
		$this->userQueryDump = $r;
		
		return true;
	}	
	
	public function removeUser(){		
		$query = 'SELECT * FROM members WHERE id="' . $memberID . '" LIMIT 1';		
		$result = sql_get(sql_execute($query));		
		backupData($result, ("User Deletion " .  $memberID));	
		$query = 'DELETE FROM members WHERE id="' . $memberID . '"';		
		$result = sql_execute($query);	
		
		return true;
	}	

	public function resendPassword(){
		$username = $this->useremail;
		$password = randomAlphaNum(9);
		$passwordref = $password;
		//$passwordref = hash('sha512',$passwordref);
		$password = substr($username,0,5) . $password;
		$password = hash('sha512',$password);
		
		$q = "UPDATE members SET password='$password' WHERE email='$username'";
		$r = sql_execute($q);
		
		$msgBody = "A request has been made to resend your password. Your details are as follows:<br/>Username: " . $emailad . " <br/>Password: " . $passwordref . ". <br/> Be sure to save this e-mail for future reference." ;
		mail_inform($username,'Training site password resend request.',$msgBody);
		
		return $r;
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

			$allLogins = $rows['LOGINS'];
			$allLogins .= ',' . $curdate;
			
			$sql = "UPDATE members SET logins='$allLogins' WHERE id='$userID'";
			$result = sql_execute($sql);

			return true;
		}else{
			sleep(3);
			return "wrongpassword";
			}
	}
		
	public function isUserPendingForCourse($uid, $cid){
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
	
	public function get_userGroupIDs(){
		$xmlDoc = new DOMDocument();
		$xmlDoc->loadXML($this->userGroups);
		$rootNode = $xmlDoc->documentElement;
		
		foreach($rootNode->childNodes as $item){
		if($item->hasAttributes()){
			foreach($item->attributes as $attr){
				$retIDS[] = (int)$attr->value;
				}
			}
		}
			
		if(!isset($retIDS)){
			return false;
		}else{
			return $retIDS;
	}
	}				
}
