<?php
if(isset($_SESSION['userID'])){
	$loggedIn = true;
echo<<<TYPE
<div id="nav_holder" class="bannercolour">
<div class="wrapper col2">
  <div id="topnav">
TYPE;
  include("navigation.php");
echo<<<TYPE
  </div>
  <br class="clear"/>
  <div id="topnav2">
TYPE;
  include("secondNavBar.php");
echo<<<TYPE
  </div>
</div>
</div>
<br class="clear" />
TYPE;
}
?>
<div class="wrapper col4">
<div id="container">
<div class="contentSection" id="homeMainSection">
