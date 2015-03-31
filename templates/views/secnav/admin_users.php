<?php
if(check_user_permission("user_add")){
	echo '<li><a href="users.php?f=addUserItem">Add New User</a></li>';
}
if(check_user_permission("user_add")){
	echo '<li><a href="users.php?f=viewPending">View Pending Requests</a></li>';
	}
if(check_user_permission("user_add")){
	echo '<li><a href="users.php?f=uploadcsv">Import from CSV</a></li>';
	}
?>
<li><a href="mail.php?f=sendemail&type=allmembers">Mail Everyone</a></li>
