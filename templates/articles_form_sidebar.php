<?php
	$course = $_GET['cid'];
	$article = $_GET['aid'];
	if($course >= 1){
		ob_start();
		include(TEMPLATE_PATH . 'courses_form_displayCourseIndex.php');
		$courseIndex = ob_end_clean();
		$articleIndex = makeIndex($article);

	}

	$smarty = new Smarty;
	$smarty->assign('courseIndex',$courseIndex);
	$smarty->assign('articleIndex',$articleIndex);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);

