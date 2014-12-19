<table class="admin_view_table">
<tr>
<th>Marked Date</th>
<th>Marked By</th>
<th>Score</th>
<th>Final Comments</th>
</tr>
<?php
	$q = "SELECT * FROM testsmarks";
	$r = sql_execute($q);
	while($a = sql_get($r)){
		echo '<tr>';
		//echo '<td>' . . '</td>';
		echo '<td>' . $a['MARKEDON'] . '</td>';
		echo '<td>' . $a['MARKEDBY'] . '</td>';
		echo '<td>' . $a['SCORE'] . '</td>';
		echo '<td>' . $a['FINALCOMMENTS'] . '</td>';
		echo '</tr>';
	}
?>
</table>