<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
	
	$smarty = new Smarty;
	
	$q = 'SELECT * FROM roles WHERE hidden="0"';
	$r = sql_execute($q);
	
	$cur = 0;
	while($rowdata = sql_get($r)){

		$dataArray[$cur]['ROLENAME'] = $rowdata['ROLENAME'];
		$dataArray[$cur]['LINKS'][] = "<a href=\"roles.php?f=viewRole&rid=" . $rowdata['ID'] . "\"> <img src=\"" . ICONS_PATH . "magnifier.png\" alt=\"View\"/></a>";
		if(check_user_permission("roles_modify")){
		$dataArray[$cur]['LINKS'][] = "<a href=\"roles.php?f=editRole&rid=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a>";
		}
		if(check_user_permission("roles_remove")){
		$dataArray[$cur]['LINKS'][] = "<a href=\"roles.php?q=rm_roleItem&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
		}
		$cur++;
	}
	
	$smarty->assign('roledata',$dataArray);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
