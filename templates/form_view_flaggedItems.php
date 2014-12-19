<?php
	$q = "SELECT * FROM flagged_items";
	$r = sql_execute($q);
	echo '<table class="admin_view_table centerfloat">';
	while($d = sql_get($r)){
		echo '<tr>';
		echo '<td>' . $d['REASONS'] . '</td>';
		
		$link = '<td><a href="' . $d['ID'] .'">Remove Entry</a></td>';
		echo $link;
		$link = '<td><a href="' . $d['LINK'] . '">Go To Item</a></td>';
		echo $link;
		br();
	}
	echo '</table>';
?>