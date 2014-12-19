<?php
	$query = 'SELECT * FROM groups_types WHERE id="' . $id . '"';
	$result = sql_execute($query);
	$row = sql_get($result);
?>
<form method="post" action="index.php?action=update_groupType&id=<?php echo $id;?>">
<?php
echo $row['NAME'];
echo "<br />";
echo '<textarea rows="5" cols="250" type="text" name="description" >' . $row['DESCRIPTION'] . '</textarea>';
echo "<br />";
?>
<input type="submit" value="Update Group Type" />
</form>