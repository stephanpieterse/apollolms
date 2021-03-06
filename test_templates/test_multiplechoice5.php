<?php
class test_multipleChoice5 extends test_item {

private $thisClassName = "test_multipleChoice5";
private $thisClassDescription = "A standard test question comprising 5 multiple choice options and an answer field.";
private $thisCanAutoMark = true;
private $thisIsMarkable = true;
private $thisClassNiceName = "Multiple Choice (5)";

function form_insertQuestions(){

	echo 'Question: <input type="text" name="question"/>';
	echo '<br />';
	echo 'Option 1: <input type="text" name="option1" />';
	echo '<br />';
	echo 'Option 2: <input type="text" name="option2" />';
	echo '<br />';
	echo 'Option 3: <input type="text" name="option3" />';
	echo '<br />';
	echo 'Option 4: <input type="text" name="option4" />';
	echo '<br />';
	echo 'Option 5: <input type="text" name="option4" />';
	echo '<br />';
	echo 'Correct Answer: ';
	echo '<select name="answer">';
	echo '<option>1</option>';
	echo '<option>2</option>';
	echo '<option>3</option>';
	echo '<option>4</option>';
	echo '<option>5</option>';
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
	
	case "option1":
		$o1 = $value;
	continue;
	
	case "option2":
		$o2 = $value;
	continue;
	
	case "option3":
		$o3 = $value;
	continue;
	
	case "option4":
		$o4 = $value;
	continue;
	
	case "option5":
		$o5 = $value;
	continue;
	}
	}
	print_bold("Question: ");
	br();
	echo $q;
	br();
	print_bold("1: " . $o1);
	br();
	print_bold("2: " . $o2);
	br();
	print_bold("3: " . $o3);
	br();
	print_bold("4: " . $o4);
	br();
	print_bold("5: " . $o5);
	br();
	
	echo "Please select an answer:" . '</br>';
	echo '<select name="answered"><option>' . $o1 .' </option><option>' . $o2 .' </option><option>' . $o3 .' </option><option>' . $o4 .' </option><option>' . $o5 .' </option></select>';	
}
}
?>