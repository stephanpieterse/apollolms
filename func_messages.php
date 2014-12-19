<?php
function view_composeMsg(){
	include(TEMPLATE_PATH . "/form_msgCompose.php");
}

function isUserInMsgs($uid, $mid){
		$isInMsg = false;

		$allGroupQ = "SELECT * FROM groupslist WHERE id=\"" . $gid . "\"";
		$aqResult = sql_execute($allGroupQ);
		$groupItem = sql_get($aqResult);
		
		$groupQuery = "SELECT GROUPS FROM members WHERE id=\"" . $uid . "\"";
		$mqResult = sql_execute($groupQuery);
		
			while($row = sql_get($mqResult)){
						
				$xmlDoc = new DOMDocument();
				$xmlDoc->loadXML($row['GROUPS']);
				$rootNode = $xmlDoc->documentElement;
				
				foreach($rootNode->childNodes as $item){
				if($item->hasAttributes()){
				foreach($item->attributes as $attr){
					if($attr->value == $groupItem['NAME']){
						$isInMsg = true;
					}
					}
				}
				}
			}
			
		return $isInMsg;
}

function addMsgToDB(){

}

function getInbox($userID){

}

function displayMsg($msgID){
	$q = "SELECT * FROM messages WHERE id='$msgID'";
	$r = sql_execute($q);
	$d = sql_get($r);
	echo $d['MESSAGE'];	
}

function viewSentMsgs(){
	$q = "SELECT * FROM messages WHERE fromuser='" . $_SESSION['username'] . "'";
	$r = sql_execute($q);
	while($a = sql_get($r)){
		echo print_bold($a['SUBJECT']);
		br();
		echo $a['MESSAGE'];
		br();
	}
}

function sendMsg($data){
	while(list($key,$value) = each($data)){
	switch($key){
		case "subject":
			$msgSubject = makeSafe($value);
			break;
		case "messageBody":
			$msgBody = makeSafe($value);
			break;	
		}
	}
	$msgUser = $_SESSION['username'];
	$toXML = "<to></to>";
	$curTime = date("Y-m-d-H-i-s");
	$query = "INSERT INTO messages (TIMESTAMP, SUBJECT, MESSAGE, FROMUSER, TODATA) VALUES ('$curTime', '$msgSubject','$msgBody', '$msgUser', '$toXML')";
	$r = sql_execute($query);

	$q = "SELECT * FROM messages WHERE timestamp='$curTime' AND message='$msgBody'";
	$r = sql_get(sql_execute($q));
	set_message_permissions($r['ID'], $_POST);
	goHome("msg_send_success");	
}

function viewInbox(){
	$user = $_SESSION['username'];
	$q = "SELECT * FROM messages";
	$r = sql_execute($q);
	
	$member = $_SESSION['userID'];
	while($a = sql_get($r)){
	$hasAccess = false;
		$xmlDoc = new DOMDocument;
		$xmlDoc->loadXML($a['TODATA']);
		$xmlDocRoot = $xmlDoc->documentElement;

	foreach($xmlDocRoot->childNodes as $option){
		$name = $option->tagName;
		if($name == "public"){
			$hasAccess = true;
			continue;
		} // end if public
		
		if($name == "time"){
			$hasAccess = true;
			continue;
		} // end if time
		
		if($name == "user"){
			if($option->getAttribute("id") == $member){
			$hasAccess = true;
			continue;
			}
		} // end if user
		if($name == "group"){
			if(isUserInGroup(($member),($option->getAttribute("id")))){
			$hasAccess = true;
			continue;
		}
		}//end if group
		
		if($hasAccess){
			echo "<li>";
			echo '<a href="?uq=msg&mid=' . $a['ID'] . '">';
			echo print_bold($a['SUBJECT']);
			br();
			echo '</a>';
			echo "</li>";
			/*foreach($a as $i){
				echo $i;
				echo " ";
			}
			*/
			br();	
		}		
	}
	}// end while
} //end function

function viewMessages(){
		viewInbox();
}

function set_message_permissions($id, $access){
if(check_user_permission('content_modify')){
	$query = "SELECT * FROM messages WHERE id='$id' LIMIT 1";
	$result = sql_execute($query);
	$testRow = sql_get($result);
	
	$docXML = new DOMDocument;
	
	if($testRow['TODATA'] == ""){
		$testRow['TODATA'] = "<to></to>";
	}
	
	$docXML->loadXML($testRow['TODATA']);
	$rootNode = $docXML->documentElement;

	while(list($key, $value) = each($access)){
		
		$commands = explode('-', $key);
		$action = $commands['0'];
		$ofType = $commands['1'];
		$ofValue = $commands['2'];	
		
		if($action == "add"){
				
			$childBase = $docXML->createElement("$ofType");
			$childBase->setAttribute('id', $ofValue);
			$childRef = $rootNode->appendChild($childBase);	
		}
		
		if($action == "rem"){
		$nodeToRemove = null;
		foreach($rootNode->childNodes as $child){
		if($child->name == $ofType){
			if($child->hasAttributes()){
			foreach($child->attributes as $attr){
					if(($attr->value) == $ofValue) {
						 $nodeToRemove = $child; 
						 break;
					}
					}	
				}
			}
			}
			}

		if ($nodeToRemove != null){
		$rootNode->removeChild($nodeToRemove);
		$newGroups = $docXML->saveHTML();
		}
	}
	$newDoc = $docXML->saveHTML();
	
	$query = "UPDATE messages SET todata='$newDoc' WHERE id='$id'";
	$result = sql_execute($query);
}
}

function view_all_messages(){
$q = "SELECT * FROM messages ORDER BY timestamp ASC";
$r = sql_execute($q);
while($a = sql_get($r)){
	echo '<a href="?uq=msg&mid=' . $a['ID'] . '">';
	echo $a['SUBJECT'];
	echo '</a>';
	br();
}
}

?>
