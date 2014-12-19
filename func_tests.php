<?php
/**
 * Ends the current test.
 * 
 */
function endTest(){
	$testToCheck = $_SESSION['currentTestName'];
	$timeTaken = (time() - $_SESSION['TimeoutStarted']);
	$query = 'UPDATE testresults SET timetaken="'. $timeTaken .'" WHERE NAME="' . $testToCheck . '" AND STUDENT="' . $_SESSION['userID'] . '"';
	$sqldata = sql_execute($query);
}

/**
 * Adds a result into the database.
 * 
 */
function addResultData($questionID, $testToCheck, $data){
	$q = "SELECT TID FROM tmp_test_questionlist WHERE id='$testToCheck'";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$query = 'SELECT * FROM testresults WHERE TID="' . $r['TID'] . '" AND STUDENT="' . $_SESSION['userID'] . '"';
	$sqldata = sql_execute($query);
	$dataset = sql_get($sqldata);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($dataset['XMLDATA']);
	
	$xmlDocRoot = $xmlDoc->documentElement;
	$newNode = $xmlDoc->createElement("resdata");
	foreach($data as $key=>$value){
		$newNode->setAttribute($key, $value);
	}
	$newNode->setAttribute("qid",$questionID);
	$noderes = $xmlDocRoot->appendChild($newNode);
	$query = "UPDATE testresults SET XMLDATA='" . $xmlDoc->saveHTML() . "' WHERE STUDENT='" . $_SESSION['userID'] . "' AND TID='" . $testToCheck . "'";
	$sqldata = sql_execute($query);
}

/**
 * 
 * Returns the id of the entry where the questionlist to be used is
 */
function test_generateQuestionList($testToStart){
	$query = 'SELECT * FROM tests WHERE ID="' . $testToStart . '" LIMIT 1';
	$sqldata = sql_execute($query);
	
	if(sql_numrows($sqldata) != 1){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?msg=noitemfound">';
	}
	$dataset = sql_get($sqldata);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($dataset['QUESTIONS']);
		
	$xmlAddCmd = new DOMDocument();
	$xmlAddCmd->loadXML($dataset['MISCCOMMANDS']);
	$xmlCmdsRoot = $xmlAddCmd->documentElement;
	
	foreach($xmlCmdsRoot->childNodes as $option){
		$name = $option->nodeName;
		switch($name){
			case "maxquestions":
			$maxQuestions = $option->nodeValue;
			break;
			case "randomize":
			$randomQuestions = $option->nodeValue;
			break;
		}
	}
	
	//$testTemplate = $dataset['NAME'];
	//$query = 'SELECT * FROM tests WHERE NAME="' . $testTemplate . '"';
	//$sqldata2 = sql_execute($query);
	//$dataset2 = sql_get($sqldata2);
	//include($dataset2['TESTTEMPLATE']);	
		
	$questionlist = $xmlDoc->getElementsByTagName("qdata");
	if(isset($maxQuestions)){
		$iM = $maxQuestions;
	}else{
		$iM = $questionlist->length;
	}
	//incomplete: new code set for generating questions list before test starts to avoid refreshing to a new question
	// is this still incomplete?
	
	$i = 1;
	$questionsXML = '<questionslist></questionslist>';
	
	if(isset($randomQuestions)){
	for($x = 0; $x < $iM; $x++){
		$getQ = mt_rand(1,$questionlist->length);
		while(in_array($getQ, $listPastRandom)){
			$getQ = mt_rand(1,$questionlist->length);
		}
		$_SESSION['listCurrentQuestionsList'][] = $getQ;
		$comquestList[] = $getQ;
		
		$itemAttributesList = $questionlist->item($getQ)->attributes;
		foreach($itemAttributesList as $iA){
			$completeQuestionList[$iA->nodeName] = $iA->nodeValue;
		}
		$questionsXML = addNode($questionsXML, 'qdata', $completeQuestionList);
		}
	}else{
		for($x = 0; $x < $iM; $x++){
		$_SESSION['listCurrentQuestionsList'][] = $x;
		$comquestList[] = $x;
		
		$itemAttributesList = $questionlist->item($x)->attributes;
		foreach($itemAttributesList as $iA){
			$completeQuestionList[$iA->nodeName] = $iA->nodeValue;
		}
		$questionsXML = addNode($questionsXML, 'qdata', $completeQuestionList);
		}
	}
	
	$nowtime = date("Y-m-d-H-i-s");
	$q = "INSERT INTO tmp_test_questionlist (tid,uid,question_list,date,misccommands,allowedtime) VALUES('$testToStart','".$_SESSION['userID']."','$questionsXML','$nowtime','".$dataset['MISCCOMMANDS']."','".$dataset['MISCCOMMANDS']."')";
	$r = sql_execute($q);
	
	$q = "SELECT id FROM tmp_test_questionlist WHERE tid='$testToStart' AND date='$nowtime' AND uid='".$_SESSION['userID']."' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$listPastRandom = $_SESSION['listPastRandom'];
	if(isset($randomQuestions)){
		$getQ = mt_rand(1,$questionlist->length);
		while(in_array($getQ, $listPastRandom)){
			$getQ = mt_rand(1,$questionlist->length);
		}
		$_SESSION['listPastRandom'][] = $getQ;
	}else{
		$getQ = $i;
	}
	return $d['id'];
}

