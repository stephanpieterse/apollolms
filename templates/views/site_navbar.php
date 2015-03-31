<?php
if(isset($_SESSION['userID'])){
	$loggedIn = true;
	require("navigation.php");
	require("secondNavBar.php");
}
?>
