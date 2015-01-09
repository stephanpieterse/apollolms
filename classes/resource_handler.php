<?php

class Resource_Handler{
	
	private $XMLstore = '<root></root>';
	private $RESstore = array('resname'=>'','resurl'=>'','resid'=>'');
	
/**
 * Returns 1 greater than the highest id value currently present in the data.
 * 
 */
function get_nextAvailableID(){
	$docXML = new DOMDocument;
	$docXML->loadXML($this->XMLstore);
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

function importXML($xmldata){
	$this->XMLstore = $xmldata;
	return true;
}

function importResource($resdata){
	$this->RESstore = $resdata;
	return true;
}

/**
 * Generates a link to be used to view the resource.
 * 
 **/
function resourceLink_view(){
	$resname = $this->RESstore['resource_name'];
	$resurl = $this->RESstore['resource_url'];
	
	$refurl = selfURL();
	
	$resurl = urldecode($resurl);
	if(strpos($resurl,'resource_view.php') !== false){
		$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $resurl . '&ref=' . urlencode($refurl) .' "> ' . $resname . '</a><br/>';
		return $link;
	}else{
		$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . urlencode($resurl) . '&ref=' . urlencode($refurl) . ' "> ' . $resname . '</a><br/>';
		return $link;	
	}
}
	
function addResource($resdata){
	$xmldata = $this->XMLstore;
	
	$resname = $resdata['resource_name'];
	$resurl = urlencode($resdata['resource_url']);
	$resid = $this->get_nextAvailableID();
	$newCXML = addNode($xmldata, 'resource', array('id'=>$resid,'url'=>$resurl,'name'=>$resname));
	
	return $newCXML;
}

/**
 * @param resdata The node number to be removed
 */
function removeResource($resdata){
	$nodeNum = $resdata;
	$xmldata = rmNode($this->XMLstore,'resource',$nodeNum);
	return $xmldata;
}

function updateResource($resdata){
	$xmldata = $this->XMLstore;
	
	if(isset($resdata['resid'])){
		$resid = $resdata['resid'];
	}else{
		return false;
	}
	$resurl = $resdata['resource_url'];
	$resname = $resdata['resource_name'];
	
	echo $nodeNum = xmlGetSpecifiedNode_Position($xmldata, array('tagname'=>'resource','id'=>$resid,'url'=>$resurl,'name'=>$resname));
	
	$xmldata = rmNode($xmldata,'resource', $resid);
	$xmldata = addNode($xmldata, 'resource', array('id'=>$resid,'url'=>$resurl,'name'=>$resname));
	$newNodeNum = xmlGetSpecifiedNode_Position($xmldata, array('tagname'=>'resource','id'=>$resid,'url'=>$resurl,'name'=>$resname));
	$finalxml = xmlMoveNodeTo($xmldata, $newNodeNum, $nodeNum);
	
	return $finalxml;
}

}
?>