/**
 * Parameters:
 * 	- the id of the test to start (as given by generate questionlist function usually)
 * 
 */
function showTest($testToStart){
	$query = 'SELECT * FROM tmp_test_questionlist WHERE ID="' . $testToStart . '" LIMIT 1';
	$sqldata = sql_execute($query);
	
	/* 
	$query = 'SELECT * FROM tests WHERE ID="' . $testToStart . '" LIMIT 1';
	$sqldata = sql_execute($query);
	*/
	
	if(sql_numrows($sqldata) != 1){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?msg=noitemfound">';
		return false;
	}
	$dataset = sql_get($sqldata);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($dataset['QUESTION_LIST']);
	
	/*	
	$xmlAddCmd = new DOMDocument();
	$xmlAddCmd->loadXML($dataset['MISCCOMMANDS']);
	$xmlCmdsRoot = $xmlAddCmd->documentElement;
	
	foreach($xmlCmdsRoot->childNodes as $option){
		$name = $option->nodeName;
		switch($name){
			case "maxquestions":
			$maxQuestions = $option->nodeValue;
			break;
			case "randomize":
			$randomQuestions = $option->nodeValue;
			break;
		}
	}
	 * */
	//$testTemplate = $dataset['NAME'];
	//$query = 'SELECT * FROM tests WHERE NAME="' . $testTemplate . '"';
	//$sqldata2 = sql_execute($query);
	//$dataset2 = sql_get($sqldata2);
	//include($dataset2['TESTTEMPLATE']);
	
	if(checkForTimeout($dataset['ALLOWEDTIME']) == true)
	{
		//testMarker($testToStart);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?msg=test_time_expired">';
	}	
		
	$questionlist = $xmlDoc->getElementsByTagName("qdata");
	$iM = $questionlist->length;
	
	$i = $_SESSION['currentQuestion'];
	//$_SESSION['currentQuestion'] = $_SESSION['currentQuestion'] + 1;
	//incomplete: new code set for generating questions list before test starts to avoid refreshing to a new question
	
	if($i < $iM){
		$questiondata = $questionlist->item($i);
		foreach($questiondata->attributes as $child){
		$dataarray[$child->name] = $child->value;
		}	
		if($dataset['ALLOWEDTIME'] != 0){
		echo round(($dataset['ALLOWEDTIME'] - (time() - $_SESSION['TimeoutStarted'])) / 60) . " minutes remaining. ";
		}
		echo "Question " . ($i + 1). " of " . $iM;
		
		$testType = $dataarray['question_type'];	
		$query = "SELECT * FROM tests_questions WHERE id='$testType' LIMIT 1";
		$result = sql_execute($query);
		$typeRow = sql_get($result);
		
		echo '<form method="POST" action="index.php?action=addResult&tid='. $testToStart . '&qid=' . $dataarray['id'] .'">';
		$testClass = $typeRow['CLASS_FILE'];
		include(TEST_CLASSES . $testClass . ".php");
		$testObj = new $testClass();
		$testObj->printQuestion($dataarray);	
		echo '<input type="submit" value="Submit" />';
		echo '</form>';
		//testFormat($dataarray);
	}else{
		 //testMarker($testToStart);
		endTest();
		goHome("test_completed");
	}
}

/**
 * Initiate db data for a test to be taken
 * 
 */
