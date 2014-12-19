<?php
	require('../config.php');

	$qM = "SELECT * FROM members";
	$mD = sql_execute($qM);
	
	while($mR = sql_get($mD)){
		$members[$mR['ID']] = $mR['ROLE'];
	}
	
	$qR = "SELECT * FROM roles";
	$rD = sql_execute($qR);
	
	while($rR = sql_get($rD)){
		$roles[$rR['ROLENAME']] = $rR['ID'];
	}
	
	while(list($mid,$mrole) = each($members)){
		if(isset($roles[$mrole])){
			$newMemRole[$mid] = $roles[$mrole];
		}
	}
	
	while(list($ID,$ROLEID) = each($newMemRole)){
		$q = "UPDATE members SET role='$ROLEID' WHERE id='$ID'";
		$d = sql_execute($q);
	}

?>