<?php

class ALMS_XMLHandler {
	private $xmlDoc;
	
	function __construct($document){
		$this->xmlDoc = new DOMDocument;
		if($document != ''){
			$this->xmlDoc->loadXML($document);
		}else{
			$this->xmlDoc->loadXML('<data></data>');
		}
	}
	
	private function getNextHighId(){
	$xpath = '//*[@id]';
	$xdoc = new DOMXPath($this->xmlDoc);
	$nodelist = $xdoc->query($xpath);
	
	$availableID = 1;
	foreach($nodelist as $item){
			$lastID = $item->getAttribute('id');
			if($lastID > $availableID){
				$availableID = $lastID + 1;
			}
		}
		
	return $availableID;
	}
	
	public function loadXML($xmlData){
		$this->xmlDoc = new DOMDocument;
		$this->xmlDoc->loadXML($xmlData);
		return true;
	}
	
	public function insertNode($tagname, $newNodeData, $whereTo){
		$xpath = new DOMXPath($this->xmlDoc);
		$nodeList = $xpath->query($whereTo);
		
		$newChild = $this->xmlDoc->createElement($tagname);

		foreach($newNodeData as $key=>$value){
			$newChild->setAttribute($key, $value);
		}
	
		$newRef = $nodeList[0]->appendChild($newChild);
		
		return true;
	}
	
	public function updateNode($tagname, $newNodeData, $whereTo){
		$xpath = new DOMXPath($this->xmlDoc);
		$nodeList = $xpath->query($whereTo);
		
		$prevID = $nodeList[0]->getAttribute('id');
		
		
		return true;
	}
	
	public function getNodeList($whereTo){
		$xpath = new DOMXPath($this->xmlDoc);
		$nodeList = $xpath->query($whereTo);
		return $nodeList;
	}
	
	public function getXML(){
		return $this->xmlDoc->saveHTML;
	}
	
}