function initTestData(){
	$_SESSION['currentTestName'] = $_GET['tid'];
	$_SESSION['currentQuestion'] = 0;
	$_SESSION['TimeoutStarted'] = time();
	$_SESSION['listPastRandom'] = array();
	$sesTID = $_GET['tid'];
	
	$query = "SELECT * FROM tests WHERE id='". $sesTID . "' LIMIT 1";
	$r = sql_execute($query);
	$r = sql_get($r);
	
	$sesTestName = $r['NAME'];
	$testDate = date("Y-m-d-H-i-s");
	$sesUserName = $_SESSION['userID'];
	
	$query = "SELECT * FROM testresults WHERE STUDENT='" . $_SESSION['userID'] . "' AND TID='" . $sesTID . "'";
	$emptyTest = sql_execute($query);
	
	$query = "SELECT * FROM tests WHERE ID='$sesTID'";
	$nameRes = sql_execute($query);
	$row = sql_get($nameRes);
	//$testFriendlyName = $row['FRIENDLYNAME'];
	
	if(sql_numrows($emptyTest) == 0){
	$sqlquery = "INSERT INTO testresults (TESTDATE, TID, NAME, STUDENT, XMLDATA, MARKED) VALUES ('$testDate', '$sesTID', '$sesTestName','$sesUserName','<root></root>', '0')";
	$sqldata = sql_execute($sqlquery);
	}else{
			$query = 'SELECT * FROM testresults WHERE student="' . $_SESSION['userID'] . '" AND tid="' . $sesTID . '"';
			$result = sql_get(sql_execute($query));
			backupData($result, ("Backup of Previous Test Results: " .  $sesTestName . " " . $_SESSION['username'] . 'testresults'),"testresults");
	$sqlquery = "UPDATE testresults SET XMLDATA='<root></root>', MARKED='0' WHERE STUDENT='" . $_SESSION['userID'] . "' AND tid='" . $sesTID . "'";
	$sqldata = sql_execute($sqlquery);
	}
	// test initialisation should now be here, not in ShowTest();
	$questionsToUse = test_generateQuestionList($sesTID);
	$_SESSION['currentTestName'] = $questionsToUse;
	
	return true;
}

/**
 * Scans for highest available id and returns one higher
 * 
 */
function get_nextAvailableID($questionSet){
	$docXML = new DOMDocument;
	$docXML->loadXML($questionSet);
	$rootNode = $docXML->documentElement;
	
	$availableID = 1;
	
		$numNodes = $rootNode->childNodes->length;
		if($numNodes > 0){
		$lastNode = $rootNode->childNodes->item($numNodes-1);
		if($lastNode->hasAttributes()){
			$lastID = $lastNode->getAttribute(id);
			$availableID = $lastID + 1;
		}
		}
	return $availableID;
}

/**
 * Sets permissions for the test.
 * Wraps the generic / common permissions setter.
 * */
function set_test_permissions($id, $access){
if(!check_user_permission('test_modify')){
	return false;
}
	$newDoc = common_set_permissions($access);
	
	$query = "UPDATE tests SET access='$newDoc' WHERE id='$id'";
	$result = sql_execute($query);
}

/**
 * Add a question to a test
 * Params:
 * 	id - the id of ?
 * qtype - the id of the type of question
 * 
 */
function mod_test_addQuestion($id, $qtype){
	$query = "SELECT * FROM tests_questions WHERE id='$qtype' LIMIT 1";
	$result = sql_execute($query);
	$row = sql_get($result);
	
	include(TEST_CLASSES . $row['CLASS_FILE'] . ".php");
	$item = new $row['CLASS_FILE'];
	
	echo '<form method="post" action="index.php?action=insertQuestion&id=' . $id . '">';
	$item->form_insertQuestions();
	echo '<input type="hidden" name="question_type" value="' . $row['ID'] . '" />';
	echo '<input type="submit" value="Insert Question" />';
	echo '</form>';
}

/**
 * 
 * 
 */
function mod_test_insertQuestion($id, $vars){
	$query = "SELECT * FROM tests WHERE id='$id' LIMIT 1";
	$result = sql_execute($query);
	$testRow = sql_get($result);
	
	$docXML = new DOMDocument;
	if($testRow['QUESTIONS'] == ""){$xmldata = "<testdata></testdata>";} else {$xmldata = $testRow['QUESTIONS'];}
	$docXML->loadXML($xmldata);
	$rootNode = $docXML->documentElement;

	$newID = get_nextAvailableID($xmldata);
	
	$childBase = $docXML->createElement("qdata");
	$childBase->setAttribute("id", "$newID");
	foreach($vars as $key=>$value){
		if(($key != "submit")){
			$childBase->setAttribute("$key", "$value");
		}
	else{
		continue;
	}
}
	$childRef = $rootNode->appendChild($childBase);	
	$newDoc = $docXML->saveHTML();	
	$query = "UPDATE tests SET questions='$newDoc' WHERE id='$id'";
	$result = sql_execute($query);
	'<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?msg=test_add_question_success">';
}

