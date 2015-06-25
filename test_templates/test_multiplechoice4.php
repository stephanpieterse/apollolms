<?php
class test_multipleChoice4 extends test_item {

private $thisClassName = "test_multipleChoice4";
private $thisClassDescription = "A standard test question comprising 4 multiple choice options and an answer field.";
private $thisCanAutoMark = true;
private $thisIsMarkable = true;
private $thisClassNiceName = "Multiple Choice (4)";

function form_insertQuestions(){
	echo 'Question: <input type="text" name="question"/>
	<br />
	Option 1: <input type="text" name="option1" />
	<br />
	Option 2: <input type="text" name="option2" />
	<br />
	Option 3: <input type="text" name="option3" />
	<br />
	Option 4: <input type="text" name="option4" />
	<br />
	Correct Answer: 
	<select name="answer">
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>
	</select>
	<br />';
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
	}
	}
	echo "<b>Question: </b><br/>";
	echo $q;
	echo "1: " . $o1 . '<br/>';
	echo "2: " . $o2 . '<br/>';
	echo "3: " . $o3 . '<br/>';
	echo "4: " . $o4 . '<br/>';
	
	echo "Please select an answer:" . '</br>';
	echo '<select name="answered"><option>' . $o1 .' </option><option>' . $o2 .' </option><option>' . $o3 .' </option><option>' . $o4 .' </option></select>';
	}
}
