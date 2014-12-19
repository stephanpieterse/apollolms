<?php
/**
 * @package ApolloLMS Admin
 * */
include("../config.php");

$q = "SELECT * FROM articles";
$d= sql_execute($q);
$curId = 1;
	while($r = sql_get($d)){
		$xml = $r['PAGES'];
		$xmldoc = new DOMDocument;
		$xmldoc->loadXML($xml);
		$rootnode = $xmldoc->documentElement;
		
		foreach($rootnode->childNodes as $c){
			if($c->tagName == 'resource'){
			if($c->hasAttributes){
				if(!$c->getAttribute('id') >= 0){
					$c->setAttribute('id',$curId);
				}
			}
			$curId++;
		}
		}
		
		$saved = $xmldoc->saveHTML();
		
		$oldid = $r['ID'];
		
		echo $saved;
		
		//$qn = "UPDATE articles SET pages='$saved' WHERE id='$oldid'";
		//$qd = sql_execute($qn);
	}

$q = "SELECT * FROM courses";
$d= sql_execute($q);
$curId = 1;
	while($r = sql_get($d)){
		$xml = $r['ARTICLES'];
		$xmldoc = new DOMDocument;
		$xmldoc->loadXML($xml);
		$rootnode = $xmldoc->documentElement;
		
		foreach($rootnode->childNodes as $c){
			if($c->tagName == 'resource'){
			if($c->hasAttributes){
				if(!$c->getAttribute('id') >= 0){
					$c->setAttribute('id',$curId);
				}
			}
			$curId++;
		}
		}
		
		$saved = $xmldoc->saveHTML();
		
		$oldid = $r['ID'];
		
		echo $saved;
		
		//$qn = "UPDATE courses SET articles='$saved' WHERE id='$oldid'";
		//$qd = sql_execute($qn);
	}

?>