/**
 * 
 * 
 */
function listAvailableTestsWithResults(){
	// super temp code
	$linklist[0] = "<a></a>";
		
	while ($row = sql_get($sqlresultContent)){
		$teststatus = " - Not Completed";
		
		if($hasAccess){
		$newdataname = $row['TESTNAME'];
		$newdatafriendly = $row['TESTNAME'];
		$newdatadesc = $row['DESCRIPTION'];
		while($testrow = sql_get($sqlresult2)){
			if(($testrow['NAME'] == $newdataname) && ($testrow['STUDENT'] == $_SESSION['userID'])){
				$teststatus = " - Test Taken";
				if($testrow['TIMETAKEN'] != 0){
					$teststatus = $teststatus . " - Completed";
				}
				else{
					$teststatus = $teststatus . " - Not Completed";
				}
				break;
			}else{
				$teststatus = " - Test Not Taken";
			}
		}
		$linkref = "<a href='index.php?action=setInitTest&testName=" . $newdataname . "'>" . $newdatafriendly . "</a>" . $teststatus . "<br/>" . $newdatadesc;
		//mysql_data_seek($sqlresult2,0); 
		$linklist[$x] = $linkref;
		$x++;
	}else{
		echo "No tests are available to you at this time.";
		break;
	}
}
	return $linklist;
}

/**
 * 
 * 
 */
function deleteTestResult($id){
		if(check_user_permission("test_result_remove")){
		
		$query = 'SELECT * FROM testresults WHERE ID="' . $id . '"';
		$result = sql_get(sql_execute($query));
		backupData($result, ("Test Result Deletion " .  $id . " " . $result['NAME'] . $result['STUDENT']), 'testresults');
		
		$query = 'DELETE FROM testresults WHERE ID="' . $id . '"';
		$result = sql_execute($query);
		/*if($result){
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?msg=result_remove_success">';
		}else
		{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?msg=content_remove_failure">';
		}*/
		return true;
	}else{
		return false;
	}
}

/**
 * 
 * 
 */
function retrieve_question($xml, $id){
	$doc = new DOMDocument;
	$doc->loadXML($xml);
	$rootNode = $doc->documentElement;
	
	$finArr = null;
	
	foreach($rootNode->childNodes as $item){
		if($item->hasAttributes()){
			foreach($item->attributes as $attr){
				if(($attr->name == 'id') && ($attr->value == $id)){
						$retnode = $item;
				}
			}
			}				
		}
		if(isset($retnode)){
			foreach($retnode->attributes as $attr){
				$finArr[$attr->name] = $attr->value;
			}
		}
		return $finArr;
}

/**
 * 
 * 
 */
function insertResult($data){
	foreach($data as $key=>$value){
	switch($key){
	
	case "testid":
		$tid = $value;
		break;
	
	case "finalcomments":
		$finalComments = $value;
		break;
	}
}
	$markTime = date("Y-m-d-H-i-s");
	$markedBy = $_SESSION['userID'];
	
	$query = "INSERT INTO testsmarks (TID, MARKEDON, FINALCOMMENTS, MARKEDBY) VALUES ('$tid','$markTime', '$finalComments', '$markedBy')";
	$result = sql_execute($query);
	
	$q = "UPDATE testresults SET marked='1' WHERE id='$tid'";
	$r = sql_execute($q);
	
	return true;
}

/**
 * Removes a question from the test dataset
 * @param int $tid ID of the test
 * @param int $qid ID of the question
 * 
 */
function rm_question($tid, $qid){
	if(check_user_permission("test_modify")){
		$query = 'SELECT * FROM tests WHERE id="' . $tid . '" LIMIT 1';
		$result = sql_execute($query);
		$data = sql_get($result);
		$doc = new DOMDocument; 
		$doc->loadXML($data['QUESTIONS']);
		$docRoot = $doc->documentElement;

		$nodeToRemove = null;
		foreach($docRoot->childNodes as $child){
			if($child->hasAttributes()){
			$nodeID = $child->getAttribute("id");
					if(($nodeID) == $qid) {
						 $nodeToRemove = $child; 
						 break;
					}
				}
			}

		if ($nodeToRemove != null){
		$docRoot->removeChild($nodeToRemove);
		$newGroups = $doc->saveHTML(); 		

		$query = "UPDATE tests SET questions='" . $newGroups . "' WHERE id='" . $tid . "'";
		$result = sql_execute($query);
		return true;
		}
		}else{
			return false;
		}
}

