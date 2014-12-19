<form method="POST" action="tests.php?q=insertResult">
<?php
	$rid = $_GET['rid'];
	
	$query = "SELECT * FROM testresults WHERE id='" . $rid . "' LIMIT 1";
	$result = sql_execute($query);
	$r = sql_get($result);
	
	$query = "SELECT * FROM tests WHERE id='" . $r['TID'] . "' LIMIT 1";
	$result = sql_execute($query);
	$t = sql_get($result);
	
	$doc = new DOMDocument();
	$doc->loadXML($r['XMLDATA']);
	$rootNode = $doc->documentElement;

	echo '<input type="hidden" name="testid" value="' . $r['ID'] . '" />';
	
	foreach($rootNode->childNodes as $item){
		//echo $item->tagName;
		echo '<div class="markResultItem">';
		echo print_bold("Question:");
		br();
		if($item->hasAttributes()){
			foreach($item->attributes as $attr){
				echo $attr->name;
				br();
				echo $attr->value;
				br();
				$qAttrArr[$attr->name] = $attr->value;
				if($attr->name == "qid"){
				$qnode = retrieve_question($t['QUESTIONS'],$attr->value);
				$mid = $attr->value;
				foreach($qnode as $key=>$val){
					br();
					echo $key;
					br();
					echo $val;
				}
				}
			}
			
			
		$testType = $qAttrArr['qtype'];	
		$query = "SELECT * FROM tests_questions WHERE id='$testType' LIMIT 1";
		$result = sql_execute($query);
		$typeRow = sql_get($result);
		
		$testClass = $typeRow['CLASS_FILE'];
		include(TEST_CLASSES . $testClass . ".php");
		$testObj = new $testClass();

		$markedResults = $testObj->markData($dataarray);
	
		if($markedResults !== false){
			$autoMarkedCorrectA = xmlGetSpecifiedNode($markedResults,array('tagname'=>'ansdata','correct'=>''));
			$autoMarkedCorrect = $autoMarkedCorrectA['correct'];
		}else{
			$autoMarkedCorrect = false;
		}
			
			br();
			echo "Correct:";
			echo '<input name="correct-' . $mid . '" type="checkbox" ';
			if($autoMarkedCorrect){ echo 'checked="checked"' ;}
			echo '/>';
			br();
			echo print_bold("Comments:"); 
			br();
			echo '<textarea type="text" name="comments-' . $mid . '"></textarea>';
			br();
			echo "</div>";
		}
	}
?>
<br class="clear" />
<h1>Final Comments:</h1>
<br/>
<textarea cols="150" type="text" name="finalcomments"></textarea>
<input type="submit" value="Mark" />
</form>
