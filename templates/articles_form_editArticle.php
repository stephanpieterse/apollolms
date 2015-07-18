<?php
	$smarty = new Smarty;
	$newArticle = false;
	if(isset($_GET['aid'])){
		$aid = $_GET['aid'];
		$q = "SELECT * FROM articles WHERE id='$aid' LIMIT 1";
		$r = sql_execute($q);
		$data = sql_get($r);
		$newArticle = true;
	}
	if(isset($_GET['cid'])){
		$cid = $_GET['cid'];
	}	
	
	if($newArticle){
		$smarty->assign('ARTICLE_NAME',$data['NAME']);
		$smarty->assign('HTML_CONTENT',$data['HTML_CONTENT']);
		$smarty->assign('ARTICLE_CODE',$data['CODE']);
		$smarty->assign('ARTICLE_DESC',$data['DESCRIPTION']);
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
