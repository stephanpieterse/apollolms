<?php

	/**
	 * By Stephan Pieterse
	 * Displays some of the data for the individual user from the database.
	 * @package ApolloLMS
	 */
	//TODO
	// add edit button
	// add test results data

	if(!check_user_permission('user_view')){
		return false;
	}
	
	echo '<a href="users.php?f=editUser&uid=' . $_GET['uid'] . ' "><img src="' .ICONS_PATH . 'pencil.png" alt="Edit"/></a><br/>';
	
	$q = "SELECT id, name FROM groupslist";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		$groupsNameArr[$r['id']] = $r['name'];
	}
	
	$query = "SELECT * FROM members WHERE id='" . $_GET['uid'] . "'";
	$result = sql_execute($query);
	$row = sql_get($result);

	echo print_bold("Registered at:<br />");
	echo $row['REGDATE'];
	echo "<br />";
	echo "<br />";
	
	echo print_bold("Full Name:<br />");
	echo $row['NAME'];
	echo "<br />";
	echo "<br />";
	
	//echo print_bold("Surname:<br />");
	//echo $row['SURNAME'];
	//echo "<br />";
	
	echo print_bold("E-mail:<br />");
	echo '<a href="mailto:' .$row['EMAIL'] . '" >' .$row['EMAIL'] . '</a>';
	echo "<br />";
	echo "<br />";
	
	echo print_bold("Role:<br />");
	echo $row['ROLE'];
	echo "<br />";
	echo "<br />";
	
	echo print_bold("Contact Number:<br />");
	echo $row['CONTACTNUM'];
	echo "<br />";
	echo "<br />";
	
	echo print_bold("Groups:<br />");
	//echo $row['GROUPS'];
	$xmlDoc = new DOMDocument;
	$xmlDoc->loadXML($row['GROUPS']);
	$docRoot = $xmlDoc->documentElement;
	
	foreach($docRoot->childNodes as $child){
		
		$nodeid = $child->getAttribute('id');
		//echo $groupsNameArr[$nodeid];
		$link = '<br/><a target="_blank" href="groups.php?f=viewGroup&gid='.$nodeid.'">'.$groupsNameArr[$nodeid]."</a>";
		echo $link;
		
	}
	
	echo "<br />";
	echo "<br />";
	
	echo print_bold("Last Login:<br />");
	echo $row['LASTLOGIN'];
	br();
	echo print_bold("View History:");
	br();
	//u_viewHistory($row['ID']);
	include('users_form_viewHistory.php');
	br();
	loadPageModules('user_item');
?>
