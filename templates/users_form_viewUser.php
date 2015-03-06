<?php
	/**
	 * By Stephan Pieterse
	 * Displays some of the data for the individual user from the database.
	 * @package ApolloLMS
	 */
	//TODO
	// add test results data
	
	$smarty = new Smarty();
	
	if(!check_user_permission('user_view')){
		return false;
	}
	$userID = $_GET['uid'];
	$userDataArr['ID'] = $userID;
	$q = "SELECT id, name FROM groupslist";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		$groupsNameArr[$r['id']] = $r['name'];
	}
	
	$query = "SELECT * FROM members WHERE id='" . $userID . "'";
	$result = sql_execute($query);
	$row = sql_get($result);

	$userDataArr['REGDATE'] = $row['REGDATE'];
	$userDataArr['NAME'] = $row['NAME'];
	$userDataArr['EMAIL'] = $row['EMAIL'];
	$userDataArr['ROLE'] =  $row['ROLE'];
	$userDataArr['CONTACTNUM'] = $row['CONTACTNUM'];
	$userDataArr['LASTLOGIN'] = $row['LASTLOGIN'];
	
	$xmlDoc = new DOMDocument;
	$xmlDoc->loadXML($row['GROUPS']);
	$docRoot = $xmlDoc->documentElement;
	
	$xi = 0;
	foreach($docRoot->childNodes as $child){	
		$nodeid = $child->getAttribute('id');
		$groupsArr[$xi]['ID'] = $nodeid;
		$groupsArr[$xi]['NAME'] = $groupsNameArr[$nodeid];
		$xi++;
		}

	$smarty->assign('userData',$userDataArr);
	if(isset($groupsArr)){
		$smarty->assign('groupData',$groupsArr);
	}
        $tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
        $smarty->display($tplName);
	
	include('users_form_viewHistory.php');
	br();
	loadPageModules('user_item');
?>
