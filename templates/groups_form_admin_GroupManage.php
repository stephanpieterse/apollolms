<?php

	$sqlquery = "SELECT * FROM groupslist ORDER BY grouptype ASC";
	$sqlresult = sql_execute($sqlquery);
		
	echo '<div style="width:50%; float:left">';
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
	echo "</div>";

$sqlquery = "SELECT * FROM groups_types";
	$sqlresult = sql_execute($sqlquery);
	echo '<div style="width:50%; float:left">';
	echo <<<ENDSCRIPT
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
	document.write('<input class="searchBox" type="text" id="grouptype_search" name="grouptype_search" value="" />');
	document.write('<input class="searchButton" type="button" onclick="searchForGroupTypes(document.getElementById(\'grouptype_search\').value);" value="Search"/>');
	</script>
ENDSCRIPT;
	echo '<div id="custGroupTypeArea">';
	br();br();
	while($rowdata = sql_get($sqlresult)){
		echo $rowdata['NAME'];
		echo "<a href=\"groups.php?f=editGroupType&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a>";
		echo "<a href=\"index.php?action=rm_groupType&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
		br();
		echo $rowdata['DESCRIPTION'];
		br();br();
	}
	hr();
	echo "</div>";
	echo "</div>";
	echo '<br class="clear"/>';
?>