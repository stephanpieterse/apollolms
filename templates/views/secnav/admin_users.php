<?php
if(check_user_permission("user_add")){
	echo '<li><a href="index.php?action=addUser">Add New User</a></li>';
}
if(check_user_permission("user_add")){
	echo '<li><a href="">View Pending Requests</a></li>';
	}
if(check_user_permission("user_add")){
	echo '<li><a href="users.php?f=uploadcsv">Import from CSV</a></li>';
	}
?>
<li><a href="mail.php?f=compose&to=allmembers">Mail Everyone</a></li>
