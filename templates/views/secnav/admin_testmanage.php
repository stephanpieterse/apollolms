<?php

if(check_user_permission("tests_add")){
	$link = '<li><a href="index.php?action=newTest">Add New Test</a></li>';
	echo $link;
	}
if(check_user_permission("tests_installQ")){
	$link = '<li><a href="index.php?aq=frm_installTestQ">Install Test Question</a></li>';
	echo $link;
	}

?>