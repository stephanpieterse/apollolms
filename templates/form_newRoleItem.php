<style>

.shortInput input {
	width: 25px;
}

</style>

<form name="addRole" method="post" action="index.php?action=newRoleItem">
<table>
<tr>
<td>
Role Name:
</td><td>
<input name="rolename" id="rolename" type="text" value="role_name"/>
</td>
</tr>
<tr>
<td>
Permissions:
</td><td class="shortInput" style="text-align:left;">
<?php

	$query = 'SELECT * FROM role_permissions WHERE hidden="0"';
	$result = sql_execute($query);
	
	while($row = sql_get($result)){
		echo '<input name="' . $row['PERMISSION'] . '" id="' . $row['PERMISSION'] . '" type="checkbox" />';
		echo '<label for="' . $row['PERMISSION'] . '">';
		echo $row['NAME'];
		echo '</label>';
		
		
		echo '<br />';
		echo $row['DESCRIPTION'];
		echo '<br />';
		echo '<br />';
	}
?>
</td>
</tr>
</table>
<input type="submit" value="Add New Role" />
</form>