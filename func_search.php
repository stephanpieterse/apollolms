<?php

/**
 * 
 * Search functions used by the php form method, should return friendly enough stuff for use in AJAX
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */

function search_events($contains){
	if(is_string($contains)){
		$q = "SELECT id FROM events WHERE name LIKE '%" . $contains . "%' OR description LIKE '%" . $contains . "%' OR html_content LIKE '%" . $contains . "%'";
		$r = sql_execute($q);	
	}
	
	if(is_array($contains)){
		$container = implode('|',$contains);
		$q = "SELECT id FROM events WHERE name REGEXP '" . $container . "' OR description REGEXP '" . $container . "' OR html_content REGEXP '" . $container . "'";
		$r = sql_execute($q);	
	}
	
	while($d = sql_get($r)){
		$fullarr[] = $d['id'];
	}

	if(isset($fullarr)){
		return $fullarr;
	}else{
		return false;
	}
}

function search_users($contains){
	
	if(is_string($contains)){
		$q = "SELECT id FROM members WHERE name LIKE '%" . $contains . "%' OR email LIKE '%" . $contains . "%' OR contactnum LIKE '%" . $contains . "%'";
		$r = sql_execute($q);	
	}
	
	if(is_array($contains)){
		$container = implode('|',$contains);
		$q = "SELECT id FROM members WHERE name REGEXP '" . $container . "' OR email REGEXP '" . $container . "' OR contactnum REGEXP '" . $container . "'";
		$r = sql_execute($q);	
	}
	
	while($d = sql_get($r)){
		$fullarr[] = $d['id'];
	}

	if(isset($fullarr)){
		return $fullarr;
	}else{
		return false;
	}	
}

function search_courses($contains){

	$q = "SELECT id FROM courses WHERE tags LIKE '%" . $contains . "%' OR name LIKE '%" . $contains . "%' OR html_content LIKE '%" . $contains . "%' OR description LIKE '%" . $contains . "%'";
	$r = sql_execute($q);

	while($d = sql_get($r)){
		$fullarr[] = $d['id'];
	}

	if(isset($fullarr)){
		return $fullarr;
	}else{
		return false;
	}
}

function search_in_page($pid, $contains){
	$q = "SELECT id FROM pages WHERE id='$pid' AND name LIKE '%" . $contains . "%' OR html_content LIKE '%" . $contains . "%'";
	$r = sql_execute($q);
	
	while($d = sql_get($r)){
		$fullarr['pages'] = $d['id'];
	}
	
	if(isset($fullarr)){
		return $fullarr;
	}else{
		return false;
	}
	
}

function search_in_article($aid, $contains){
	if(is_string($contains)){
		$q = "SELECT id FROM articles WHERE id='$aid' AND name LIKE '%" . $contains . "%' OR html_content LIKE '%" . $contains . "%' OR description LIKE '%" . $contains . "%' OR code LIKE '%" . $contains . "%'";
		$r = sql_execute($q);	
	}
	
	if(is_array($contains)){
		$container = implode('|',$contains);
		$q = "SELECT id FROM articles WHERE id='$aid' AND name REGEXP '" . $container . "' OR html_content REGEXP '" . $container . "' OR description REGEXP '" . $container . "' OR code REGEXP '" . $container . "'";
		$r = sql_execute($q);	
	}
	
	while($d = sql_get($r)){
		$fullarr['articles'] = $d['id'];
	}
	
	if(isset($fullarr)){
		return $fullarr;
	}else{
		return array('');
	}
	
}

/**
 * Returns an array containing courses, articles, pages which are arrays of ids containing the searched string
 */
function search_courses_complete($contains){
	if(is_string($contains)){
		$q = "SELECT id FROM courses WHERE name LIKE '%" . $contains . "%' OR html_content LIKE '%" . $contains . "%' OR description LIKE '%" . $contains . "%' OR code LIKE '%" . $contains . "%'";
	$r = sql_execute($q);	
	}
	
	if(is_array($contains)){
		$container = implode('|',$contains);
		$q = "SELECT id FROM courses WHERE name REGEXP '" . $container . "' OR html_content REGEXP '" . $container . "' OR description REGEXP '" . $container . "' OR code REGEXP '" . $container . "'";
		$r = sql_execute($q);	
	}

	if(sql_numrows($r) == 0){
		$fullarr['courses'] = 0;
	}
	
	while($d = sql_get($r)){
		$fullarr['courses'] = $d['id'];
	}

	$q = "SELECT articles FROM courses";
	$r = sql_execute($q);
	
	//retrieve all articles and repeat search
	while($d = sql_get($r)){
		$domdoc = new DOMDocument;
		$domdoc->loadXML($d['articles']);
		$docroot = $domdoc->documentElement;
		
		foreach($docroot->childNodes as $child){
			$aid = $child->getAttribute('id');
			$fullarr = array_merge($fullarr,search_in_article($aid, $contains));
			$pagesearch[] = $aid;
		}
	}
	
	//retreive all pages and repeat
	$pagesArr = implode("','", $pagesearch);
	$q = "SELECT pages FROM articles WHERE id IN ('" . $pagesArr . "')";
	$r = sql_execute($q);
	
	while($d = sql_get($r)){
		$domdoc = new DOMDocument;
		$domdoc->loadXML($d['pages']);
		$rootnode = $domdoc->documentElement;
		
		foreach($docroot->childNodes as $child){
			$pid = $child->getAttribute('id');
			$newarr = search_in_page($pid, $contains);
			if(is_array($newarr)){
				$fullarr = array_merge($fullarr,$newarr);
			}
		}
	}

	if(isset($fullarr)){
		return $fullarr;
	}else{
		return false;
	}
}

function search_groups($contains){
	$q = "SELECT id FROM groups_list WHERE name LIKE '%" . $contains . "%' OR description LIKE '%" . $contains . "%'";
	$r = sql_execute($q);

	while($d = sql_get($r)){
		$fullarr[] = $d['id'];
	}

	if(isset($fullarr)){
		return $fullarr;
	}else{
		return false;
	}
}
?>