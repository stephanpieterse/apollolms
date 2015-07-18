<?php
	
	$smarty = new Smarty();

	$cid = $_GET['id'];
	if(isset($_GET['root'])){
		$noderoot = '//*[@id = "' . $_GET['root'] . '"]/';
	}else{
		$noderoot = '/';
	}
	$articleData['COURSEID'] = $_GET['id'];
	$sqlquery = "SELECT * FROM courses WHERE id='" . $articleData['COURSEID'] . "' LIMIT 1";
	$sqlresult = sql_execute($sqlquery);
	$crow = sql_get($sqlresult);
	$articleData['COURSENAME'] = $crow['NAME'];
	
	$packData = $crow['PACKAGECONTENTS'];
	if($packData == ''){
		$packData = '<packcontent></packcontent>';
	}
	
	$xmlDoc = new ALMS_XMLHandler($packData);
	$articlelist = $xmlDoc->getNodeList($noderoot . 'article');
	$resourcelist = $xmlDoc->getNodeList($noderoot . 'resource');
	
	$xi = 0;
	foreach($articlelist as $item){
		$sid = $item->getAttribute('id');
		
		$articleTableData[$xi]['ITEMNAME'] = 'Article';
		$articleTableData[$xi]['NAME'] = '';
		$articleTableData[$xi]['ID'] = $sid;
		if(check_user_permission("content_view")){
			$articleTableData[$xi]['VIEW'] = true;
		}
		if(check_user_permission("content_modify")){
			$articleTableData[$xi]['MODIFY'] = true;
		}
		if(check_user_permission("content_remove")){
			$articleTableData[$xi]['DELETE'] = true;
		}
	}
	
	$xi = 0;
	foreach($resourcelist as $item){
		$sid = $item->getAttribute('id');
		
		$resourceTableData[$xi]['ITEMNAME'] = 'Resource';
		$resourceTableData[$xi]['NAME'] = $item->getAttribute('name');
		$resourceTableData[$xi]['ID'] = $item->getAttribute('url');
		$resourceTableData[$xi]['URL'] = $sid;
		if(check_user_permission("content_view")){
			$resourceTableData[$xi]['VIEW'] = true;
		}
		if(check_user_permission("content_modify")){
			$resourceTableData[$xi]['MODIFY'] = true;
		}
		if(check_user_permission("content_remove")){
			$resourceTableData[$xi]['DELETE'] = true;
		}
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
