<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
if(check_user_permission("roles_add")){
	echo '<li><a href="roles.php?f=editRole">Add New Role</a></li>';
}
?>
