<?php
/**
	@author Stephan Pieterse
	@package ApolloLMS

	This form displays the details of an individually selected group.
*/
	$smarty = new Smarty();
?>
<div id="normgroupwrap" style="float: left; width: 50%;">
<?php
	$group = $_GET['gid'];
	// assign variables for searching
	$groupName = $group;
		
	// get all data from members in correct group
	//$query1 = "SELECT * FROM members WHERE groups LIKE '$group2search'";
	$query1 = "SELECT * FROM members";
	$result = sql_execute($query1);
	while ($data = sql_get($result)){
		$adminsNameArr[$data['ID']] = $data['NAME'];
		//echo $data['NAME'];
		//echo $data['ID'];
	}
	
	$curIsAdmin = isUserInGroupAdminID($_SESSION['userID'], $group);
	
	//check permissions to view / edit admins
	echo print_bold("Admins for this group:");
	$q = "SELECT adminusers, requests FROM groupslist WHERE id='$group' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
		$xmlDoc = new DOMDocument();
		if($d['adminusers'] != ""){
					$groupAdminUsers = $d['adminusers'];
				}else{
					$groupAdminUsers = "<au></au>";
				}

		$xmlDoc->loadXML($groupAdminUsers);
		$rootNode = $xmlDoc->documentElement;	
	
	tag('p');
		foreach($rootNode->childNodes as $child){
			if($child->nodeName == 'user'){
				echo $adminsNameArr[$child->getAttribute('id')];
			}
		}
	tag('p',false);

	// check permissios to accept requests
		echo '<p>';
		echo print_bold("Pending Join Requests:");
		echo '<br/>';
		$xmlDoc = new DOMDocument();
		
		if($d['requests'] == ''){
			$dreq = '<requests></requests>';
		}else{
			$dreq = $d['requests'];
		}
		
		$xmlDoc->loadXML($dreq);
		$rootNode = $xmlDoc->documentElement;	
	

		foreach($rootNode->childNodes as $child){
			if($child->nodeName == 'user'){
				$reqUID = $child->getAttribute('id');
				$reqQ = "SELECT * FROM members WHERE id='$reqUID' LIMIT 1";
				$reqD = sql_execute($reqQ);
				$reqR = sql_get($reqD);
				
				echo $reqR['NAME'];
				echo ' - ';
		
				if($curIsAdmin || check_user_permission('group_all_requests')){
				$link = '<a class="biglinkT1" href="groups.php?q=acceptGroupRequest&uid=' . $reqUID . '&gid=' . $group . '">Accept Join Request</a> ';
				$link .= ' -- ';
				$link .= '<a class="biglinkT1" href="groups.php?q=denyGroupRequest&uid=' . $reqUID . '&gid=' . $group . '">Deny Join Request</a> ';
				$link .= '<br/>';$smarty->assign('groupData',$dataArray);
		$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
		$smarty->display(TEMPLATE_PATH . $tplName);
				echo $link;
				}
				
			}
		}
	echo '</p>';
	
	$query1 = "SELECT * FROM members";
	$result = sql_execute($query1);
	echo '<p>';
	echo print_bold("Users in this group:");
	br();
	while($row = sql_get($result)){
	if(isUserInGroup($row['ID'],$group)){
		echo $row['NAME'];
		br();
		if($curIsAdmin && (!isUserInGroupAdminID($row['ID'],$group))){
					$link = '<a href="groups.php?q=addGroupAdmin&uid=' . $row['ID'] . '&gid=' . $group . '">Assign user as admin</a>';
					echo $link;
				}
	}
	}
	echo '</p>';
	echo '<p>';
	echo print_bold("Courses available to this group:<br/>");
		$availCourses = groups_backend_listgroupCourses($group,true);
		for($xi = 0; $xi < sizeOf($availCourses['ID']); $xi++){
			$link = '<a href="courses.php?f=displayCourse&cid=' . $availCourses['ID'][$xi] . '">' . $availCourses['NAME'][$xi] . '</a>';
			echo $link;
			echo '<br/>';
		}
		
	echo '<p>';
	echo print_bold("Tests available to this group:");br();
	//todo: display the available tests
	
	$q = "SELECT * FROM tests";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		if(userHasTestPermission($_SESSION['userID'],$r['ID'])){
			$link = '<a>' . $r['NAME'] . '</a>';
			echo $link . '<br/>';
		}
	}
	
	echo '</p>';
	echo '<p>';
	echo print_bold("Resources available to this group:");br();
	
	$q = "SELECT * FROM resources";
	$d = sql_execute($q);
	
	$anyResource = false;
	if(sql_numrows($d) != 0){
		$anyResource = true;
	}
	
	while($r = sql_get($d)){
			if(xmlHasSpecifiedNode($r['PERMISSIONS'], array('tagname'=>'group','id'=>$group))){
				$anyResource = true;
				if(strpos($r['URL'],'resource_view.php') !== false){
					$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $r['URL'] . ' "> ' . $r['NAME'] . '</a><br/>';
					echo $link;
					}else{
					$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . urlencode($r['URL']) . '&ref=' . urlencode(selfURL()) . '"> ' . $r['NAME'] . '</a><br/>';
					echo $link;	
					}
				echo '<a href="resources.php?q=removeFromGroup&resid=' . $r['ID'] . '" ><img src="' . ICONS_PATH . 'cancel.png" alt="Remove"/></a>';
		}
	}

	if($anyResource === false){
		echo 'There are no resources currently available to you.'; 
	}
	
	echo '</p>';
	if(check_user_permission(array('content_modify','groups_modify'))){
		$link = '<a href="resources.php?f=addToGroup&gid=' . $groupName . '">Add a Resource</a><br/>';
		echo $link;
	}
	?>
	<br/>
	<b>SUBGROUPS</b>
	<br/>
<?php
	$sq = "SELECT * FROM groupslist";
	$sr = sql_execute($sq);
	while($sd = sql_get($sr)){
		if(strpos($sd['PARENTS'],'id="' . $group . '"')){
		echo $sd['NAME'];
		echo "<br/>";
		}
	}
?>

	</div>
	<div id="chatwrap" style="float: left;">
	<?php
	include(TEMPLATE_PATH . 'groups_form_chatSection.php');
?>

<?php
	if(isset($dataArray)){
		$smarty->assign('groupData',$dataArray);
	}
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display(TEMPLATE_PATH . $tplName);
?>
