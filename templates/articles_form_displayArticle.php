<?php
	$smarty = new Smarty;
	
	$articleID = makeSafe($_GET['id']);
	$courseID = isset($_GET['cid']) ? makeSafe($_GET['cid']) : '0';
	$query = 'SELECT * FROM courses WHERE id="' . $courseID . '"';
	$result = sql_execute($query);
	$data = sql_get($result);
	//sidebarIndex($courseID, $data['HTML_CONTENT']);
	
	$xmlDoc = new ALMS_XMLHandler($data['PACKAGECONTENTS']);
	
	$xpath = '//article[@id="$articleID"]';
	$nodelist = $xmlDoc->getNodeList($xpath);
	
	if($nodelist->length == 0){
		goHome('404');
	}else{
	
	$dataArray['NAME'] = $nodelist->item(0)->getAttribute('NAME');
	$dataArray['HTML_CONTENT'] = $nodelist->item(0)->getAttribute('HTML_CONTENT');
	
	$pagesArray = array();
	$resArray = array();
	$itemnum = 0;
	$resarrnum = 0;

	foreach($nodelist->item(0)->childNodes as $item){
		if($item->tagName == 'article'){
			$pagesArray[$itemnum]['NAME'] = $item->getAttribute('NAME');
			$pagesArray[$itemnum]['AID'] = $item->getAttribute('ID');
			$itemnum++;
		}
		if($item->tagName == 'resource'){
			$resurl = $child->getAttribute('url');
			$resname = $child->getAttribute('name');
			
			$resArray[$resarrnum]['NAME'] = $resname;
			
				$resurl = urldecode($resurl);
				if(strpos($resurl,'resource_view.php') !== false){
				$resArray[$resarrnum]['RESURL'] = $resurl;
				}else{
				$resArray[$resarrnum]['RESURL'] = 'resource_view.php?f=' . urlencode($resurl) . '&ref=' . urlencode(selfURL());
				}
				$resarrnum++;
		}
	}
	
	$smarty->assign('data',$dataArray);
	$smarty->assign('pagesData',$pagesArray);
	$smarty->assign('resData',$resArray);
	$smarty->assign('courseID',$courseID);
	$smarty->assign('vars',array('ICONS_PATH'=>ICONS_PATH));
	
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
}
