<?php

	$query = "SELECT * FROM archived_data";
	$result = sql_execute($query);
	
	if(sql_numrows($result) == 0){
		echo "There are no items in the archive.";
	}
	
	echo '<table class="admin_view_table">';
	while($data = sql_get($result)){
		echo '<tr>';
		echo '<td>' . $data['DATE'] . '</td>';
		echo '<td>' . $data['COMMENTS'] . '</td>';
	$link = '<td><a href="?aq=restoreData&bid=' . $data['ID'] . '">Restore</a></td>';
	echo $link;
	echo '</tr>';
	br();
	}
	echo "</table>";

?>