<?php
/**
 * General role functions
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */

/**
 * Removes an item given by id item in array
 * 
 * @param data - Array containing _POST data
 * */
function roles_func_rm_roleItem($data){
	$id = $data['id'];
	if(check_user_permission("role_remove")){		
		// backup the user data to archive
		$query = 'SELECT * FROM roles WHERE ID="' . $id . '" LIMIT 1';
		$result = sql_get(sql_execute($query));
		backupData($result, ("Role Deletion " .  $id . " " . $result['ROLENAME'] . ""), 'roles');
		
		$query = 'DELETE FROM roles WHERE ID="' . $id . '"';
		$result = sql_execute($query);
		
		return('role_remove_success');
	}else{
		return false;
	}
}

/**
 * Updates a given role item
 * */
function roles_func_updateRoleItem($data){
if(!check_user_permission("roles_modify")){
	return false;
}
	$rid = $data['rid'];

	$xmlDoc = new DOMDocument();
	$rootNode = $xmlDoc->createElement("permissions");
	$xmlDoc->appendChild($rootNode);
	foreach($data as $key=>$value){
		if((isset($key)) && (($key == "rid") || ($key == "Submit") || ($key == "rolename"))){
		continue;
		}
		
		if(isset($value)){
		$value = makeSafe($value);
		$childBase = $xmlDoc->createElement($key);
		$content = $xmlDoc->createTextNode('1');
		$text = $childBase->appendChild($content);
		$childRef = $rootNode->appendChild($childBase);		
		}
	}
	$permissionsXML = $xmlDoc->saveHTML();
	$query = "UPDATE roles SET permissions='$permissionsXML' WHERE id='$rid'";
	$result = sql_execute($query);
	//page_redirect('index.php?msg=role_add_success');
	return true;
}

/**
 * Creates a new role item
 * */
function roles_func_newRoleItem($data){
if(!check_user_permission("roles_add")){
	return false;
}
	$rolename = makeSafe($data['rolename']);
	
	$q = "SELECT * FROM roles WHERE rolename='$rolename' LIMIT 1";
	$r = sql_execute($q);
	
	if(sql_numrows($r) != 1){
		$xmlDoc = new DOMDocument();
		$rootNode = $xmlDoc->createElement("permissions");
		$xmlDoc->appendChild($rootNode);
		foreach($data as $key=>$value){
			if((isset($key)) && (($key == "Submit") || ($key == "rolename"))){
			continue;
			}
			
			if(isset($value)){
			$value = makeSafe($value);
			$childBase = $xmlDoc->createElement($key);
			$content = $xmlDoc->createTextNode('1');
			$text = $childBase->appendChild($content);
			$childRef = $rootNode->appendChild($childBase);		
			}
		}
		$permissionsXML = $xmlDoc->saveHTML();
		$query = "INSERT INTO roles(rolename, permissions) VALUES('$rolename','$permissionsXML')";
		$result = sql_execute($query);
		return true;
	}
	else{
		return "role_add_failure";
	}		
}

/**
 * Parameters:
 * 	neededperm - the permission need to execute
 */
function check_user_permission($neededPerm, $nowarn = false){
	
	if(!isset($_SESSION['userID'])){
		$_SESSION['SITE_ERROR_MSG'] = 'You are not logged in!';
		return false;
	}
	
	$q = "SELECT role FROM members WHERE id='" . $_SESSION['userID'] . "'";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$rolename = $r['role'];
	//$rolename = isset($_SESSION['role']) ? $_SESSION['role'] : null;
	if(!isset($rolename)){
		$_SESSION['SITE_ERROR_MSG'] = 'There seems to be a database error. Please contact your site administrator.';
		return false;
	}
	
	$query = "SELECT * FROM roles WHERE ID=\"" . $rolename . "\" LIMIT 1";
	$data = sql_execute($query);
	$dataset = sql_get($data);
	
	$xmlDoc = new DOMDocument();
	
	if(!isset($dataset['PERMISSIONS']) || $dataset['PERMISSIONS'] == ''){
		$permdataset = '<root></root>';
	}else{
		$permdataset = $dataset['PERMISSIONS'];
	}
	
	
	$xmlDoc->loadXML($permdataset);
	$xmlDocRoot = $xmlDoc->documentElement;
	$hasPermission = false;


	if(is_string($neededPerm)){
		foreach($xmlDocRoot->childNodes as $option){
		$name = $option->nodeName;
			
		if($name == "super_all"){
			$hasPermission = true;
			break;
		}elseif($name == $neededPerm){
			if($option->nodeValue == "1"){
			$hasPermission = true;
			break;
			}
		}
	}
	} // end if string
	
	if(is_array($neededPerm)){
		foreach($neededPerm as $permItem){
			foreach($xmlDocRoot->childNodes as $option){
			$name = $option->nodeName;
			if($name == "super_all"){
				$hasPermission = true;
				break;
			}elseif($name == $permItem){
				if($option->nodeValue == "1"){
				$hasPermission = true;
				break;
				}
			}
		}
	}
	} // end if array
	
	if($hasPermission === false && $nowarn === false){
		$neededPermDump = "no_val";
		if(is_array($neededPerm)){
			foreach($neededPerm as $np){
				$neededPermDump .= $np;
			}
		}else{
		$neededPermDump = $neededPerm;
	}
		$_SESSION['SITE_ERROR_MSG'] = 'A permissions error occured at ' . $neededPermDump ;
	}
	return $hasPermission;
}
