<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
	if(!check_user_permission('user_view') || !is_user_loggedIn()){
		return false;
	}
	
	$smarty = new Smarty;
	$uhandle = new ALMS_UserHandler;
	$uitem = new ALMS_UserItem;
	
	$uIdArray = $uhandle->getAllIds();
	
	
	//$sqlquery = "SELECT * FROM members ORDER BY name ASC";
	//$sqlresult = sql_execute($sqlquery);
	
	$dataArray[] = null;
	$curPos = 0;
	
	//while($rowdata = sql_get($sqlresult)){
	foreach($uIdArray as $nuid){
		$uitem->load($nuid);
	
		$dataArray[$curPos]['NAME'] = $uitem->getName();//$rowdata['NAME'];
		$dataArray[$curPos]['ID'] = $uitem->getID();//$rowdata['ID'];
		$tempUID = $uitem->getID();//$rowdata['ID'];
		$dataArray[$curPos]['EMAIL'] = $uitem->getEmail();//$rowdata['EMAIL'];
	    $dataArray[$curPos]['PROFILEPIC'] = showProfilePic('35',$tempUID);

/*
	if($rowdata['GENDER'] == 1){
		$dataArray[$curPos]['GENDER'] =  '<img src="' .ICONS_PATH . 'user_female.png" alt="Female"" />';
	}else{
		$dataArray[$curPos]['GENDER'] =  '<img src="' .ICONS_PATH . 'user.png" alt="Male"" />';
	}
*/
		if(check_user_permission("user_view")){
			$dataArray[$curPos]['LINKS'][] = '<a href="mailto:' . $uitem->getEmail() . '"><img src="' . ICONS_PATH . 'email.png" alt="Email"/></a>';
			$dataArray[$curPos]['LINKS'][] = '<a href="users.php?f=viewUser&uid=' . $tempUID .' "><img src="' .ICONS_PATH . 'magnifier.png" alt="View"/></a>';
		}else {$dataArray[$curPos]['LINKS'][] = ""; }
		if($uitem->isLocked() == 0){
		if(check_user_permission("user_modify")){
			$dataArray[$curPos]['LINKS'][] = '<a href="users.php?f=editUser&uid=' . $tempUID . ' "><img src="' .ICONS_PATH . 'pencil.png" alt="Edit"/></a>';
		}else {$dataArray[$curPos]['LINKS'][] = " "; }
		if(check_user_permission("user_remove")){
			$dataArray[$curPos]['LINKS'][] = '<a href="users.php?confirm&q=removeUser&uid=' . $tempUID . ' "><img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a>';	
		}else {$dataArray[$curPos]['LINKS'][] = " "; }
		}else{$dataArray[$curPos]['LINKS'][] = " ";$dataArray[$curPos]['LINKS'][] = " ";}
		
		$fromPlugins = modules_plugin_feature('admin_user_view_single_link',$uitem->get_userQueryDump());
		//var_dump($fromPlugins);
		if(is_array($fromPlugins)){
		foreach($fromPlugins['links'] as $k=>$v){
			if(is_array($v)){
			foreach($v as $key=>$val){
			$dataArray[$curPos]['LINKS'][] =  $key .'='. $val ;
			}
			}else{
				$dataArray[$curPos]['LINKS'][] = $v ;
			}
		}
		}
		$curPos++;
	} // end while sqlresult
	
	$smarty->assign('memberdata',$dataArray);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
