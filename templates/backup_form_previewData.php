<?php

	$q = "SELECT * FROM archived_data WHERE id='$backID' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	var_dump($d);

?>
