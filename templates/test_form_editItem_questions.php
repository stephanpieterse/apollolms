
<form method="post" action="index.php?action=addQuestion&id=<?php echo $id;?> ">

<?php

echo "Select type of question to add: <br />";

$query = "SELECT * FROM tests_questions";
$result = sql_execute($query);

while($row = sql_get($result)){
	echo '<input type="radio" name="question_type" value="' . $row['ID'] . '"/>';
	echo $row['NAME'];
	echo "<br />";
}

?>
<input type="submit" value="Add Question" />
</form>