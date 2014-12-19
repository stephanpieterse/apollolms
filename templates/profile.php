<?php
	$username = $_SESSION['userID'];
	$link = '<a href="users.php?f=editUser&uid=' . $username . '">Update Profile Data</a><br/>';
	echo $link;

	$link = '<a href="index.php?action=mod_user_pref&user=' . $username . '">Edit Preferences</a><br/>';
	//echo $link;
	//br();
	//$link = '<a href="index.php?action=chngPass">Change Password</a>';
	$link = '<a href="index.php?action=lostpassword">Change Password</a><br/>';
	echo $link;
	
	$link = '<a href="users.php?f=upload_profilePic">Upload a photo</a><br/>';
	echo $link;
	
	$link = '<a href="index.php?uq=user_view_history">Viewing History</a><br/>';
	echo $link;
	
	loadPageModules('profile');
?>