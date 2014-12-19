<?php
/**
 * @todo This file is so incomplete we can move it to a class and use all new functions from there
 * @package ApolloLMS
 * */
 
/**
 * Removes an entry
 * */
function flagged_func_removeEntry($data){
	if(!isset($data['fid'])){
		return false;
	}
	
	$id = $data['fid'];
	$q = "DELETE FROM flagged_items WHERE id='$id'";
	$d = sql_execute($q);
	
	return true;
}
?>
