<?php
	
	$smarty = new Smarty();

	$cid = $_GET['id'];
	$nodeHasParent = false;
	if(isset($_GET['root'])){
		$parentID = $_GET['root'];
		$noderoot = '//article[@id = "' . $_GET['root'] . '"]/';
		$nodeHasParent = true;
	}else{
		$noderoot = '';
	}
	$articleData['COURSEID'] = $_GET['id'];
	$sqlquery = "SELECT * FROM courses WHERE id='" . $articleData['COURSEID'] . "' LIMIT 1";
	$sqlresult = sql_execute($sqlquery);
	$crow = sql_get($sqlresult);
	$articleData['COURSENAME'] = $crow['NAME'];
	
	if($nodeHasParent){
		$articleData['PARENTID'] = $parentID;
	}
	
	$packData = $crow['PACKAGECONTENTS'];
	if($packData == ''){
		$packData = '<packcontent></packcontent>';
	}
	
	$xmlDoc = new ALMS_XMLHandler($packData);
	$articlelist = $xmlDoc->getNodeList($noderoot . 'article');
	$resourcelist = $xmlDoc->getNodeList($noderoot . 'resource');
	
	$xi = 0;
	foreach($articlelist as $item){
		
		$articleTableData[$xi]['ITEMNAME'] = 'Article';
		$articleTableData[$xi]['NAME'] = $item->getAttribute('name');
		$articleTableData[$xi]['ID'] = $item->getAttribute('id');
		if(check_user_permission("content_view")){
			$articleTableData[$xi]['VIEW'] = true;
		}
		if(check_user_permission("content_modify")){
			$articleTableData[$xi]['MODIFY'] = true;
		}
		if(check_user_permission("content_remove")){
			$articleTableData[$xi]['DELETE'] = true;
		}
		$xi++;
	}
	
	$xi = 0;
	foreach($resourcelist as $item){
		
		$resourceTableData[$xi]['ITEMNAME'] = 'Resource';
		$resourceTableData[$xi]['NAME'] = $item->getAttribute('name');
		$resourceTableData[$xi]['URL'] = $item->getAttribute('url');
		$resourceTableData[$xi]['ID'] = $item->getAttribute('id');
		if(check_user_permission("content_view")){
			$resourceTableData[$xi]['VIEW'] = true;
		}
		if(check_user_permission("content_modify")){
			$resourceTableData[$xi]['MODIFY'] = true;
		}
		if(check_user_permission("content_remove")){
			$resourceTableData[$xi]['DELETE'] = true;
		}
		$xi++;
	}
	
	$smarty->assign('articleData',$articleData);
	$smarty->assign('iconsPath',ICONS_PATH);
	if(isset($articleTableData)){
		$smarty->assign('tableData',$articleTableData);
	}
	if(isset($resourceTableData)){
		$smarty->assign('resourceData',$resourceTableData);
	}
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
