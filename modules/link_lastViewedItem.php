<?php

class LastViewedLink extends module_item{
	private $myID = 0;
	private $moduleVars = array('MVER'=>'1','MTYPE'=>'group','MNAME'=>'Link Last Viewed','MDESC'=>'This module displays a link to the last viewed course item.');
	public $plugin_support = array('admin_user_view_single');
	
/**
 * TODO this function should read the history in reverse
 */
	
function getLastViewed(){
	$q = "SELECT HISTORY FROM member_view_history WHERE uid='" . $_SESSION['userID'] . "' LIMIT 1";
	$r = sql_execute($q);
	$r = sql_get($r);
	
	$xmlDoc = new DOMDocument();
	$data = $r['HISTORY'];
	if($data != ""){
	$xmlDoc->loadXML($data);
	$rootNode = $xmlDoc->documentElement;
	
	$lastPnm = 0;
	$lastAid = 0;
	$lastCid = 0;
	
	foreach($rootNode->childNodes as $child){
		
		if($child->hasAttributes()){
		foreach($child->attributes as $attr){
			switch($attr->name){
			case "pnm":
				$lastPnm = $attr->value;
				break;
			case "aid":
				$lastAid = $attr->value;
				break;
			case "cid":
				$lastCid = $attr->value;
				break;
				}
			}			
		}
	
		if($lastPnm != 0 && $lastAid != 0 && $lastCid !=){
			$foundSomething = true;	
		}
	
	}
	if($foundSomething){
		$link = '<a href="index.php?uq=viewPage&pnm=' . $lastPnm . '&aid=' . $lastAid . '&cid=' . $lastCid . '">Go to last viewed item.</a><br/>';
		return $link;
	}
	}
}
	
	function default_action($location){
		switch($location){
			case 'home':
				echo $this->getLastViewedItem();
			break;
	}
		
	}
}
