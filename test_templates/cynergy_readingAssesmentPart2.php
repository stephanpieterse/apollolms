<?php
class test_cynergy_readingAssesmentPart2 extends test_item {

private $thisClassName = "test_cynergy_readingAssesmentPart2";
private $thisClassDescription = "Part 2 of the Reading Assesment Test. Built for use by the Cynergy Foundation";
private $thisCanAutoMark = true;
private $thisIsMarkable = true;

function form_insertQuestions(){
	echo "Sound File: (URL from the site)";
    echo '<input name="soundfile" type="text" />';
	echo "Word:";
    echo '<input name="spellingbox" type="text" />';
    echo('Synonyms:');
    echo '<input name="synonym1" type="text" /> ';
    echo '<input name="synonym2" type="text" /> ';
    echo '<input name="synonym3" type="text" /> ';
	echo('<input type="submit" value="Submit" />');
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

	case "spelling":
		$tdSPELLING = $value;
	continue;

	case "synonym":
		$tdQUESTION2 = $value;
	continue;
	}
	}
	
	$tdWORD = strtolower($tdWORD);
	$tdSPELLING = preg_replace("[^A..Za..z ]", "" , $tdSPELLING);
	$tdSPELLING = strtolower($tdSPELLING);

	if($tdWORD == $tdSPELLING){
		$correct = true;
	}
		
	if($tdSYNONYM == $tdANSWER){
		$doesUnderstand = true;
	}else{
		$doesUnderstand = false;
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
	
	case "soundfile":
		$tdSOUNDFILE = $value;
	continue;
	
	case "synonym1":
		$tdSYNONYM1 = $value;
	continue;
	
	case "synonym2":
		$tdSYNONYM2 = $value;
	continue;
	
	case "synonym3":
		$tdSYNONYM3 = $value;
	continue;
	}
	}

	echo ('<object type="application/x-shockwave-flash" data="zplayer.swf?mp3=' . $tdSOUNDFILE . '" width="200" height="20">
	<param name="movie" value="zplayer.swf?mp3=' . $tdSOUNDFILE . '" />
	<a href="' . $tdSOUNDFILE . '">Listen</a><br />
	</object>');

 	echo('Spell the word:<br />');
	    echo('<input name="spelling" type="text" /><br />');
	echo 'Another word for it is:';
	br();
	echo '<input name="synonym" type="radio" value="1" />' . $tdSYNONYM1 . '<br />';
	echo '<input name="synonym" type="radio" value="2" />' . $tdSYNONYM2 . '<br />';
	echo '<input name="synonym" type="radio" value="3" />' . $tdSYNONYM3 . '<br />';
}
}
?>