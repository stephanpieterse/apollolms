<?php
/**
 * Basic functions for use by articles
 * 
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */

/**
 * Adds a new resource to the specified article
 * 
 * Params:
 * 	aid - id of article
 *  data -  post data
 * 
 */
function articles_func_addResource($data){
	$resname = $data['resource_name'];
	$resname = makeSafe($resname);
	$resurl = urlencode($data['resource_url']);
	
	$aid = $data['aid'];
	$cid = $data['cid'];
	
	$q = "SELECT PACKAGECONTENTS FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$doc = new ALMS_XMLHandler($rd['PACKAGECONTENTS']);
	$xpath = '//*[@id = "$aid"]';
	$nodeAttr = array('url'=>$resurl,'name'=>$resname);
	$doc->insertNode('resource',$nodeAttr,$xpath);
	
	$newCXML = $doc->getXML();
	
	$q = "UPDATE courses SET packagecontents='" . $newCXML . "' WHERE id='$cid'";
	$r = sql_execute($q);
	
	return 'goBack';
}

/**
 * Removes the specified resource
 * Params: 
 * data - post data
 */
function articles_func_removeResource($data){
	if(isset($data['resid'])){
		$nodeNum = $data['resid'];
	}else{
		return false;
	}
	
	if(isset($data['cid'])){
		$aid = $data['cid'];
	}else{
		return false;
	}
	
	$cid = $data['cid'];
	
	$q = "SELECT PACKAGECONTENTS FROM courses WHERE id='$cid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$doc = new ALMS_XMLHandler($rd['PACKAGECONTENTS']);
	$xpath = '//resource[@id = "$nodeNum"]';
	$doc->removeNode($xpath);
	$xmldata = $doc->getXML;
	
	$q = "UPDATE courses SET packagecontents='$xmldata' WHERE id='$cid'";
	$d = sql_execute($q);
	return 'goBack';
}

/**
 * Updates specified resource on an article
 @param $data Array containing resid, aid, resource_name, resource_url 
 * 
 */
function articles_func_updateResource($data){
	if(isset($data['resid'])){
		$nodeNum = $data['resid'];
	}else{
		return false;
	}
	
	if(isset($data['aid'])){
		$aid = $data['aid'];
	}else{
		return false;
	}
	
	$q = "SELECT PAGES FROM articles WHERE id='$aid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$resdata['resource_name'] = $data['resource_name'];
	$resdata['resource_url'] = $data['resource_url'];
	$resdata['resid'] = $nodeNum;
	
	$res = new Resource_Handler();
	$res->importXML($rd['PAGES']);
	$finalxml = $res->updateResource($resdata);
	/*
	$xmldata = $rd['PAGES'];
	$xmldata = rmNodeX($xmldata, $nodeNum);
	$newCXML = addNode($xmldata, 'resource', array('url'=>$resurl,'name'=>$resname));
	$newNodeNum = xmlGetSpecifiedNode_Position($xmldata, array('url'=>$resurl,'name'=>$resname));
	$finalxml = xmlMoveNodeTo($xmldata, $nodeNum, $newNodeNum);
	*/
	$q = "UPDATE articles SET pages='$finalxml' WHERE id='$aid'";
	$d = sql_execute($q);
//	return true;
	return 'goBack';
}

/**
 * Generates an index style display file
 * 
 */
function makeIndex($article = "<articles></articles>"){
	$xmlDoc = new DOMDocument;
	if($article==""){$article="<articles></articles>";}
	libxml_use_internal_errors(true);
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
		
	$allLinks = "<ul>";
	foreach($linksArr as $item){
		$newString = '<li><a href="#' . $item . '">' . '-' .  $item . '</a></li>';
		$allLinks = $allLinks . "</ul>" . $newString;
	}
	
	return $allLinks;
}

/**
 * Add a new article into the database
 * 
 * @param $data pass the $_POST dataset
 */
function articles_func_addNewArticle($data){
	if(isset($data['parentID'])){
		$articleParent = makeSafe($data['parentID']);
	}
	$articleName = $data['articleName'];
	$articleName = makeSafe($articleName);
	$articleDesc = $data['articleDescription'];
	$articleDesc = makeSafe($articleDesc);
	$htmlContent = $data['pageContent'];
	$publishedStatus = $data['publishedStatus'];
	
	$cid = $data['courseID'];

	$dateCreated = date("Y-m-d-H-i-s");
	
	$pubStat = 0;
	if($publishedStatus == "Yes"){
		$pubStat = 1;
		$publishedDate = date("Y-m-d-H-i-s");
	}
	
	$permissions = "";

	$modified = "<modified><created uid=\"" . $_SESSION['userID'] ."\" time=\"" . $dateCreated . "\"></created></modified>";
	
	$articleCode = $data['articleCode'];
	$articleCode = makeSafe($articleCode);
	$publishedBy = $_SESSION['username'];	
	
	$q = "SELECT PACKAGECONTENTS FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$coursePack = $d['PACKAGECONTENTS'];
	
	$doc = new ALMS_XMLHandler($coursePack);
	$newNodeAttr = array('name'=>$articleName,'description'=>$articleDesc,'html_content'=>$htmlContent,'created_date'=>$dateCreated,'published_date'=>$publishedDate,'published_user'=>$publishedBy,'published_status'=>$pubStat,'code'=>$articleCode,'modified'=>$modified);
	
	$xpath = '/';
	if(isset($articleParent)){
		$xpath .= '/article[@id = "$articleParent"]';
	}
	$doc->insertNode('article',$newNodeAttr,$xpath);
	$newCXML = $doc->getXML();
	
	$q = "UPDATE courses SET packagecontents='" . sql_escape_string($newCXML) . "' WHERE id='$cid'";
	$r = sql_execute($q);
	
	return 'goBack';
}

