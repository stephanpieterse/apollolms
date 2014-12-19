<?php
class test_truefalse extends test_item {

private $thisClassName = "test_truefalse";
private $thisClassDescription = "A standard true / false question.";
private $thisCanAutoMark = true;
private $thisIsMarkable = true;
private $thisClassNiceName = "True / False";

function get_class_nicename(){
	return $thisClassNiceName;
}

function get_class_name(){
	return $thisClassName;
}

function get_class_description(){
	return $thisClassDescription;
}

function can_autoMark(){
	return $thisCanAutoMark;
}

function is_markable(){
	return $thisIsMarkable;
}

function form_insertQuestions(){

	echo 'Question: <input type="text" name="question"/>';
	echo '<br />';
	echo 'Correct Answer: ';
	echo '<select name="answer">';
	echo '<option>True</option>';
	echo '<option>False</option>';
	echo '</select>';
	echo '<br />';
}

function markData($xmlData){

	$correct = false;

	foreach($xmlData as $key=>$value){
	switch($key){
	
	case "id":
		$id = $value;
	continue;
	
	case "answer":
		$ans = $value;
	continue;
	
	case "answered":
		$ansd = $value;
	continue;
	
	case "question":
		$q = $value;
	continue;
	}
	}
	
	if($ans == $ansd){
		$correct = true;
	}
	
	$retXML = new DOMDocument;
	$node = $retXML->createElement("ansdata");
	$node->setAttribute("id", $id);
	$node->setAttribute("answer", $ans);
	$node->setAttribute("answered", $ansd);
	$node->setAttribute("correct", $correct);
	$root = $retXML->appendChild($node);
	
	$resVal = $retXML->saveHTML();
	return $resVal;
}

function printQuestion($questionData){
	
foreach($questionData as $key=>$value){
	switch($key){
	
	case "question":
		$q = $value;
	continue;
	
	case "True":
		$o1 = $value;
	continue;
	
	case "False":
		$o2 = $value;
	continue;

	}
	}
	print_bold("Question: ");
	br();
	echo $q;
	br();
	
	echo "Please select true or false:" . '</br>';
	echo '<input type="radio" name=answered />' . $o1 . '<br/>'	.'<input type="radio" name=answered />' . $o2 . '<br/>';
}
}
?>