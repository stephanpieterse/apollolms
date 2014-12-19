<?php
/**
 * @package ApolloLMS
 * */
	br_clear();
	//echo '<a href="index.php" class="fl_left"><img alt="" src="' .SITE_LOGO .'" height="65" /></a>';
	echo siteLogoUrl();
    if(isset($_SESSION['userID'])) {
		$username = $_SESSION['username'];
		echo '<a href="users.php?f=viewProfile">' . showProfilePic("50") . '</a>';
		echo '<div class="fl_right">';
	    echo "You are logged in as " . $_SESSION['username'] . '<br/><a href="users.php?f=viewProfile">' . 'Edit Profile' . '</a>';
		br();
		echo "<a href=\"index.php?action=logout\">Logout</a>";
		echo "</div>";
    }else{
    	echo '<div class="fl_right">';   
	    include("form_login.php" );
		echo "</div>";
    }
?>