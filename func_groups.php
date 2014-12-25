<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * 
 * @description Basic functions pertaining to groups
 * */

/**
 * Parameters: gid - id of the group to retrieve name from
 * 
 */
function retrieve_groupName($gid){
		$q = "SELECT NAME FROM groupslist WHERE id='$gid' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
		
		return $d['NAME'];
	}

/**
 * Parameters: newuser - the id of the new user to be added
 * 				gid - the id of the group to add to
 * 
 */
function groups_func_addGroupAdmin($data){
	$newUser = $data['uid'];
	$gid = $data['gid'];
	$q = "SELECT adminusers FROM groupslist WHERE id='$gid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$adminUsers = addNode($d['adminusers'],'user',array('id'=>$newUser));
	
	$q = "UPDATE groupslist SET adminusers='$adminUsers'";
	$r = sql_execute($q);
	
	if(isset($r) && ($r != false)){
		return true;
	}else{
		return false;
	}
}

/**
 * Parameters: 
 * 		uid - id of user requesting
 * 		gid - id of group in question
 * 
 */
function groups_func_addGroupRequest($data){
	$uid = $data['uid'];
	$gid = $data['gid'];		
		
	$q = "SELECT * FROM groupslist WHERE id='$gid' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$reqXML = $r['REQUESTS'];
	if($reqXML == ""){
		$reqXML = '<requests></requests>';
	}
	$newXml = addNode($reqXML,'user',array('id'=>$uid));
	
	$q = "UPDATE groupslist SET requests='$newXml' WHERE id='$gid'";
	$d = sql_execute($q);
	
	if($r['AUTOJOIN'] == 1){
		groups_func_acceptGroupRequest($uid,$gid);
		return 'group_join_success';
	}else{
		$request = parse_url($_SERVER['REQUEST_URI']);
		$path = $request["path"];
		$result = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');
		$result = explode('/', $result);
		$max_level = 2;
		//while ($max_level < count($result)) {
	//	    unset($result[0]);
		//}
	//--//$result = '/'.implode('/', $result);
	$sitepath =  $result[0] ;
						
	$msgBody = 'A user as requested to join a group you administrate. To add them to the group, please login to the site, go to the Groups admin section and confirm them. Alternatively you can follow the link: <a href="' . $_SERVER['SERVER_NAME'] .'/'. $sitepath . '/index.php?aq=accept_group_request&uid=' . $uid . '&gid=' . $gid . '">Accept Request</a>';
	mail_informGroupAdmins($gid,'New Join Request for one of your groups',$msgBody);
	
	$body = 'A group join request has been sent to an administrator, it will be approved or rejected shortly.';
	mail_informUser($uid, 'Group request sent', $body);
	return 'group_join_pending';
	}
}

/**
 * Parameters:
 * 		uid - id of user to accept
 * 		gid - id of group in question
 * 
 */
function groups_func_acceptGroupRequest($data){
	$uid = makeSafe($data['uid']);
	$gid = makeSafe($data['gid']);
	if(!isUserInGroupAdminID($uid, $gid) && !check_user_permission('group_all_requests')){
		return false;
	}
	
	$q = "SELECT * FROM members WHERE id='$uid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$newXML = addNode($d['GROUPS'],'group',array('id'=>$gid));
	
	$q = "UPDATE members SET groups='$newXML' WHERE id='$uid'";
	$r = sql_execute($q);
	
	$q = "SELECT * FROM groupslist WHERE id='$gid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	$grpname = $d['NAME'];
	
	$newXML = rmNode($d['REQUESTS'],'user',$uid);
	
	$q = "UPDATE groupslist SET requests='$newXML' WHERE id='$gid'";
	$r = sql_execute($q);
	
	$body = 'Your request to join the group ' . $grpname . ' has been approved!';
	mail_informUser($uid, 'Group request sent', $body);
	
	return true;
}

/**
 * Parameters:
 * 		uid - id of user to accept
 * 		gid - id of group in question
 * 
 */
function groups_func_denyGroupRequest($data){
	$uid = makeSafe($data['uid']);
	$gid = makeSafe($data['gid']);
		
	$q = "SELECT * FROM groupslist WHERE id='$gid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	$grpname = $d['NAME'];
	
	$newXML = rmNode($d['REQUESTS'],'user',$uid);
	
	$q = "UPDATE groupslist SET requests='$newXML' WHERE id='$gid'";
	$r = sql_execute($q);
	
	$body = 'Your request to join the group ' . $grpname . ' has been denied.';
	mail_informUser($uid, 'Group request sent', $body);
	
	return true;
}


