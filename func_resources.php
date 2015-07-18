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
