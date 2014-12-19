<?php
if(check_user_permission("user_add")){
	echo '<li><a href="index.php?action=addUser">Add New User</a></li>';
}
if(check_user_permission("user_add")){
	echo '<li><a href="">View Pending Requests</a></li>';
	}
if(check_user_permission("user_add")){
	echo '<li><a href="index.php?aq=impCSVform">Import from CSV</a></li>';
	}
?>