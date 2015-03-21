<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
/**
 * Returns the position of a specified node
 * @param xml $xmldata
 * @param array $nodeattrib
 * */
function xmlGetSpecifiedNode_Position($xmldata, $nodeattrib){
	$doc = new DOMDocument; 
	
	if($xmldata == ""){
		return $specNodeArr[] = 1;
	}
	
	$currentNode = 0;
	$foundNode = false;
	
	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;
	
	foreach($docRoot->childNodes as $child){
		foreach($nodeattrib as $key=>$val){
			if($child->tagName == $nodeattrib['tagname']){
				if($child->hasAttributes()){
					if($child->getAttribute($key) != null && $child->getAttribute($key) == $val){
						$foundNode = $currentNode;
					}
				}
			}
			
		}	
		$currentNode++;
		if($foundNode !== false){
			break;
		}
		
	}
	
	return $foundNode;
}

/**
 * 
 * NOTA: die function is baie van 'n moerawiese fokop wat nogal goed werk. maar ek kan maybe xpath gebruik in die toekoms om dit makliker te maak.
 */
function xmlGetSpecifiedNode($xmldata, $nodeattrib){
	$doc = new DOMDocument; 
	
	if($xmldata == ""){
		return $specNodeArr[] = 1;
	}
	
	if(!isset($nodeattrib['tagname'])){
		return 'Function has to specify a tag name for searching';
	}
	
	$specNodeArr = $nodeattrib;
	
	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;
	
	foreach($docRoot->childNodes as $child){
	foreach($nodeattrib as $key=>$val){
			if($child->tagName == $nodeattrib['tagname'] && $key != 'tagname'){
				if($child->hasAttributes()){
					if($nodeattrib[$key] != '' ){
						$uniqID[$key] = $val;
					}else{
					if($child->getAttribute($key) != null){
						if(isset($uniqID)){
							//$keys = array_keys($uniqID);
							foreach($uniqID as $k=>$v){
								if(($child->getAttribute($k) == $v)){
									$specNodeArr[$key] = $child->getAttribute($key);
								}
							}
						}else{
							$specNodeArr[$key] = $child->getAttribute($key);
						} 
						} // end if attr != null
					} // end else
				} // end if hasattributes
			} // end tagname if
		}	// end while
	} // end foreach
	
	return $specNodeArr;
}

/**
 * Checks if a specified node exists within xml data
 * Param:
 * xmldata - set of data in xml format
 * nodeattrib - an array of attributes to search for
 */
function xmlHasSpecifiedNode($xmldata, $nodeattrib){
	$doc = new DOMDocument; 
	
	if($xmldata == ""){
		return false;
	}
	
	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;
	
	$hasSpecNode = false;
	
	foreach($nodeattrib as $key=>$val){
		foreach($docRoot->childNodes as $child){
			if($child->hasAttributes()){	
				if($child->getAttribute($key) == $val){
					if(isset($nodeattrib['tagname'])){
						if($child->tagName == $nodeattrib['tagname']){
							$hasSpecNode = true;
							break;
						}
					}else{
						$hasSpecNode = true;
						break;
					}
				}
			}
			if(isset($nodeattrib['tagname']) && sizeof($nodeattrib) == 1){
				if($child->tagName == $nodeattrib['tagname']){
					$hasSpecNode = true;
					break;
				}
			}
		}	
	}
	return $hasSpecNode;
}

function xmlHasChildren($xmldata){
	$doc = new DOMDocument; 
	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;
	//$nodeNum = $nodeNum;
	$totalNodes = $docRoot->childNodes->length;
	
	if($totalNodes == 0){
		return false;
	}else{
		return true;
	}
	
}

function xmlHasNextNode($nodeNum, $xmldata){
	$doc = new DOMDocument; 
	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;
	
	//$nodeNum = $nodeNum;
	$totalNodes = $docRoot->childNodes->length;
		
	if($nodeNum >= $totalNodes){
		$hasNext = false;
	}else{
		$hasNext = true;
	}
	return $hasNext;
}

function xmlHasPrevNode($nodeNum, $xmldata){
	$doc = new DOMDocument; 
	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;
	
	$nodeNum = $nodeNum - 1;
	
	if($nodeNum == 0){
		$hasPrev = false;
	}else{
		$hasPrev = true;
	}

	return $hasPrev;

}

function getPageIDFromXML($nodeNum, $xmldata){
	$doc = new DOMDocument; 

	$doc->loadXML($xmldata);
	$docRoot = $doc->documentElement;

	$nodeNum = $nodeNum - 1;
	
	$pageNode = $docRoot->childNodes->item($nodeNum);
	if ($pageNode != null) {
		if($pageNode->hasAttributes()){
			$pid = $pageNode->getAttribute('id');
			}
		}else{
			echo "The page you have requested does not exist";
		}
	return $pid;
}

function rmNodeX($xmldata, $nodeToRemNum){
		$doc = new DOMDocument; 
		$doc->loadXML($xmldata);
		$docRoot = $doc->documentElement;

		$nodeToRemove = null;
		$nodeToRemove = $docRoot->childNodes->item($nodeToRemNum);

		if ($nodeToRemove != null){
		$docRoot->removeChild($nodeToRemove);
		$newData = $doc->saveHTML(); 		
		return $newData;
		}else{
			return $xmldata;
		}
}

