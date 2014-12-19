<form name="linkTests" method="post" action="index.php?action=linkT2Cdata">
Course:<br />
<select name="selectedCourse">
<?php	
$sqlquery = "SELECT * FROM courses";
$sqlresult = sql_execute($sqlquery);
while ($row = sql_get($sqlresult)){
echo '<option> ' . $row['NAME'] . '</option> <br />';
}
?>
</select>
<br />
Articles:<br />
<?php	
$sqlquery = "SELECT * FROM tests";
$sqlresult = sql_execute($sqlquery);
		while ($row = sql_get($sqlresult)){
					echo '<input type="checkbox" name="' . $row['ID'] . '" /> ' . $row['NAME'] . '';
				if($row['PUBLISHED_STATUS'] == 0){
							echo " - Not Published";	
				}	
			echo '<br />';
				}
				?>
		<input type="submit" value="Link" />
	</form>