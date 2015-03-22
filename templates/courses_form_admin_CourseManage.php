<?php
/**
 * Admin page for managing courses.
 * 
 * @author Stephan
 * @package ApolloLMS
 * */

	$sqlquery = "SELECT * FROM courses";
	$sqlresult = sql_execute($sqlquery);
	
	$smarty = new Smarty;
	
	$dataArray = array();
	$curPos = 0;
	while($rowdata = sql_get($sqlresult)){
		$dataArray[$curPos]['ID'] = $rowdata['ID'];
		$dataArray[$curPos]['NAME'] = $rowdata['NAME'];
		
		if(check_user_permission("content_view")){
			$dataArray[$curPos]['LINKS'][] =  '<a id="a_admin_user_view" href="courses.php?f=displayCourse&cid=' . $rowdata['ID'] . ' "> <img src="' . ICONS_PATH . 'magnifier.png" alt="View"/></a></td><td>';
		}else{ 
			$dataArray[$curPos]['LINKS'][] = $rowdata['NAME']; 
			}
		if(check_user_permission("content_modify")){
			$dataArray[$curPos]['LINKS'][] = '<a href="courses.php?f=editCourse&id=' . $rowdata['ID'] . ' "> <img src="' . ICONS_PATH . 'pencil.png" alt="Edit Course"/></a>';
			$dataArray[$curPos]['LINKS'][] = '<a href="courses.php?f=editArticles&id=' . $rowdata['ID'] .' "> Articles <img src="' . ICONS_PATH . 'page_white_text.png" alt="Edit Articles"/></a>';
		}
		if(check_user_permission("content_remove")){
			$dataArray[$curPos]['LINKS'][] = '<a href="index.php?confirm&action=rem_course&course=' . $rowdata['ID'] .' "><img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a>';
		}
		$dataArray[$curPos]['LINKS'][] = '<a href="mail.php?f=sendemail&type=informCourseUsers&cid=' . $rowdata['ID'] .' "><img src="' . ICONS_PATH . 'email.png" alt="Email"/></a>';
		$curPos++;
	}
	
	$smarty->assign('courseData',$dataArray);
	
	$sqlquery = "SELECT * FROM course_packages";
	$sqlresult = sql_execute($sqlquery);
	
	$dataArrayPack = array();
	$curPos = 0;
	while($rowdata = sql_get($sqlresult)){
		$dataArrayPack[$curPos]['ID'] = $rowdata['ID'];
		$dataArrayPack[$curPos]['NAME'] = $rowdata['NAME'];
		
		if(check_user_permission("content_view")){
			$dataArrayPack[$curPos]['LINKS'][] =  '<a id="a_admin_user_view" href="courses.php?f=displayCourse&cid=' . $rowdata['ID'] . ' "> <img src="' . ICONS_PATH . 'magnifier.png" alt="View"/></a></td><td>';
		}else{ 
			$dataArrayPack[$curPos]['LINKS'][] = $rowdata['NAME']; 
			}
		if(check_user_permission("content_modify")){
			$dataArrayPack[$curPos]['LINKS'][] = '<a href="courses.php?f=editCourse&id=' . $rowdata['ID'] . ' "> <img src="' . ICONS_PATH . 'pencil.png" alt="Edit Course"/></a>';
			$dataArrayPack[$curPos]['LINKS'][] = '<a href="courses.php?f=editArticles&id=' . $rowdata['ID'] .' "> Articles <img src="' . ICONS_PATH . 'page_white_text.png" alt="Edit Articles"/></a>';
		}
		if(check_user_permission("content_remove")){
			$dataArrayPack[$curPos]['LINKS'][] = '<a href="index.php?confirm&action=rem_course&course=' . $rowdata['ID'] .' "> Remove <img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a>';
		}
		$curPos++;
	}
	
	$smarty->assign('coursePackagesData',$dataArrayPack);
	
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
	echo tooltip("Edit course details and articles here","course_edit");
