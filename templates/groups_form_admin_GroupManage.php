<?php
/*
*	@author Stephan Pieterse
*/
	$smarty = new Smarty;
	
	$sqlquery = "SELECT * FROM groupslist ORDER BY grouptype ASC";
	$sqlresult = sql_execute($sqlquery);
	

	$cc = 0;
	while($rowdata = sql_get($sqlresult)){
		$fullArray[$cc]['NAME'] = $rowdata['NAME'];
		$fullArray[$cc]['GROUPTYPE'=] = $rowdata['GROUPTYPE'];
		$fullArray[$cc]['DESCRIPTION'] = $rowdata['DESCRIPTION'];
		$cc++;
	}

	$iconsPath = ICONS_PATH;	
	$smarty->assign('iconsPath',$iconsPath);
	$smarty->assign('gdata',$fullArray);
	
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
