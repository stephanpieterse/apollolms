<?php
/**
	@author Stephan Pieterse
	@package ApolloLMS

	This form displays the details of an individually selected group.
*/
	$smarty = new Smarty();

	$group = $_GET['gid'];
	// assign variables for searching
	$groupName = $group;
		
	// get all data from members in correct group
	//$query1 = "SELECT * FROM members WHERE groups LIKE '$group2search'";
	$query1 = "SELECT * FROM members";
	$result = sql_execute($query1);
	while ($data = sql_get($result)){
		$adminsNameArr[$data['ID']] = $data['NAME'];
	}
	
	$curIsAdmin = isUserInGroupAdminID($_SESSION['userID'], $group);
	
	//check permissions to view / edit admins
	$q = "SELECT name, adminusers, requests FROM groupslist WHERE id='$group' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	// i only do this here because it is one less query than at the top
	$smarty->assign('groupName',$d['name']);
	
		$xmlDoc = new DOMDocument();
		if($d['adminusers'] != ""){
					$groupAdminUsers = $d['adminusers'];
				}else{
					$groupAdminUsers = "<au></au>";
				}

		$xmlDoc->loadXML($groupAdminUsers);
		$rootNode = $xmlDoc->documentElement;	

		foreach($rootNode->childNodes as $child){
			if($child->nodeName == 'user'){
				if(!isset($adminsNameArr[$child->getAttribute('id')])){
						//TODO: i need to report this? should these types of things be autocorrected?
						$reportSet['database_wrong'] = true;
						$reportSet['database_dump'] = 'user ' . $child->getAttribute('id') . ' in group admin ' . $group;
						base_func_report_item($reportSet);
				}else{
				$adminNames[] = $adminsNameArr[$child->getAttribute('id')];
				}
			}
		}

		if(isset($adminNames)){
			$smarty->assign('adminNames',$adminNames);
		}

	//group requests section
	// check permissios to accept requests
		$xmlDoc = new DOMDocument();
		
		if($d['requests'] == ''){
			$dreq = '<requests></requests>';
		}else{
			$dreq = $d['requests'];
		}
		
		$xmlDoc->loadXML($dreq);
		$rootNode = $xmlDoc->documentElement;	
	
		$xps = 0; //counter
		foreach($rootNode->childNodes as $child){
			if($child->nodeName == 'user'){
				$reqUID = $child->getAttribute('id');
				$reqQ = "SELECT * FROM members WHERE id='$reqUID' LIMIT 1";
				$reqD = sql_execute($reqQ);
				$reqR = sql_get($reqD);
				
				$pendingSection[$xps]['NAME'] = $reqR['NAME'];
		
				if($curIsAdmin || check_user_permission('group_all_requests')){
					$pendingSection[$xps]['ACCEPTLINK'] = '<a class="biglinkT1" href="groups.php?q=acceptGroupRequest&uid=' . $reqUID . '&gid=' . $group . '">Accept Join Request</a> ';
					$pendingSection[$xps]['REJECTLINK'] = '<a class="biglinkT1" href="groups.php?q=denyGroupRequest&uid=' . $reqUID . '&gid=' . $group . '">Deny Join Request</a> ';
					}
				
			}
		}
		if(isset($pendingSection)){
			$smarty->assign('pendingSection',$pendingSection);
		}

	// user section
	$query1 = "SELECT * FROM members";
	$result = sql_execute($query1);
	$xi = 0;
	
		while($row = sql_get($result)){
			if(isUserInGroup($row['ID'],$group)){
				$usersSection[$xi]['NAME'] = $row['NAME'];
				$usersSection[$xi]['ID'] = $row['ID'];
				if($curIsAdmin && (!isUserInGroupAdminID($row['ID'],$group))){
						$usersSection[$xi]['ADMINLINK'] = '<a href="groups.php?q=addGroupAdmin&uid=' . $row['ID'] . '&gid=' . $group . '">Assign user as admin</a>';
						}
				$xi++;
			}
		}
		
		$totalUsers = $xi;
		$smarty->assign('totalUsers',$totalUsers);
		if(isset($usersSection)){
		$smarty->assign('usersSection',$usersSection);
		}
	//end users
	
	// course section
		$availCourses = groups_backend_listgroupCourses($group,true);
		for($xi = 0; $xi < sizeOf($availCourses['ID']); $xi++){
			$coursesSection[]['LINK'] = '<a href="courses.php?f=displayCourse&cid=' . $availCourses['ID'][$xi] . '">' . $availCourses['NAME'][$xi] . '</a>';
		}
		if(isset($coursesSection)){
		$smarty->assign('coursesSection',$coursesSection);
		}
	//end courses
	
	// tests section	
	$q = "SELECT * FROM tests";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		if(groupHasTestPermission($_SESSION['userID'],$r['ID'])){
			$testsSection[]['LINK'] = '<a href="tests.php?f=viewTest&tid=' . $r['ID'] . '">' . $r['NAME'] . '</a>';
		}
	}
	
	if(isset($testsSection)){
		$smarty->assign('testsSection',$testsSection);
		}
	
	// end tests
	
	// resource section
	$q = "SELECT * FROM resources";
	$d = sql_execute($q);
	
	$anyResource = false;
	if(sql_numrows($d) != 0){
		$anyResource = true;
	}
	
	$xrc = 0; // counter
	while($r = sql_get($d)){
			if(xmlHasSpecifiedNode($r['PERMISSIONS'], array('tagname'=>'group','id'=>$group))){
				
				if(strpos($r['URL'],'resource_view.php') !== false){
					$resourceSection[$xrc]['LINKS'][] = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $r['URL'] . ' "> ' . $r['NAME'] . '</a>';
					}else{
					$resourceSection[$xrc]['LINKS'][] = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . urlencode($r['URL']) . '&ref=' . urlencode(selfURL()) . '"> ' . $r['NAME'] . '</a>';
					}
				if(check_user_permission(array('content_modify','groups_modify'))){
					$resourceSection[$xrc]['LINKS'][] = '<a href="resources.php?q=removeFromGroup&resid=' . $r['ID'] . '" ><img src="' . ICONS_PATH . 'cancel.png" alt="Remove"/></a>';
				}
				$xrc++;
		}
	}
	
	if(check_user_permission(array('content_modify','groups_modify'))){
		//$resourceSection[$xrc]['LINKS'][] = '<a href="resources.php?f=addToGroup&gid=' . $groupName . '">Add a Resource</a><br/>';
		$canAddResource = true;
	}else{
		$canAddResource = false;
	}
	
	if(isset($resourceSection)){
		$smarty->assign('resourceSection',$resourceSection);
	}
		$smarty->assign('canAddResource',$canAddResource);
	
	// end resource
	
	// subgroups section
	$sq = "SELECT * FROM groupslist";
	$sr = sql_execute($sq);
	while($sd = sql_get($sr)){
		if(strpos($sd['PARENTS'],'id="' . $group . '"')){
		$subgroupsSection[] = '<a href="groups.php?f=viewGroup&gid=' . $sd['ID'] . '"' . $sd['NAME'] . '</a>';
		}
	}

	if(isset($subgroupsSection)){
		$smarty->assign('subgroupsSection',$subgroupsSection);
	}

	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display(TEMPLATE_PATH . $tplName);
?>
<div id="chatwrap" style="float: left;">
<?php include(TEMPLATE_PATH . 'groups_form_chatSection.php'); ?>
</div>
