<?php
/**
 * Basic backup functions for use by the site
 * 
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */

/**
 * Clears the entire backup archive. Permanently
 * */
function backup_func_delete_all(){
	$q = "DELETE FROM archived_data";
	$d = sql_execute($q);
	return true;
}

/**
 * Removes pages and articles that no longer have parents. (usually a course)
 * */
function killOrphanedPages(){
	$qa = "SELECT * FROM articles";
	$ra = sql_execute($qa);
	
	$qp = "SELECT * FROM pages";
	$rp = sql_execute($qp);
	
	$x = 0;
	while($articledata = sql_get($ra)){
		$articleIDs[$x] = $articledata['ID'];
		$x++;
	}
	
	$x = 0;
	while($pagedata = sql_get($rp)){
		$pageIDs[$x]['ID'] = $pagedata['ID'];
		$pageIDs[$x]['OWNER'] = $pagedata['ARTICLE'];
		$x++;
	}
	
	if($x != 0){
	foreach($pageIDs as $p){
		if(!in_array($p['OWNER'], $articleIDs)){
			removeItem('pages', $p['ID']); 
		}
	}
	}
}

/**
 * Removes pages and articles that no longer have parents. (usually a course)
 * */
function killOrphanedArticles(){
	$qc = "SELECT * FROM courses";
	$rc = sql_execute($qc);
	
	$qa = "SELECT * FROM articles";
	$ra = sql_execute($qa);
	
	$x = 0;
	while($coursedata = sql_get($rc)){
		$courseIDs[$x] = $coursedata['ID'];
		$x++;
	}
	
	$x = 0;
	while($articledata = sql_get($ra)){
		$articleIDs[$x]['ID'] = $articledata['ID'];
		$articleIDs[$x]['OWNER'] = $articledata['COURSE'];
		$x++;
	}
	
	if($x != 0){
	foreach($articleIDs as $a){
		if(!in_array($a['OWNER'], $courseIDs)){
			removeItem('articles', $a['ID']); 
		}
	}
	}
}

/**
 * Wrapper for the functions to delete any left over course parts
 * */
function findOrphans(){
	killOrphanedArticles();
	killOrphanedPages();
}

/**
 * Restores a selected backup unit back into the system
 * @param int $backID id of the backup
 * */
function backup_func_restoreData($backID){
	
	$backID = makeSafe($backID);
	$q = "SELECT * FROM archived_data WHERE id='$backID' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($d['DATA']);
	$rootNode = $xmlDoc->documentElement;
	
	$rebuildString = "INSERT INTO " . $d['FROMTABLE'] . ' ';
	foreach($rootNode->childNodes as $c){
		$name = $c->nodeName;
		$value = $c->nodeValue;
		$rebuildString = $rebuildString . strtolower($name) . "='" . $value . "', ";
	}

	$execstat = sql_execute($rebuildString);

	
	$q = "DELETE archived_data WHERE id='$backID'";
	$r = sql_execute($q);
	
	return true;
}

/**
 * Backs up data. Called from the delete function.
 * @param xml $dataSet
 * @param string $comments
 * @param string $fromWhere
 * */
function backupData($dataSet, $comments, $fromWhere){
		$xmlDoc = new DOMDocument();
		$rootNode = $xmlDoc->createElement("archivedData");
		$xmlDoc->appendChild($rootNode);
	
		foreach($dataSet as $key=>$value){
		// create xml code
		if(isset($value) && ($key != 'ID')){
		$value = mysqli_real_escape_string($GLOBALS['sqlcon'],$value);
		$childBase = $xmlDoc->createElement($key,$value);
		$childRef = $rootNode->appendChild($childBase);		
		}
	}
	
	// write into archive
		$curTime = date("Y-m-d-H-i-s");
		$xmlData = $xmlDoc->saveHTML();
		$query = "INSERT INTO archived_data (DATA, DATE, COMMENTS, FROMTABLE) VALUES ('" . $xmlData . "','" . $curTime . "','" . $comments . "','" . $fromWhere . "')";
		$result = sql_execute($query);
}
