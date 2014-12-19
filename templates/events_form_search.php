<?php
/**
 * 
 * 
 * @author Stephan
 * @package ApolloLMS
 * */

	$smarty = new Smarty;
 
	$containArray = explode(' ',$_GET['s']);
 
	$allids = search_events($containArray);
 
	$smarty->assign('idarray',$allids);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);

?>
