<?php
if(check_user_permission("content_modify")){

	}
	if(check_user_permission("content_add")){
	$link = '<li><a href="courses.php?f=editCourse">New Course</a></li>';
	echo $link;
	}
	if(check_user_permission("content_add")){
	$link = '<li><a href="courses.php?f=editCoursePackage">New Course Package</a></li>';
	echo $link;
	}
	$link = '<li><a href="courses.php?f=admin_pendingRegister">View Pending Registration Requests</a></li>';
	echo $link;
?>
