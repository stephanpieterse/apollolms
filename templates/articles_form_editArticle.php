<?php
	$smarty = new Smarty;
	$newArticle = true;
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$newArticle = false;
	}
	if($newArticle){
		$cid = $_GET['cid'];
		$q = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
		$r = sql_execute($q);
		$cdata = sql_get($r);
		
		$doc = new ALMS_XMLHandler($cdata['PACKAGECONTENTS']);
		$xpath = '//*[@id="$aid"]';
		$nodelist = $doc->getNodeList($xpath);
		$data = $nodelist->item(0);
	}	
	
	if(!$newArticle){
		$smarty->assign('ARTICLE_NAME',$data->getAttribute('NAME'));
		$smarty->assign('HTML_CONTENT',$data->getAttribute('HTML_CONTENT'));
		$smarty->assign('ARTICLE_CODE',$data->getAttribute('CODE'));
		$smarty->assign('ARTICLE_DESC',$data->getAttribute('DESCRIPTION'));
		$smarty->assign('COURSE_ID',$cid);
		$smarty->assign('ARTICLE_ID',$aid);
	}else{
		$smarty->assign('ARTICLE_NAME','');
		$smarty->assign('HTML_CONTENT','');
		$smarty->assign('ARTICLE_CODE','');
		$smarty->assign('ARTICLE_DESC','');
		$smarty->assign('COURSE_ID',$cid);
	}
	$smarty->assign('new',$newArticle);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
