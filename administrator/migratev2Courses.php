<?php
	require('../config.php');

	$qC = "SELECT * FROM courses";
	$mC = sql_execute($qC);
	
	$qA = "SELECT * FROM articles";
	$mA = sql_execute($qA);
	
	$qP = "SELECT * FROM pages";
	$mP = sql_execute($qP);
	
	while($mR = sql_get($mD)){
		$members[$mR['ID']] = $mR['NAME'];
	}
	
	$qR = "SELECT * FROM groups_types";
	$rD = sql_execute($qR);
	
	while($rR = sql_get($rD)){
		$roles[$rR['NAME']] = $rR['ID'];
	}
	
	foreach($members as $mid=>$mrole){
	//while(list($mid,$mrole) = each($members)){
		if(isset($roles[$mrole])){
			$newMemRole[$mid] = $roles[$mrole];
		}
	}
	foreach($newMemRole as $ID=>$ROLEIDE){
	//while(list($ID,$ROLEID) = each($newMemRole)){
		$q = "UPDATE groupslist SET grouptype='$ROLEID' WHERE id='$ID'";
		$d = sql_execute($q);
	}
?>
