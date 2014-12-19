<?php
if(check_user_permission("groups_add")){
		echo '<li><a href="index.php?action=addGroup">Add New Group</a></li>';
		}
		if(check_user_permission("groups_add")){
		echo '<li><a href="index.php?action=addGroupType">Add New Group Type</a></li>';
	}
?>