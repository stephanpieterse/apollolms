<?php
/**
 * @author Stephan
 * @package ApolloLMS
 * */
	$smarty = new Smarty;
 
	$containArray = explode(' ',$_GET['s']);
 
	$allids = search_courses_complete($containArray);
 
	$smarty->assign('idarray',$allids);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
