<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */

	$smarty = new Smarty();

	if(check_user_permission('join_closed_groups',true)){
		$sqlquery = "SELECT * FROM groupslist";
	}else{
		$sqlquery = "SELECT * FROM groupslist WHERE closed='0'";
	}
		$result = sql_execute($sqlquery);
	
		$gx = 0;
		while($row = sql_get($result)){
				$dataArray[$gx]['NAME'] = $row['NAME'];
				$dataArray[$gx]['DESCRIPTION'] = $row['DESCRIPTION'];
			
				if(!isUserInGroup($_SESSION['userID'], $row['ID'])){
					if(isUserPendingForGroup($_SESSION['userID'],$row['ID'])){
						$dataArray[$gx]['LINKNAME'] = "JOIN REQUEST ALREADY SENT";
						$dataArray[$gx]['LINK'] = "";
					}else{
					$dataArray[$gx]['LINK'] = 'groups.php?q=addGroupRequest&gid=' . $row['ID'] . '&uid=' . $_SESSION['userID'];
					$dataArray[$gx]['LINKNAME'] = "REQUEST TO JOIN";
					}
				}else{
					$dataArray[$gx]['LINK'] = 'groups.php?f=viewGroup&gid=' . $row['ID'];
					$dataArray[$gx]['LINKNAME'] = "VIEW GROUP";
				}
				
				$gx++;
		}
		
		$smarty->assign('groupData',$dataArray);
		$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
		$smarty->display(TEMPLATE_PATH . $tplName);
?>
