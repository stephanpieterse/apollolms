<?php

	$smarty = new Smarty();
	$courseID = $_GET['cid'];
	$aid = isset($_GET['parentID']) ? $_GET['parentID'] : null;
	$new = true;
	
	if(isset($_GET['resid'])){
		$new = false;
		$res = $_GET['resid'];
		
		$res = $_GET['resid'];
		$q = "SELECT PACKAGECONTENTS FROM courses WHERE id='$cid' LIMIT 1";
		$d = sql_get(sql_execute($q));
		
		$doc = new ALMS_XMLHandler($d['PACKAGECONTENTS']);
		$xpath = '//resource[@id = "'.$res.'"]';
		$nodelist = $doc->getNodeList($xpath);
		
		$resname = $nodelist->item(0)->getAttribute('name');
		$resurl = $nodelist->item(0)->getAttribute('url');
	}

	if(isset($aid)){
		$smarty->assign('articleid',$aid);
	}
	if(isset($res)){
		$smarty->assign('resid',$res);
		$smarty->assign('resname',$resname);
		$smarty->assign('resurl',$resurl);
	}else{
		$smarty->assign('resname','');
		$smarty->assign('resurl','');
	}
	$smarty->assign('courseid',$courseID);
	$smarty->assign('new',$new);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);

