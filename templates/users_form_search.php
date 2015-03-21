<?php
/**
 * @author Stephan
 * @package ApolloLMS
 * */
 
 
/*
 * 
 * function users_func_search($data){
	$searchFor = makeSafe($data['search']);
	$outputLike = makeSafe($data['output']);
	
	$q = "SELECT * FROM members WHERE email LIKE '%".$searchFor."%' OR name LIKE '%".$searchFor."%'";
	$d = sql_execute($q);
	
	switch ($outputLike){
		case 'user_admin':
			while($r = sql_get($d)){
				echo '<td>';
				echo '<a id="a_admin_user_view" href="index.php?action=admin_view_user&uid=' . $r['ID'] .' ">' . $r['NAME'] . '<img src="' .ICONS_PATH . 'magnifier.png" alt="View"/></a>';
				echo '</td><br/>';
			} 
		break;
	}
}
* 
* */
 
	$smarty = new Smarty;
 
	$containArray = explode(' ',$_GET['s']);
 
	$allids = search_users($containArray);
 
	if($allids){
		$smarty->assign('foundSomething',1);
	}else{
		$smarty->assign('foundSomething',0);
	}
 
	$smarty->assign('idarray',$allids);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
