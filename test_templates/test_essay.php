<?php

class test_essay extends test_item {

function form_insertQuestions(){

	echo 'Question: <br /> <textarea type="text" name="question"></textarea>';
	echo '<br />';
}

function markData($xmlData){
	return $xmlData;
}

function printQuestion($questionData){
	echo $questionData['question'];
}
}
?>