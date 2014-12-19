<?php
class test_cynergy_readingAssesmentPart1 extends test_item {

private $thisClassName = "test_cynergy_readingAssesmentPart1";
private $thisClassDescription = "Part 1 of the Reading Assesment Test. Built for use by the Cynergy Foundation";
private $thisCanAutoMark = true;
private $thisIsMarkable = true;

function form_insertQuestions(){
	echo 'Word: <input type="text" name="word"/>';
	echo '<br />';
	echo 'Context Sentence: <input type="text" name="contextsentence" />';
	echo '<br />';
	echo 'Possible Meaning 1: <input type="text" name="meaning1" />';
	echo '<br />';
	echo 'Possible Meaning 2: <input type="text" name="meaning2" />';
	echo '<br />';
	echo 'Possible Meaning 3: <input type="text" name="meaning3" />';
	echo '<br />';
	echo 'Correct Answer: ';
	echo '<select name="answer">';
	echo '<option>1</option>';
	echo '<option>2</option>';
	echo '<option>3</option>';
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

	case "understand":
		$tdQUESTION1 = $value;
	continue;

	case "synonym":
		$tdQUESTION2 = $value;
	continue;
	}
	}
	
	if($tdANSWER == $tdQUESTION2){
		$correct = true;
	}
	
	switch($tdQUESTION1){
	case "A":
		$doesUnderstand = "Yes";
		break;
	case "B":
		$doesUnderstand = "No";
		break;
	case "C":
		$doesUnderstand = "Maybe";
		break;
}

	$retXML = new DOMDocument;
	$node = $retXML->createElement("ansdata");
	$node->setAttribute("id", $id);
	$node->setAttribute("answer", $ans);
	$node->setAttribute("answered", $ansd);
	$node->setAttribute("correct", $correct);
	$node->setAttribute("understand", $doesUnderstand);
	$root = $retXML->appendChild($node);
	
	$resVal = $retXML->saveHTML();
	return $resVal;
}

function printQuestion($questionData){

foreach($questionData as $key=>$value){
	switch($key){
	
	case "word":
		$tdWORD = $value;
	continue;
	
	case "contextsentence":
		$tdCONTEXTSENTENCE = $value;
	continue;
	
	case "meaning1":
		$tdMEANING1 = $value;
	continue;
	
	case "meaning2":
		$tdMEANING2 = $value;
	continue;
	
	case "meaning3":
		$tdMEANING3 = $value;
	continue;
	}
	}

	echo $tdCONTEXTSENTENCE;
	br();
	echo print_bold($tdWORD);
	br();
	echo 'Do you know this word?';
	br();
	echo '<input name="understand" type="radio" value="A" /> Yes <br />';
	echo '<input name="understand" type="radio" value="B" /> No <br />';
	echo '<input name="understand" type="radio" value="C" /> Maybe <br />';
	echo 'Another word for it is:';
	br();
	echo '<input name="synonym" type="radio" value="1" />' . $tdMEANING1 . '<br />';
	echo '<input name="synonym" type="radio" value="2" />' . $tdMEANING2 . '<br />';
	echo '<input name="synonym" type="radio" value="3" />' . $tdMEANING3 . '<br />';
}
}
?>