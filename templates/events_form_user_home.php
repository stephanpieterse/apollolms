<?php

	$q = "SELECT * FROM events";
	$d = sql_execute($q);
	
	if(sql_numrows($d) == 0){
		echo 'There are no current events';
	}
	
	while($r = sql_get($d)){
		echo $r['ID'];
	}
	
?>