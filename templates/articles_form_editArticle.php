<?php
	$smarty = new Smarty;
	$newArticle = true;
	$cid = $_GET['cid'];
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$newArticle = false;
	}
	
	if(isset($_GET['parentID'])){
		$pid = $_GET['parentID'];
	}
	
	if(!$newArticle){
		
		$q = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
		$r = sql_execute($q);
		$cdata = sql_get($r);
		
		$doc = new ALMS_XMLHandler($cdata['PACKAGECONTENTS']);
		$xpath = '//*[@id="'.$aid.'"]';
		$nodelist = $doc->getNodeList($xpath);
		$data = $nodelist->item(0);
	}	
	
	if(!$newArticle){
		$smarty->assign('ARTICLE_NAME',$data->getAttribute('name'));
		$smarty->assign('HTML_CONTENT',$data->getAttribute('html_content'));
		$smarty->assign('ARTICLE_CODE',$data->getAttribute('code'));
		$smarty->assign('ARTICLE_DESC',$data->getAttribute('description'));
		$smarty->assign('COURSE_ID',$cid);
		$smarty->assign('ARTICLE_ID',$aid);
	}else{
		$smarty->assign('ARTICLE_NAME','');
		$smarty->assign('HTML_CONTENT','');
		$smarty->assign('ARTICLE_CODE','');
		$smarty->assign('ARTICLE_DESC','');
		$smarty->assign('COURSE_ID',$cid);
		if(isset($pid)){
			$smarty->assign('PARENT_ID',$pid);
		}
	}
	$smarty->assign('new',$newArticle);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
