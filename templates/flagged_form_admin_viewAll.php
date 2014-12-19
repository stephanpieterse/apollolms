<?php
/**
 * @package ApolloLMS
 * */

	$q = "SELECT * FROM flagged_items";
	$r = sql_execute($q);
	echo '<table class="admin_view_table">';
	while($d = sql_get($r)){
		echo '<tr>';
		echo '<td>' . $d['REASONS'] . '</td>';
		$link = '<td><a href="flagged_items.php?q=removeEntry&fid=' . $d['ID'] .'"><img src="' . ICONS_PATH . 'bin.png" alt="remove" /></a></td>';
		echo $link;
		$link = '<td><a href="' . $d['LINK'] . '"><img src="' . ICONS_PATH . 'eye.png" alt="preview" /></a></td>';
		echo $link;
		echo '</tr>';
	}
	echo '</table>';
?>
