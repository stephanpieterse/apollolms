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
	//$resname = $data['resource_name'];
	//$resname = makeSafe($resname);
	//$resurl = urlencode($data['resource_url']);
	
	$aid = $data['aid'];
	
	$q = "SELECT PAGES FROM articles WHERE id='$aid' LIMIT 1";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	$res = new Resource_Handler();
	$res->importXML($rd['PAGES']);
	$newCXML = $res->addResource($data);
	
	//$newCXML = addNode($rd['PAGES'], 'resource', array('url'=>$resurl,'name'=>$resname));
	
	$q = "UPDATE articles SET pages='" . $newCXML . "' WHERE id='$aid'";
	$r = sql_execute($q);
	
	//return true;
	return 'goBack';
}

/**
 * Removes the specified resource
 * 
 * Params: 
 * data - post data
 * 
 */
function articles_func_removeResource($data){
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
	
	$res = new Resource_Handler();
	$res->importXML($rd['PAGES']);
	$xmldata = $res->removeResource($nodeNum);
	
//	$xmldata = $rd['PAGES'];
//	$xmldata = rmNodeX($xmldata, $nodeNum);
	
	$q = "UPDATE articles SET pages='$xmldata' WHERE id='$aid'";
	$d = sql_execute($q);
//	return true;
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
 * TODO: move this to a template ?
 * 
 */
function sidebarIndex($course,$article){
	if($course >= 1){
	echo '<div class="sidebarIndex css-treeview" >';
	//	echo "Course";
		//displayCourseIndex($course);
		include(TEMPLATE_PATH . 'courses_form_displayCourseIndex.php');
		echo "Article Index<br/>";
		echo '<a href="#">TOP</a>';
		echo makeIndex($article);
	echo '</div>';
	}
}

/**
 * Add a new article into the database
 * 
 * @param $data pass the $_POST dataset
 */
function articles_func_addNewArticle($data){
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
	$query="INSERT INTO articles(name, description, html_content, created_date, published_date, published_user, published_status, code, pages, course, modified)VALUES('$articleName','$articleDesc', '$htmlContent', '$dateCreated', '$publishedDate', '$publishedBy', '$pubStat', '$articleCode', '<pages></pages>', '$cid', '$modified')";
	$result = sql_execute($query);
	
	$q = "SELECT * FROM articles WHERE created_date='$dateCreated' AND name='$articleName' LIMIT 1";
	$r = sql_execute($q);
	$rd = sql_get($r);
	$newAID = $rd['ID'];
	
	$q = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
	$r = sql_execute($q);
	$rd = sql_get($r);
	
	if($rd['ARTICLES'] == ''){
		$rdArticles = "<articles></articles>";
	}else{
		$rdArticles = $rd['ARTICLES'];
	}
	
	$newCXML = addNode($rdArticles, 'article', array('id'=>$newAID));
	
	$q = "UPDATE courses SET articles='" . $newCXML . "' WHERE id='$cid'";
	$r = sql_execute($q);
	
//	return true;
	return 'goBack';
}

/**
 * Updates the selected article
 * 
 * @param $data pass the $_POST dataset - remember to include aid (id of article)
 * */
function articles_func_updateArticle($data){
	$id = $data['aid'];
	$articleName = $data['articleName'];
	$articleName = makeSafe($articleName);
	$articleDesc = $data['articleDescription'];
	$articleDesc = makeSafe($articleDesc);
	$htmlContent = $data['pageContent'];
	$publishedStatus = $data['publishedStatus'];
	
	$pubStat = 0;
	if($publishedStatus == "Yes"){
		$pubStat = 1;
		$publishedDate = date("Y-m-d-H-i-s");
	}
	
	$q = "SELECT * FROM articles WHERE id='$id' LIMIT 1";
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
	$query="UPDATE articles SET name='$articleName', description='$articleDesc', html_content='$htmlContent', created_date='$dateCreated', published_date='$publishedDate', published_user='$publishedBy', published_status='$pubStat', code='$articleCode', modified='$modificationdata' WHERE id='$id'";
	$result = sql_execute($query);
	
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
	echo print_h2($data['NAME']);
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
	removeItem('articles', $data['aid']);
	verifyXML('courses',$data['cid']);
	
	return true;
}
