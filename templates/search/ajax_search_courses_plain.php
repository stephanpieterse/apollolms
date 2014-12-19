<?php

	$list = search_courses($_GET['sq']);
	$csvlist = implode("','",$list);
	
	$q = "SELECT id,name FROM courses WHERE id IN ('" . $csvlist . "')";
	$r = sql_execute($q);

	echo 'Search Results: ';
	br();
	while($d = sql_get($r)){
		if(userHasCoursePermission($_SESSION['userID'], $d['id'])){
			//echo $d['id'];
			echo $d['fullname'];
			br();
		}
	}

?>