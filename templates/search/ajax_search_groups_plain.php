<?php

	$list = search_groups($_GET['sq']);
	$csvlist = implode("','",$list);
	
	$q = "SELECT id,name FROM groups_list WHERE id IN ('" . $csvlist . "')";
	$r = sql_execute($q);

	while($d = sql_get){
	echo $d['id'];
	echo $d['name'];
	
	}

?>