/**
 * Parameters:
 * 	name - name for item
 * desc - description
 * 	code - item code
 * 
 * inserts new test item
 * 
 */
function insertNewTestItem($name, $desc, $code){
	if(check_user_permission('test_add')){
	$name = makeSafe($name);
	$desc = makeSafe($desc);
	$code = makeSafe($code);

	$query = "INSERT INTO tests(name, description, code, access, questions, misccommands) VALUES('$name', '$desc', '$code', '<access></access>', '<testdata></testdata>', '<commands></commands>')";
	$result = sql_execute($query);
		return true;
	}else{
		return false;
	}	
}

/**
 * 
 * 
 */
function loadInsertForm($type){
	echo '<form method="post" action="">';
	$testForm = new $type;
	$testForm->form_insertQuestions();
	echo '<input type="submit" value="Insert Question" />';
	echo '</form>';
}

/**
 * 
 */
function test_func_installQuestion(){
	$target_path = MODULE_PATH;
	$ext = pathinfo($moduleFile['uploadedfile']['name'], PATHINFO_EXTENSION);

	if(($ext != 'php') && ($ext != 'zip')){
		return false;
	}
	// insert scan for malicious code function
	$target_path = $target_path . basename( $moduleFile['uploadedfile']['name']);

	if(file_exists($target_path)){
		unlink($target_path);
	}

	if(move_uploaded_file($moduleFile['uploadedfile']['tmp_name'], $target_path)) {
	
	$moduleFile = $target_path;
	
	$classname = get_file_class($moduleFile);
	include_once($moduleFile);
	$moduleObj = new $classname();
	if(method_exists($moduleObj,'installTestVars')){
		$installVars = $moduleObj->installTestVars();
		$q = "SELECT * FROM tests_questions WHERE class_name='" . $classname ."'";
		$r = sql_execute($q);
		if(sql_numrows($r) == 1){
		$d = sql_get($r);
			if($d['version'] < $installVars['version']){
		$q = "UPDATE tests_questions SET name='".$installVars['name']."', description='".$installVars['description']."', class_file='".basename($moduleFile)."', WHERE id='".$d['ID'] . "'";
		$r = sql_execute($q);
		}
		}else{
		$q = "INSERT INTO modules (class_name,name,codetorun,description) VALUES('$classname','".$installVars['name']."','".basename($moduleFile)."','".$installVars['description']."')";
		$r = sql_execute($q);
		}
	}else{
		echo "Class does not contain installation variables; Did not install.";
	}
	}
}

/**
 * Generic function to check if user has permissions to a test
 * TODO this was just copied over we can optimise it a lot probably
 * */
function userHasTestPermission($uid,$tid){
	$query = "SELECT * FROM tests WHERE id='" . $tid . "' LIMIT 1";
	$sqlresultContent = sql_execute($query);
	$query  = "SELECT * FROM testresults";
	$sqlresultResults = sql_execute($query);
	$query = "SELECT * FROM members WHERE id='" . $uid . "' LIMIT 1";
	$sqlresultMembers = sql_execute($query);
	$x = 0;
	
	$memberData = sql_get($sqlresultMembers);
	
	while($contentRow = sql_get($sqlresultContent)){
	$xmlDoc = new DOMDocument();
	
	if($contentRow['ACCESS'] == ""){
		$contentRowData = "<access></access>";
	}else{
		$contentRowData = $contentRow['ACCESS'];
	}
	$xmlDoc->loadXML($contentRowData);
	$xmlDocRoot = $xmlDoc->documentElement;
	$hasAccess = false;
	
	foreach($xmlDocRoot->childNodes as $option){
		$name = $option->nodeName;
		if($name == "public"){
			$hasAccess = true;
			break;
		}
		
		if($name == "user"){
			if($option->getAttribute("id") == $memberData['ID']){
			$hasAccess = true;
			break;
			}
		}
		if($name == "group"){
			if(isUserInGroup(($memberData['ID']),($option->getAttribute("id")))){
			$hasAccess = true;
			break;
		}
		}
		if($name == "grouptype"){
			if(isUserInGroup(($memberData['ID']),($option->getAttribute("id")))){
			$hasAccess = true;
			break;
		}
		}
	}
	return $hasAccess;
}
}
?>
