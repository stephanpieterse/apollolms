<?php
	
	$smarty = new Smarty();
/*
function isArticleAlreadySelected($cdata, $aid){
	$isSel = false;
	
	$xmlDoc = new DOMDocument();
	$rootNode = $xmlDoc->loadXML($cdata['ARTICLES']);
	$rootNode = $xmlDoc->documentElement;
	
	foreach($rootNode->childNodes as $child){
		if($child->hasAttributes()){
		foreach($child->attributes as $attr){
			if($attr->value == $aid){
				$isSel = true;
				break;
			}
			}			
		}
	}
	return $isSel;
}
*/
?>
<?php
	$cid = $_GET['id'];
	$articleData['COURSEID'] = $_GET['id'];
	$sqlquery = "SELECT * FROM courses WHERE id='" . $articleData['COURSEID'] . "' LIMIT 1";
	$sqlresult = sql_execute($sqlquery);
	$crow = sql_get($sqlresult);
	$articleData['COURSENAME'] = $crow['NAME'];

	$sqlquery = "SELECT * FROM articles";
	$sqlresult = sql_execute($sqlquery);
	
	$xmlDoc = new DOMDocument();
	$rootNode = $xmlDoc->loadXML($crow['ARTICLES']);
	$rootNode = $xmlDoc->documentElement;
	
	if(xmlHasNextNode(0,$crow['ARTICLES'])){
	$xi = 0;	
	$nodeID = 1;
	foreach($rootNode->childNodes as $child){
		if($child->tagName == 'article'){
			
			$sid = $child->getAttribute('id');
			$sqlquery = "SELECT * FROM articles WHERE id='$sid' LIMIT 1";
			$sqlresult = sql_execute($sqlquery);
			$data = sql_get($sqlresult);
			$articleTableData[$xi]['ITEMNAME'] = 'Article';
			if(check_user_permission("content_view")){
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?f=displayArticle&id=" . $data['ID'] ." \"><img src=\"" . ICONS_PATH . "magnifier.png\" alt=\"View\"/>" . $data['NAME'] . "</a>";
			}
			if(check_user_permission("content_modify")){
				//edit
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?f=mod_article&aid=" . $data['ID'] ." \"><img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/>Article</a>";
				//pages
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?f=mod_articlePages&aid=" . $data['ID'] ." \"><img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/>Pages</a>";
				//move up
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?q=mv_art&id=" . $cid ."&dir=up&aid=". $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
				//move down
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?q=mv_art&id=" . $cid ."&dir=down&aid=" . $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
			}
			if(check_user_permission("content_remove")){
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?confirm&q=removeArticle&aid=" . $data['ID'] ."&cid=" . $cid . " \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
			}
			
		}
		if($child->tagName == 'resource'){
			$sid = $child->getAttribute('id');
			$resurl = $child->getAttribute('url');
			$resname = $child->getAttribute('name');
			$sqlquery = "SELECT * FROM articles WHERE id='$sid' LIMIT 1";
			$sqlresult = sql_execute($sqlquery);
			$data = sql_get($sqlresult);
			$articleTableData[$xi]['ITEMNAME'] = $resname;
			if(check_user_permission("content_view")){
				$articleTableData[$xi]['LINKS'][] = '<a target="_blank" href="resource_view.php?f=' . $resurl .'"><img src="' . ICONS_PATH . 'magnifier.png" alt="View"/>' . $data['NAME'] . "</a>";
			}
			if(check_user_permission("content_modify")){
				//edit
				$articleTableData[$xi]['LINKS'][] = "<a href=\"courses.php?f=editResource&cid=".$cid."&resid=" . $sid ." \"><img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/>Edit</a>";
				//moveup
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?q=mv_art&id=" . $cid ."&dir=up&aid=". $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
				//movedown
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?q=mv_art&id=" . $cid ."&dir=down&aid=" . $nodeIDs ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
			
			}
			if(check_user_permission("content_remove")){
				// functions previously used nodeid
				$articleTableData[$xi]['LINKS'][] = '<a href="courses.php?q=removeResource&id=' . $sid . '&cid=' . $_GET['id'] .' "><img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a><br/>';
			}
				
		}
		$nodeID++;
		$xi++;
	}
	
	while ($row = sql_get($sqlresult)){
		echo '<br />';
	}
	}
	$smarty->assign('articleData',$articleData);
	if(isset($articleTableData)){
		$smarty->assign('tableData',$articleTableData);
	}
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
