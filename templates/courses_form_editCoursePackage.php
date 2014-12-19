<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
	$smarty = new Smarty;
	if(isset($_GET['id'])){
		$cid = $_GET['id'];
		$q = 'SELECT * FROM courses WHERE id="' . $_GET['id'] . '"';
		$result = sql_execute($q);
		$data = sql_get($result);
	}
?>
<?php
	if(isset($cid)){
	$formHeader = '<form method="POST" action="courses.php?pq=updateCoursePackage">' . '<input type="hidden" name="id" value="'.$cid.'"';
	}else{
	$formHeader = '<form method="POST" action="courses.php?pq=addCoursePackage">';
	}
?>
<?php
// permissions form usually echoes... need to catch that before it goes out
	ob_start();
	if(isset($cid)){
		buildPermissionsForm($data['PERMISSIONS']);
	}else{
		buildPermissionsForm();
	}
	$permString = ob_get_contents();
	ob_clean();
?>
<?php
	$q = "SELECT * FROM courses";
	$r = sql_execute($q);
	$courseCount = 0;
	while($d = sql_get($r)){
		$coursesList[$courseCount]['ID'] = $d['ID'];
		$coursesList[$courseCount]['NAME'] = $d['NAME'];
		$coursesList[$courseCount]['CODE'] = $d['CODE'];
		$courseCount++;
	}	
?>
<?php
if(isset($cid)){
	$smarty->assign('formTop',$formHeader);
	$smarty->assign('courseName',$data['NAME']);
	$smarty->assign('courseCode',$data['CODE']);
	$smarty->assign('coursePrice',$data['PRICE']);
	$smarty->assign('courseTags',$data['TAGS']);
	$smarty->assign('courseHTML',$data['DESCRIPTION']);
	$smarty->assign('coursePERM',$permString);	
	$smarty->assign('coursesList',$coursesList);	
}else{
	$smarty->assign('formTop',$formHeader);
	$smarty->assign('courseName','');
	$smarty->assign('courseCode','');
	$smarty->assign('coursePrice','0');
	$smarty->assign('courseTags','');
	$smarty->assign('courseHTML','');
	$smarty->assign('coursePERM',$permString);
	$smarty->assign('coursesList',$coursesList);
}
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