/**
 * Updates the selected article
 * 
 * @param $data pass the $_POST dataset - remember to include aid (id of article)
 * */
function articles_func_updateArticle($data){
	$id = makeSafe($data['aid']);
	$cid = makeSafe($data['courseID']);
	$articleName = $data['articleName'];
	$articleName = makeSafe($articleName);
	$articleDesc = $data['articleDescription'];
	$articleDesc = makeSafe($articleDesc);
	$htmlContent = $data['pageContent'];
	$publishedStatus = makeSafe($data['publishedStatus']);
	
	$pubStat = 0;
	if($publishedStatus == "Yes"){
		$pubStat = 1;
		$publishedDate = date("Y-m-d-H-i-s");
	}
	
	$q = "SELECT PACKAGECONTENTS FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	if($d['MODIFIED_DATE'] == ""){
		$rXMLdata = "<modified></modified>";
	}else{
		$rXMLdata = $d['MODIFIED_DATE'];
	}
	
	$modificationdata = addNode($rXMLdata,'updated',array('uid'=>$_SESSION['userID'],'time'=>$publishedDate,));
	
	$articleCode = $data['articleCode'];
	$articleCode = makeSafe($articleCode);
	$dateCreated = date("Y-m-d-H-i-s");
	$publishedBy = $_SESSION['username'];	
	$doc = new ALMS_XMLHandler($d['PACKAGECONTENTS']);
	$xpath = '//article[@id = "$id"]';
	$newData = array('name'=>'$articleName', 'description'=>'$articleDesc', 'html_content'=>'$htmlContent', 'created_date'=>'$dateCreated', 'published_date'=>'$publishedDate', 'published_user'=>'$publishedBy', 'published_status'=>'$pubStat', 'code'=>'$articleCode', 'modified'=>'$modificationdata');
	$newxml = $doc->updateNode('article',$newData,$xpath);
	
	$q = "UPDATE courses SET packagecontents='$newxml' WHERE id='$cid'";
	
	if(isset($data['save'])){
		return true;
	}else{
		page_redirect('articles.php?f=editArticle&aid=' . $id);
	}
}

/**
 * 
 * TODO: make this the same as displayArticle, just in another div
 */
function displayArticleIndex($articleID, $courseID = "0"){
	$query = 'SELECT * FROM articles WHERE id="' . $articleID . '"';
	$result = sql_execute($query);
	$data = sql_get($result);
	echo '<h2>' . $data['NAME'] . '</h2>';
	br();
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($data['PAGES']);
	$rootNode = $xmlDoc->documentElement;
	
	$pnm = 1;
	foreach($rootNode->childNodes as $child){
		switch($child->tagName){
			case 'page':
				$pid = $child->getAttribute('id');
				$q = "SELECT * FROM pages WHERE id='$pid' LIMIT 1";
				$r = sql_execute($q);
				$d = sql_get($r);
		
				$link = '<a href="pages.php?f=viewPage&pnm=' . $pnm . '&aid=' . $articleID .'">' . $d['NAME'] . '</a>';
				br();
				echo $link;
				$pnm++;
				break;
			case 'resource':
			$resurl = $child->getAttribute('url');
			$resname = $child->getAttribute('name');
			
			$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a target="_blank" href="resource_view.php?f=' . $resurl . ' ">' . $resname . '</a><br/>';
			echo $link;
			break;
		}
	}
	echo '<br class="clear" />';
}

function articles_func_mv_art($data){
	moveNode('courses', $data['id'], 'ARTICLES', $data['aid'], $data['dir']);
}

function articles_func_removeArticle($data){
	$cid = $data['cid'];
	$aid = $data['aid'];
	$q = "SELECT PACKAGECONTENTS FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$doc = new ALMS_XMLHandler($r['PACKAGECONTENTS']);
	$xpath = '//article[@id = "$aid"]';
	$doc->removeNode($xpath);
	$newxml = $doc->getXML();
	
	$q = "UPDATE courses SET packagecontents='$newxml' WHERE id='$cid'";
	$r = sql_execute($q);
	
	return true;
}

/**
 * Prints the footer for a page containing next/prev buttons.
 * We should probably extend this code to work with articles as well or just remove it and replace it with something that makes more sense.
 * */
function print_article_footer(){
	if(isset($_GET['aid'])){
	$aid = $_GET['aid'];

	$nextBtn = false;
	$prevBtn = false;

	//get prev article id
	//get next article id
	
	if($nextBtn == true){
		$nextlink = '<a class="fl_R buttony" href="pages.php?f=viewPage&aid=' . $aid . '&pnm=' . $pnmN . '"> -> Next Page </a>';
		echo $nextlink;
	}
	if($prevBtn == true){
		$backlink = '<a class="fl_L buttony" href="pages.php?f=viewPage&aid=' . $aid . '&pnm=' . $pnmP . '">Previous Page <-  </a>';
		echo $backlink;
	}
	}
	br_clear();
}
