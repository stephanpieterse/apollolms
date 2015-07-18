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
	
	/*
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
				$articleTableData[$xi]['LINKS'][] = "<a href=\"articles.php?q=mv_art&id=" . $cid ."&dir=down&aid=" . $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
			
			}
			if(check_user_permission("content_remove")){
				// functions previously used nodeid
				$articleTableData[$xi]['LINKS'][] = '<a href="courses.php?q=removeResource&id=' . $sid . '&cid=' . $_GET['id'] .' "><img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a><br/>';
			}
				
		}
		$nodeID++;
		$xi++;
	}
	*/
	
	$smarty->assign('articleData',$articleData);
	$smarty->assign('iconsPath',ICONS_PATH);
	if(isset($articleTableData)){
		$smarty->assign('tableData',$articleTableData);
	}
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
