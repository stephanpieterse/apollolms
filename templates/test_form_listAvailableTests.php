<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
	$smarty = new Smarty;

	$query = "SELECT * FROM tests";
	$sqlresultContent = sql_execute($query);
	$query  = "SELECT * FROM testresults";
	$sqlresultResults = sql_execute($query);
	$query = "SELECT * FROM members WHERE id='" . $_SESSION['userID'] . "' LIMIT 1";
	$sqlresultMembers = sql_execute($query);
	$x = 0;
	
	$memberData = sql_get($sqlresultMembers);
	
	while($contentRow = sql_get($sqlresultContent)){
	$xmlDoc = new DOMDocument();
	
	if($contentRow['ACCESS'] == ""){
		$contentRowData = "<access></access>";
	}else{
		$contentRowData = $contentRow['ACCESS'];
	}

	$hasAccess = userHasTestPermission($memberData['ID'],$contentRow['ID']);
		$linklist[0] = "<a></a>";
		$teststatus = " - Not Completed";
		if($hasAccess){
		$newdataid = $contentRow['ID'];
		$newdataname = $contentRow['NAME'];
		$newdatafriendly = $contentRow['NAME'];
		$newdatadesc = $contentRow['DESCRIPTION'];
		while($testrow = sql_get($sqlresultResults)){
			if(($testrow['NAME'] == $newdataname) && ($testrow['STUDENT'] == $_SESSION['userID'])){
				$teststatus = " - Test Taken";
				if($testrow['TIMETAKEN'] != 0){
					$teststatus = $teststatus . " - Completed";
				}
				else{
					$teststatus = $teststatus . " - Not Completed";
				}
				break;
			}else{
				$teststatus = " - Test Not Taken";
			}
		}
		$linkref = "<a href='index.php?action=setInitTest&tid=" . $newdataid . "'>" . $newdatafriendly . "</a>" . $teststatus . "<br/>" . $newdatadesc . "<br/>";
		//mysql_data_seek($sqlresult2,0); 
		$linklist[$x] = $linkref;
		$x++;
	}
			
	$smarty->assign('testlist',$linklist);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
}
?>
