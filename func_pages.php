<?php

/**
 * @todo We should probably try and move this into a class... or the seperate templates
 * 
 * @author Stephan
 * @package ApolloLMS
 * 
 * */

function pages_func_rm_page($data){
	$stat = removeItem('pages',$data['pid']);
	verifyXML('articles',$data['aid']);
	return $stat;
}

/**
 * TODO beta of article as one system
 * */
function func_courses_addNewNode($data){
	$artId = makeSafe($data['articleId']);
	$nodeParent = makeSafe($data['nodeParId']);
	$nodeContent = makeSafe($data['nodeContent']);
	$dateMod = date("Y-m-d-H-i-s");
	
	$q = "SELECT * FROM articles WHERE id='$artId' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$oldData = $r['packagecontent'];
	
	if($oldData = ''){
		$oldData = '<pack></pack>';
	}
	
	$newNodeId = get_nextAvailableIdRecur($oldData);
	
	$newXML = addNode($oldData, "node", array('id'=>$newNodeId,'modified'=>$dateMod,'content'=>$nodeContent));
	
	$q = "UPDATE articles SET packagecontent='$newXML' WHERE id='$artId'";
	$r = sql_execute($q);
	
	return true;
}


/**
 * Prints the footer for a page containing next/prev buttons.
 * We should probably extend this code to work with articles as well or just remove it and replace it with something that makes more sense.
 * */
function print_page_footer($prevBtn, $nxtBtn){
	if(isset($_GET['pnm']) && (isset($_GET['aid']))){
	$aid = $_GET['aid'];
	
	$pnmN = $_GET['pnm'] + 1;
	$pnmP = $_GET['pnm'] - 1;
	
	if($nxtBtn == true){
		$nextlink = '<a class="fl_R buttony" href="pages.php?f=viewPage&aid=' . $aid . '&pnm=' . $pnmN . '"> -> Next Page </a>';
		echo $nextlink;
	}
	if(($pnmP > 0) && ($prevBtn == true)){
		$backlink = '<a class="fl_L buttony" href="pages.php?f=viewPage&aid=' . $aid . '&pnm=' . $pnmP . '">Previous Page <-  </a>';
		echo $backlink;
	}
	}
	br_clear();
}
