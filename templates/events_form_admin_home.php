<?php

	$smarty = new Smarty;

	$q = "SELECT * FROM events";
	$d = sql_execute($q);
	
	if(sql_numrows($d) == 0){
		echo 'There are no current events';
		//return true;
	}
	
	$cur = 0;
	while($r = sql_get($d)){
		$dataArray[$cur] = $r;
		$dataArray[$cur]['LINKS'][] = '<a href="events.php?f=viewEvent&eid=' . $r['ID'] . '">View</a>';
		$dataArray[$cur]['LINKS'][] = '<a href="events.php?f=editEvent&eid=' . $r['ID'] . '">Edit</a>';
		$dataArray[$cur]['LINKS'][] = '<a href="events.php?q=removeEvent&eid=' . $r['ID'] . '">Delete</a>';
		$cur++;
		
	}
	
	$smarty->assign('eventData',$dataArray);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
	
?>
