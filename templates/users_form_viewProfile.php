<?php
	$username = $_SESSION['userID'];
	$link = '<a href="users.php?f=editUser&uid=' . $username . '">Update Profile Data</a><br/>';
	echo $link;

	$link = '<a href="users.php?f=lostpassword">Change Password</a><br/>';
	echo $link;
	
	$link = '<a href="users.php?f=upload_profilePic">Upload a photo</a><br/>';
	echo $link;
	
	$link = '<a href="users.php?f=viewHistory&uid=' . $_SESSION['userID'] . '">Viewing History</a><br/>';
	echo $link;
	
	loadPageModules('profile');
?>