function rmNode($xmldata, $nodeToRemTag, $nodeToRemID, $nodeToRemAttr = 'id'){
		$doc = new DOMDocument; 
		$doc->loadXML($xmldata);
		$docRoot = $doc->documentElement;

		$nodeToRemove = null;
		foreach($docRoot->childNodes as $child){
			if($child->tagName ==  $nodeToRemTag){
				if($child->hasAttributes()){
					if($child->getAttribute($nodeToRemAttr) == $nodeToRemID){
								 $nodeToRemove = $child; 
								 break;
					}	
				}
			}
		}

		if ($nodeToRemove != null){
		$docRoot->removeChild($nodeToRemove);
		$newData = $doc->saveHTML(); 		
		return $newData;
		}else{
			return $xmldata;
		}
}

/**
 * Parameters:
 * 		xmldata - xml data to be used
 * 		tagname - name of tag to be added
 * 		$uniqid - array of unique attributes to be scanned for
 * 		childarr - array containing children to be added
 * 
 */
function addNodeChildren($xmldata, $tagname, $uniqID, $childArr){
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($xmldata);
	$rootNode = $xmlDoc->documentElement;
	
	$keysOf = array_keys($uniqID);
	$wantKey = $keysOf[0];
	$wantVal = $uniqID[$wantKey];
	
		foreach($rootNode->childNodes as $child){
			if($child->hasAttributes()){	
				if($child->getAttribute($wantKey) == $wantVal){
					$parentNode = $child;
					break;
				}
			}
		}
		
	foreach($childArr as $key=>$val){
		$newChild = $xmlDoc->createElement($key,$val);
		$parentNode->appendChild($newChild);
	}

	$retVal = $xmlDoc->saveHTML();
	return $retVal;
}

/**
 * Parameters:
 * 		xmldata - xml data to be used
 * 		tagname - name of tag to be added
 * 		attrarr - array containing attributes to be added
 * 		maxrecords - optional. how many items to hold before removing the last from the stack. default 2000000 (for 2gb limit)
 * 
 */
function addNode($xmldata, $tagname, $attrArr, $maxRecords = 2000000){
	$xmlDoc = new DOMDocument();
	if($xmldata == ''){
		$xmldata = "<xmldata></xmldata>";
	}
	$xmlDoc->loadXML($xmldata);
	$rootNode = $xmlDoc->documentElement;
	
	if($rootNode->childNodes->length > $maxRecords){
		$newdata = rmNodeX($xmldata,0);
		$xmlDoc->loadXML($newdata);
		$rootNode = $xmlDoc->documentElement;
	}
	
	$newChild = $xmlDoc->createElement($tagname);

	foreach($attrArr as $key=>$value){
		$newChild->setAttribute($key, $value);
	}
	
	$newRef = $rootNode->appendChild($newChild);
	$retVal = $xmlDoc->saveHTML();
	
	return $retVal;
}

function reorderNodes($xmldata, $nodenum, $direction, $offset='1'){
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($xmldata);
	$rootNode = $xmlDoc->documentElement;
	$error = false;
	$reorder = $xmldata;
	switch($direction){
		case 'up':
		$preNodeNum = $nodenum - $offset;
		if($preNodeNum < 0){$error=true;};
		break;
		case 'down':
		$preNodeNum = $nodenum + $offset +1;
		if($preNodeNum > $rootNode->childNodes->length + 1){$error=true;};
		break;
		default:
		$preNodeNum = 0;
		$error = true;
		break;
	}
	if(!$error){
	$beforeNode = $rootNode->childNodes->item($preNodeNum-1);
	$nodeToShift = $rootNode->childNodes->item($nodenum-1);
	$newNode = $nodeToShift->cloneNode(false);
	$newNode = $rootNode->insertBefore($newNode, $beforeNode);
	$rootNode->removeChild($nodeToShift);
	$reorder = $xmlDoc->saveHTML();
	}
	return $reorder;
}

/**
 * Parameters:
 * 		datatype - from which db table to read
 * 		dataid - id of entry
 * 		datacol - column containing data
 * 		nodenum - node to be moved
 * 		direction - direction to move node (up | down)
 * 		offset - how many nodes to move - default 1
 * 
 */
function moveNode($datatype, $dataID, $dataCol, $nodenum, $direction, $offset='1'){
	$q = "SELECT * FROM $datatype WHERE id='$dataID' LIMIT 1";
	$r = sql_execute($q);
	$data = sql_get($r);
	$newData = reorderNodes($data["$dataCol"],$nodenum,$direction,$offset);
	
	$q = "UPDATE $datatype SET $dataCol='$newData' WHERE id='$dataID'";
	$r = sql_execute($q);
	//return $newData;
}

function xmlMoveNodeTo($xmldata, $curPos, $newPos){
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($xmldata);
	$rootNode = $xmlDoc->documentElement;
	$error = false;
	
	if(!$error){
	$beforeNode = $rootNode->childNodes->item($newPos+1);
	$nodeToShift = $rootNode->childNodes->item($curPos);
	$newNode = $nodeToShift->cloneNode(false);
	$newNode = $rootNode->insertBefore($newNode, $beforeNode);
	$rootNode->removeChild($nodeToShift);
	$reorder = $xmlDoc->saveHTML();
	}
	return $reorder;
}
