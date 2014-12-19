<?php
/**
 * @package ApolloLMS
 * */
if(check_user_permission("role_add")){
	echo '<li><a href="roles.php?f=editRole">Add New Role</a></li>';
}
?>
