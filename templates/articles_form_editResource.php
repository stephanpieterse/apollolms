<?php

	$smarty = new Smarty();
	
	if(isset($_GET['resid'])){
		$aid = isset($_GET['parentID']) ? $_GET['parentID'] : null;
		$cid = $_GET['cid'];
		$res = $_GET['resid'];
		$q = "SELECT PACKAGECONTENT FROM courses WHERE id='$cid' LIMIT 1";
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
	$smarty->assign('resid',$res);
	$smarty->assign('resname',$resname);
	$smarty->assign('resurl',$resurl);
	$smarty->assign('courseid',$courseID);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