/**
 * Parameters:
 * 		id - 
 * 		access -
 * 
 */
function set_user_groups($id, $access){
if(check_user_permission('user_modify')){
	$query = "SELECT GROUPS FROM members WHERE id='$id' LIMIT 1";
	$result = sql_execute($query);
	$testRow = sql_get($result);
	
	$docXML = new DOMDocument;
	
	if($testRow['GROUPS'] == ""){
		$testRow['GROUPS'] = "<groups></groups>";
	}
	
	$docXML->loadXML($testRow['GROUPS']);
	$rootNode = $docXML->documentElement;

	foreach($access as $key=>$value){
		
		$commands = explode('-', $key);
		$action = $commands['0'];
		$ofType = $commands['1'];
		$ofValue = $commands['2'];	
		
		if(($action == "add") && !(isUserInGroup($id, $ofValue))){
			
			$childBase = $docXML->createElement("$ofType");
			$childBase->setAttribute('id', $ofValue);
			$childRef = $rootNode->appendChild($childBase);	
		}
		
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
			}

		if ($nodeToRemove != null){
		$rootNode->removeChild($nodeToRemove);
		$newGroups = $docXML->saveHTML();
		}
	}
	$newDoc = $docXML->saveHTML();

	$query = "UPDATE members SET groups='" . $newDoc . "' WHERE id='" . $_SESSION['userID'] . "'";
	$result = sql_execute($query);
	goHome("group_join_success");
}
}

/**
 * Parameters:
 * 		uid - 
 * 		gid -
 * 
 */
function isUserInGroupAdminID($uid, $gid){
		$isInGroup = false;

		$allGroupQ = "SELECT ADMINUSERS FROM groupslist WHERE id=\"" . $gid . "\"";
		$aqResult = sql_execute($allGroupQ);
		$groupItem = sql_get($aqResult);
		
				$xmlDoc = new DOMDocument();
				
				if($groupItem['ADMINUSERS'] != ""){
					$groupAdminUsers = $groupItem['ADMINUSERS'];
				}else{
					$groupAdminUsers = "<au></au>";
				}
				$xmlDoc->loadXML($groupAdminUsers);
				$rootNode = $xmlDoc->documentElement;
				
				foreach($rootNode->childNodes as $item){
				if($item->hasAttributes()){
				$tid = $item->getAttribute('id');
					if($tid == $gid){
						$isInGroup = true;
					}
				}
		return $isInGroup;
}
}

/**
 * Parameters:
 * 		uxml - 
 * 		gname -
 * 
 */
function isUserInGroup_XML($uXML, $gName){
		$isInGroup = false;
		$xmlDoc = new DOMDocument();
		$xmlDoc->loadXML($uXML);
		$rootNode = $xmlDoc->documentElement;
		foreach($rootNode->childNodes as $item){
		if($item->hasAttributes()){
		foreach($item->attributes as $attr){
			if($attr->value == $gName){
				$isInGroup = true;
			}
			}
		}
		}
		return $isInGroup;
}

/**
 * Parameters:
 * 		uid - 
 * 		gid -
 * 
 */
function isUserInGroup($uid, $gid){
		$isInGroup = false;

		$allGroupQ = "SELECT * FROM groupslist WHERE id=\"" . $gid . "\"";
		$aqResult = sql_execute($allGroupQ);
		$groupItem = sql_get($aqResult);
		
		$groupQuery = "SELECT GROUPS FROM members WHERE id=\"" . $uid . "\"";
		$mqResult = sql_execute($groupQuery);
		
			while($row = sql_get($mqResult)){
						
				$xmlDoc = new DOMDocument();
				$xmlDoc->loadXML($row['GROUPS']);
				$rootNode = $xmlDoc->documentElement;
				
				foreach($rootNode->childNodes as $item){
				if($item->hasAttributes()){
				foreach($item->attributes as $attr){
					if($attr->value == $groupItem['ID']){
						$isInGroup = true;
					}
					}
				}
				}
			}
			
		return $isInGroup;
}

