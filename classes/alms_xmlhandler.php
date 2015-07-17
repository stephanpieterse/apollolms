<?php

class ALMS_XMLHandler {
	private $xmlDoc;
	
	private function __construct($document){
		$this->xmlDoc = new DOMDocument;
		$this->xmlDoc->loadXML($document);
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
	
	public function getNodeList($whereTo){
		$xpath = new DOMXPath($this->xmlDoc);
		$nodeList = $xpath->query($whereTo);
		return $nodeList;
	}
	
	public function getXML(){
		return $this->xmlDoc->saveHTML;
	}
	
}
