<?php
	$smarty = new Smarty;
	
	$sqlquery = "SELECT * FROM groupslist ORDER BY grouptype ASC";
	$sqlresult = sql_execute($sqlquery);
	
	echo <<<ENDSCRIPT
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
	document.write('<input class="searchBox" type="text" id="group_search" name="group_search" value="" />');
	document.write('<input class="searchButton" type="button" onclick="searchForGroups(document.getElementById(\'group_search\').value);" value="Search"/>');
	</script>
ENDSCRIPT;
	echo '<div id="custGroupArea">';
	br();br();

	while($rowdata = sql_get($sqlresult)){
		//echo $rowdata['NAME'];
		echo "<a href=\"groups.php?f=viewGroup&gid=" . $rowdata['ID'] ." \">" . $rowdata['NAME'] . "</a>";
		echo "<a href=\"groups.php?f=editGroup&gid=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a>";
		echo "<a href=\"index.php?action=rem_group&group=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
		br();
		echo $rowdata['GROUPTYPE'];
		br();
		echo $rowdata['DESCRIPTION'];
		br();br();
	}
	hr();
	echo "</div>";
	
	//$smarty->assign('coursePackagesData',$dataArrayPack);
	
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
