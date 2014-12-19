<?php
include('../config.php');

	$searchFor = $_GET['search'];
	
	$q = "SELECT * FROM members WHERE email LIKE '%".$searchFor."%' OR name LIKE '%".$searchFor."%'";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		echo '<td>';
		echo '<a id="a_admin_user_view" href="index.php?action=admin_view_user&uid=' . $r['ID'] .' ">' . $r['NAME'] . '<img src="' .ICONS_PATH . 'magnifier.png" alt="View"/></a>';
		echo '</td><br/>';
	} 
?>