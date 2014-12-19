<?php
class member {
	private $memberID;
	private $username;
	private $accessXML;
	
	function setID($id){	
		$memberID = $id;
	}
	
	function setUsername($name){
		$username = $name;
		}
	
	function setAccess($xml){
		$accessXML = $xml;
	}
		
	function __construct($id){
		$query = "SELECT * FROM members WHERE id='" . $id . "' LIMIT 1";
		$sqlresultMembers = sql_execute($query);
		$r = sql_get($query);	
		$this->setID($r['ID']);	
		$this->setUsername($r['USERNAME']);	
		$this->setAccess($r['ACCESS']);
	}
	
	function check_test_access($testUser){	
		if($testUser == $memberID){			
			$hasAccess = true;			
		}		
		return $hasAccess;	
		}
		
	function check_course_access($courseUser){			
	if($courseUser == $memberID){			
		$hasAccess = true;			
	}		
	return $hasAccess;	
	}	
	
	function removeUser(){		
	$query = 'SELECT * FROM members WHERE id="' . $memberID . '" LIMIT 1';		
	$result = sql_get(sql_execute($query));		
	backupData($result, ("User Deletion " .  $memberID));	
	$query = 'DELETE FROM members WHERE id="' . $memberID . '"';		
	$result = sql_execute($query);	
	}	

	function updateUserItem($ses){
	$name= makeSafe($_POST['name']);
	$surname=makeSafe($_POST['surname']);
	$emailad=makeSafe($_POST['emailad']);
	$role= makeSafe($_POST['role']);
	$contactnum=makeSafe($_POST['contactnum']);
	$secuQ  = makeSafe($_POST['securityQ']);
	$secuA = makeSafe($_POST['securityA']);
	$query ="UPDATE members SET name='$name', surname='$surname', email='$emailad', contactnum='$contactnum', securityquestion='$secuQ', securityanswer='$secuA' WHERE username='$username'";
	$result=sql_execute($query);
	}						
	}
	?>