function createNewGroup(){
	if(check_user_permission('groups_add')){
	$groupName = makeSafe($_POST['groupName']);
	$groupDesc = $_POST['groupDescription'];
	$groupType = makeSafe($_POST['groupType']);
	$closedT = makeSafe($_POST['closed']);
	$autoJoin = makeSafe($_POST['autojoin']);
	
	switch($closedT){
		case 'No' :
			$closed = 0;
		break;
		case 'Yes' :
			$closed = 1;
		break;
	}
	switch($autoJoin){
		case 'No' :
			$autoJoin = 0;
		break;
		case 'Yes' :
			$autoJoin = 1;
		break;
	}
	
	$adminUsers = '<admins></admins>';
	$adminUsers = addNode($adminUsers,'user',array('id'=>$_SESSION['userID']));
	$requests = '<requests></requests>';
	
	$query = "INSERT INTO groupslist(name, description, grouptype, closed, autojoin, adminusers, requests) VALUES('$groupName','$groupDesc','$groupType', '$closed', '$autoJoin', '$adminUsers', '$requests')";
	$result = sql_execute($query);
	}
}

function groups_func_updateGroupType($data){
	$id = $data['id'];
	$newDesc = $data['description'];
	
	if(check_user_permission('grouptype_modify')){
	$query = "UPDATE groups_types SET description='$newDesc' WHERE id='$id'";
	$result = sql_execute($query);
		return true;
	}else{
		return false;
	}
}

function groups_func_updateGroup($data){
	if(!check_user_permission('groups_modify')){
		return false;
	}
	
	$gid = $data['gid'];
	
	$groupName = makeSafe($data['groupName']);
	$groupDesc = $data['groupDescription'];
	$groupType = makeSafe($data['groupType']);
	$closedT = makeSafe($data['closed']);
	$autoJoin = makeSafe($data['autojoin']);
	
	$gq = "SELECT ID FROM groups_types WHERE name='$groupType' LIMIT 1";
	$gd = sql_execute($gq);
	$gr = sql_get($gd);
	
	$groupTypeID = $gr['ID'];
	
	switch($closedT){
		case 'No' :
			$closed = 0;
		break;
		case 'Yes' :
			$closed = 1;
		break;
	}
	switch($autoJoin){
		case 'No' :
			$autoJoin = 0;
		break;
		case 'Yes' :
			$autoJoin = 1;
		break;
	}
	
	$q = "UPDATE groupslist SET name='$groupName', description='$groupDesc', grouptype='$groupType', closed='$closed', autojoin='$autoJoin' WHERE id='$gid'";
	//$query = "INSERT INTO groupslist(name, description, grouptype, closed, autojoin) VALUES('$groupName','$groupDesc','$groupType', '$closedT', '$autoJoin')";
	$result = sql_execute($q);

	return true;
}

function addGroupData(){
	// TODO
	// check if user is not already a part of the group they are joining
	/*
	$query = "SELECT * FROM members WHERE id='" . $_SESSION['userID'] ."' LIMIT 1";
	$result = sql_execute($query);
	$row = sql_get($result);
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($row['GROUPS']);
	$rootNode = $xmlDoc->documentElement;
	while (list($key, $value) = each($_POST)){	
	// append new child node for every selected grouptype as groupname	

		if((isset($key)) && ($key == "submit")){
		continue;
		}
		if(isset($value) && ($value != "-NONE-")){
		$value = makeSafe($value);
		$childBase = $xmlDoc->createElement('group');
		$childBase->setAttribute($key, $value);
		$childRef = $rootNode->appendChild($childBase);		
		}

	$data = $xmlDoc->saveHTML();

	$query = "UPDATE members SET groups='" . $data . "' WHERE id='" . $_SESSION['userID'] . "'";
	$result = sql_execute($query);
	goHome("group_join_success");
		}
	*/
	
	set_user_groups($_SESSION['userID'], $_POST);
	
}

function groups_func_insertNewGroupType($data){
	$name = $data['name'];
	$desc = $data['description'];
	
if(check_user_permission('grouptype_add')){
	$name = makeSafe($name);
	$desc = makeSafe($desc);
	
	$query = "INSERT INTO groups_types(name, description) VALUES('$name', '$desc')";
	$result = sql_execute($query);
	page_redirect('index.php?msg=grouptype_add_success');
	}else{
	page_redirect('index.php?msg=grouptype_add_failure');
	}
}

function groups_func_leave($data){
	$groupID = $data['gid'];
	
	$q = "SELECT * FROM members WHERE id='" . $_SESSION['userID'] . "' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	$newdat = rmNode($d['GROUPS'], $groupID);

	$query = "UPDATE members SET groups='" . $newdat . "' WHERE id='" . $_SESSION['userID'] . "'";
	$result = sql_execute($query);
	
	return true;
}
?>
