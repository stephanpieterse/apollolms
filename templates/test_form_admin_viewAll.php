<?php
/*
 * @author Stephan Pieterse
 * */
	$smarty = new Smarty;
	$sqlquery = "SELECT * FROM tests ORDER BY name ASC";
	$sqlresult = sql_execute($sqlquery);
	
	$cc = 0;
	while($rowdata = sql_get($sqlresult)){
		$arrdata[$cc]['NAME'] = $rowdata['NAME'];
		$arrdata[$cc]['ID'] = $rowdata['ID'];
		//if(check_user_permission("test_view")){
		//echo "<td><a target=\"_blank\" href=\"index.php?aq=admin_view_test&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "magnifier.png\" alt=\"View\"/></a></td>";
		//}
		if(check_user_permission("test_modify")){
		$arrdata[$cc]['MOD'] = true;
		}
		if(check_user_permission("test_remove")){
		$arrdata[$cc]['DEL'] = true;
		}
		$cc++;
	}
	
	$smarty->assign('testData',$arrdata);
	$smarty->assign('iconsPath',ICONS_PATH);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
