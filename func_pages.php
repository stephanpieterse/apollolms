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

function makeIndexPages($article = "<articles></articles>"){
	$xmlDoc = new DOMDocument;
	libxml_use_internal_errors(true);
	if($article==""){$article="<articles></articles>";}
	$xmlDoc->loadHTML($article);
	libxml_use_internal_errors(false);
	
	$x = 0;
	$linksArr[0] = "";
	$tags = $xmlDoc->getElementsByTagName("a");
	foreach($tags as $item){
				foreach($item->attributes as $attr){
					if($attr->name == "name"){
						$linksArr[$x] = $attr->value;
						$x++;
					}
					}
				}
		
	$allLinks = "";
	foreach($linksArr as $item){
		$newString = '<a href="#' . $item . '">' . '-' .  $item . '</a>';
		$allLinks = $allLinks . "<br/>" . $newString;
	}
	
	return $allLinks;
}

function sidebarIndexPages($course,$article){
	
	echo '<div class="sidebarIndex" >';
	if($course >= 1){
		displayArticleIndex($course);
		br();
		}
		echo print_bold("Article Index");
		br();
		echo '<a href="#">TOP</a>';
		echo makeIndexPages($article);
	echo '</div>';
	
}


function view_pages($aid){
	$sqlquery = "SELECT * FROM articles WHERE id='" . $aid ."' LIMIT 1";
	$sqlresult = sql_execute($sqlquery);
	$rowdata = sql_get($sqlresult);
		
		$doc = new DOMDocument; 
		$doc->loadXML($rowdata['PAGES']);
		$docRoot = $doc->documentElement;

		foreach($docRoot->childNodes as $child){
			$childID = $child->getAttribute('id');
		echo $rowdata['NAME'];
		if(check_user_permission("content_view")){
		echo '<a href="index.php?aq=page&pid=' . $childID .' "><img src="' . ICONS_PATH . 'magnifier.png" alt="View"/></a>';
		}
		if(check_user_permission("content_modify")){
		echo '<a href="pages.php?f=mod_page&pid=' . $childID . ' "><img src="' . ICONS_PATH . 'pencil.png" alt="Edit"/></a>';
		}
		if(check_user_permission("content_remove")){
		echo '<a href="pages.php?q=rm_page&pid=' . $childID .' "><img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a>';
		}
		echo "<br />";

			}
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
	
	$oldData = $r['packagecontent']
	
	if($oldData = ''){
		$oldData = '<pack></pack>';
	}
	
	$newNodeId = get_nextAvailableIdRecur($oldData);
	
	$newXML = addNode($oldData, "node", array('id'=>$newNodeId,'modified'=>$dateMod,'content'=>$nodeContent));
	
	$q = "UPDATE articles SET packagecontent='$newXML' WHERE id='$artId'";
	$r = sql_execute($q);
	
	return true;
}

function a_page_AddNewData($aid,$pdata){
	$pName = $pdata['pageName'];
	$pName = makeSafe($pName);
	$htmlContent = $pdata['pageContent'];
	$dateCreated = date("Y-m-d-H-i-s");
	$publishedBy = $_SESSION['userID'] . ' - ' . $_SESSION['username'];	
	
	$modified = "<modified><created uid=\"" . $_SESSION['userID'] ."\" time=\"" . $dateCreated . "\"></created></modified>";
	
	$query="INSERT INTO pages (name, html_content, created_date, published_user, article, modified)VALUES('$pName', '$htmlContent', '$dateCreated', '$publishedBy', '$aid', '$modified')";
	$result = sql_execute($query);
	
	$q = "SELECT * FROM pages WHERE created_date='$dateCreated' AND name='$pName' LIMIT 1";
	$r = sql_get(sql_execute($q));
	
	$newPageID = $r['ID'];
	
	$q = "SELECT * FROM articles WHERE id='$aid' LIMIT 1";
	$r = sql_execute($q);
	$data = sql_get($r);
	
	if($data['PAGES'] == ""){
		$toSend = "<pages></pages>";
	}else{
		$toSend = $data['PAGES'];
	}
	
	$newXML = addNode($toSend, "page", array('id'=>$newPageID));
	
	$q = "UPDATE articles SET pages='$newXML' WHERE id='$aid'";
	$r = sql_execute($q);
	
	return true;	
}

function a_update_page($id,$data){
	$pName = $data['pageName'];
	$pName = makeSafe($pName);
	$htmlContent = $data['pageContent'];

	$q = "SELECT * FROM pages WHERE id='$id' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	if($d['MODIFIED'] == ""){
		$rXMLdata = "<modified></modified>";
	}else{
		$rXMLdata = $d['MODIFIED'];
	}
	$modificationdata = addNode($rXMLdata,'updated',array('uid'=>$_SESSION['userID'],'time'=>$publishedDate,));
	
	$publishedBy = $_SESSION['username'];	
	$query="UPDATE pages SET name='$pName', html_content='$htmlContent', published_user='$publishedBy', modified='$modificationdata' WHERE id='$id'";
	$result = sql_execute($query);
	
	if(isset($data['save'])){
		goHome("update_page_success");
	}else{
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=pages.php?f=mod_page&pid=' . $id . '">';
	}
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
