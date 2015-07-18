<?php

function sidebarIndex($course,$article){
	if($course >= 1){
	//	echo "Course";
		//displayCourseIndex($course);
		include(TEMPLATE_PATH . 'courses_form_displayCourseIndex.php');
		echo makeIndex($article);
	}
}

$smarty = new Smarty;
