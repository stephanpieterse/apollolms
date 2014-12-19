<h3>Test Results: </h3></br>
<table class="standardTable">
<?php
	$username = $_SESSION['userID'];
	$sqlquery = "SELECT * FROM testresults WHERE STUDENT='" . $username . "'";
	$result = sql_execute($sqlquery);
	
	while($row = sql_get($result)){
		echo "<tr>";
		echo "<td>";
		echo $row['NAME'];
		echo "</td>";
		echo "<td>";
		echo $row['RESULTS'];
		echo "</td>";
		echo "<td>";
		echo $row['RATING'];
		echo "</td>";
		echo "</tr>";
	}
?>
</table>