<?php
/*
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
	$smarty = new Smarty;
	
	$backID = makeSafe($_GET['bid']);

	$q = "SELECT * FROM archived_data WHERE id='$backID' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	foreach($d as $k => $v){
		$datstrings = $k . ' - ' . $v;
	}
	
	$smarty->assign('dataStrings',$datstrings);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
