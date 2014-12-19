<?php
	if(check_user_permission("media_modify")){
	$link = '<li><a href="media.php?f=uploadFile&dir=' . $_GET['dir'] . '">Upload a File</a></li>';
	echo $link;
	$link = '<li><a href="media.php?f=newFolder">Create New Folder</a></li>';
	echo $link;
}
?>
