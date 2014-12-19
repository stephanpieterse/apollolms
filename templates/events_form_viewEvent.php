<?php

	$smarty = new Smarty;
	
	$eid = makeSafe($_GET['eid']);
	$q = "SELECT * FROM events WHERE id='$eid' LIMIT 1";
	$d = sql_execute($q);
	
	if(sql_numrows($d) == 0){
		echo 'The specified event does not exist...';
		return true; 
	}
	
	$r = sql_get($d);
	
	$smarty->assign('eventName',$r['NAME']);
	$smarty->assign('eventDescription',$r['DESCRIPTION']);
	$smarty->assign('eventPermissions',$r['PERMISSIONS']);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);

?>
