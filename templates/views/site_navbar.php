<div class="wrapper col0">
	<div id="admin_floating_nav">
		<div id="admin_floating_nav_login">
		<?php
echo siteLogoUrl();
include("loginSection.php");
?>
	
			<br class="clear" />
		</div>
	</div>
</div>
<?php
if(isset($SYSTEM_ERROR_MSG)){
	echo <<<REF
<div class="redMsgBox" id="system_error_msg"> $SYSTEM_ERROR_MSG </div>
REF;
unset($SYSTEM_ERROR_MSG);
}
if(isset($SYSTEM_HELP_MSG)){
	echo <<<REF
<div class="yellowMsgBox" id="system_help_msg"> $SYSTEM_HELP_MSG </div>
<script>
	$('#system_help_msg').delay(8000).fadeOut(1000);
</script>
REF;
}
if(isset($SYSTEM_STAT_MSG)){
	echo <<<REF
<div class="greenMsgBox" id="system_stat_msg"> $SYSTEM_STAT_MSG </div>
<script>
	$('#system_stat_msg').delay(8000).fadeOut(1000);
</script>
REF;
}
?>

<br class="clear" /> 
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
