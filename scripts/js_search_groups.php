<?php
include('../config.php');

	$searchFor = $_GET['search'];
	
	$q = "SELECT * FROM groupslist WHERE name LIKE '%".$searchFor."%' OR description LIKE '%".$searchFor."%'";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		echo '<td>';
		echo '<a id="a_admin_user_view" href="groups.php?f=viewGroup&gid=' . $r['ID'] .' ">' . $r['NAME'] . '<img src="' .ICONS_PATH . 'magnifier.png" alt="View"/></a>';
		echo '</td><br/>';
	} 
?>