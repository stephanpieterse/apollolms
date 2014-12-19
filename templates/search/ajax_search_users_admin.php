<?php

	$list = search_users($_GET['sq']);
	$csvlist = implode("','",$list);
	
	$q = "SELECT id,fullname FROM members WHERE id IN ('" . $csvlist . "')";
	$r = sql_execute($q);

	while($d = sql_get){
	echo $d['id'];
	echo $d['fullname'];
	
	}

?>