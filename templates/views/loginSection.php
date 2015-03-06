<?php
/**
 * @package ApolloLMS
  @author Stephan Pieterse
 * */
?>
<div style="margin: 10px;" class="fl_right">
<?php
	//echo '<a href="index.php" class="fl_left"><img alt="" src="' .SITE_LOGO .'" height="65" /></a>';
    if(isset($_SESSION['userID'])) {
		$username = $_SESSION['username'];
		echo '<a href="users.php?f=viewProfile">' . showProfilePic("50") . '</a>';
//	    echo "Welcome " . $_SESSION['username'] . '<br/>';
		?>
		<br/>
		<a href="index.php?q=logout">Logout</a>
	<?php
    }else{
    
	    include("form_login.php" );
    }
?>
</div>
