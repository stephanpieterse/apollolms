<?php
	$query = "SELECT * FROM archived_data";
	$result = sql_execute($query);
	
	echo '<table class="admin_view_table">';
	while($data = sql_get($result)){
		echo '<tr><td>';
		echo $data['DATE'];
		echo '</td><td>';
		echo $data['COMMENTS'];
		echo '</td><td>';
	$link = '<a href="backup.php?q=previewData&bid=' . $data['ID'] . '"><img src="' . ICONS_PATH . 'eye.png" alt="preview" /></a>';
	echo $link;
	echo '</td><td>';
	$link = '<a href="backup.php?q=restoreData&bid=' . $data['ID'] . '"><img src="' . ICONS_PATH . 'arrow_redo.png" alt="restore" /></a>';
	echo $link;
	echo '</td><td>';
	$link = '<a href="backup.php?q=removeData&bid=' . $data['ID'] . '"><img src="' . ICONS_PATH . 'bin.png" alt="remove" /></a>';
	echo $link;
	echo '</td></tr>';
	}
	echo '</table>';
?>