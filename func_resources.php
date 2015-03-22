<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
/**
 * Adds a resource entry with a permission for a group 
 */
function resource_func_addToGroup($data){
	$resname = $data['resource_name'];
	$resurl = $data['resource_url'];
	
	$resperms = '<permissions><group id="' . $data['gid'] . '"></group></permissions>';
	
	$q = "INSERT INTO resources(name,url,permissions) VALUES('$resname','$resurl','$resperms')";
	$r = sql_execute($q);
	return true;
}

/**
 * Removes a specified resource.
 * */
function resource_func_removeFromGroup($data){
	$resname = $data['resource_name'];
	$resurl = urlencode($data['resource_url']);
	
	$q = "DELETE FROM resources WHERE id='" . $data['resid'] . "' LIMIT 1";
	$d = sql_execute($q);
	return true;
}

function resource_func_updateResource($data){
	if(isset($data['resid'])){
		$nodeNum = $data['resid'];
	}else{
		return false;
	}
	
	if(isset($data['cid'])){
		$cid = $data['cid'];
	}else{
		return false;
	}
	
	$q = "SELECT ARTICLES FROM courses WHERE id='$cid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$res = new Resource_Handler();
	$res->importXML($rd['ARTICLES']);
	$finalxml = $res->updateResource($resdata);
	
	/*
	$xmldata = $rd['ARTICLES'];
	$xmldata = rmNodeX($xmldata, $nodeNum);
	$newCXML = addNode($xmldata, 'resource', array('url'=>$resurl,'name'=>$resname));
	$newNodeNum = xmlGetSpecifiedNode_Position($xmldata, array('url'=>$resurl,'name'=>$resname));
	$finalxml = xmlMoveNodeTo($xmldata, $nodeNum, $newNodeNum);
	*/
	$q = "UPDATE courses SET articles='$finalxml' WHERE id='$cid'";
	$d = sql_execute($q);
	return true;
}
