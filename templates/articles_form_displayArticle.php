<?php
//function displayArticle($articleID, $courseID = "0"){
	$smarty = new Smarty;
	
	$articleID = makeSafe($_GET['id']);
	$courseID = isset($_GET['cid']) ? makeSafe($_GET['cid']) : '0';
	$query = 'SELECT * FROM articles WHERE id="' . $articleID . '"';
	$result = sql_execute($query);
	$data = sql_get($result);
	sidebarIndex($courseID, $data['HTML_CONTENT']);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($data['PAGES']);
	$rootNode = $xmlDoc->documentElement;
	
	$dataArray['NAME'] = $data['NAME'];
	$dataArray['HTML_CONTENT'] = $data['HTML_CONTENT'];
	
	$pnm = 1;
	$itemnum = 0;
	$resarrnum = 0;
	
	$pagesArray = array();
	$resArray = array();
	foreach($rootNode->childNodes as $child){
	switch($child->tagName){
		case 'page':
		$pid = $child->getAttribute('id');
				$q = "SELECT * FROM pages WHERE id='$pid' LIMIT 1";
				$r = sql_execute($q);
				$d = sql_get($r);
				
				$pagesArray[$itemnum]['NAME'] = $d['NAME'];
				$pagesArray[$itemnum]['AID'] = $articleID;
				$pagesArray[$itemnum]['PNM'] = $pnm;
								
				$pnm++;
				$itemnum++;
				
			break;
			
		case 'resource':
			$resurl = $child->getAttribute('url');
			$resname = $child->getAttribute('name');
			
			$resArray[$resarrnum]['NAME'] = $resname;
			
				$resurl = urldecode($resurl);
				if(strpos($resurl,'resource_view.php') !== false){
			//	$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $resurl . ' "> ' . $resname . '</a><br/>';
			//	echo $link;
				$resArray[$resarrnum]['RESURL'] = $resurl;
				}else{
			//	$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . urlencode($resurl) . '&ref=' . urlencode(selfURL()) . '"> ' . $resname . '</a><br/>';
			//	echo $link;	
				$resArray[$resarrnum]['RESURL'] = 'resource_view.php?f=' . urlencode($resurl) . '&ref=' . urlencode(selfURL());
				}
				$resarrnum++;
			break;
	}
	}
	$smarty->assign('data',$dataArray);
	$smarty->assign('pagesData',$pagesArray);
	$smarty->assign('resData',$resArray);
	$smarty->assign('vars',array('ICONS_PATH'=>ICONS_PATH));
	
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
