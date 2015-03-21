</div>
</div>
</div>

<div id="leftcolumn">
<div class="innertube mainNav"><?php
if(isset($_SESSION['userID'])){
	$loggedIn = true;
  include("navigation.php");
}
?></div>
</div>

<div id="rightcolumn">
<div class="innertube">
	<?php include("secondNavBar.php"); ?>
	<div id="adverts">
		<div><img src="media/bottomAdDefault.png" title="Default Ad"/></div>
		<div>ads section not populated yet</div>
    </div>
    <script type="text/javascript" src="scripts/ad-slideshow.js"></script>
	</div>
</div>

</div>

<!--
<div class="wrapper col5 bannercolour">
  <div id="footer">
    <div id="newsletter">
		<div><img src="media/bottomAdDefault.png" title="Default Ad"/></div>
		<div>ads section not populated yet</div>
    </div>
    <script type="text/javascript" src="scripts/ad-slideshow.js"></script>
    <div class="footbox">
    	<h2>Misc</h2>
    	<ul>
		<?php
		if(isset($_SESSION['userID'])){
        echo '<li class="last"><a href="help.php?f=request">Content Request</a></li>';
        echo '<li class="last"><a href="index.php?f=help">Help</a></li>';
		}
		?>
		<?php
		if(isset($_SESSION['userID'])){
		?>
	<li><a href="index.php?f=reportitem<?php foreach($_GET as $key=>$val){ echo '&' . $key . '=' . $val;} ?>">Report this page</a></li>
	<?php
		} //endif
	?>
	 </ul>
    </div>
  
    <br class="clear" />
  </div>
</div>
-->

<!-- <div id="footer" class="wrapper col6"> -->
<div id="footer">
  <div id="copyright">
    <div class="centertext fullwidth">Copyright &copy; 2013-<?php echo date("Y"); ?> - All Rights Reserved - <a target="_blank" href="http://www.apollolms.co.za">Apollo Learning Management System</a></div>
    <div class="centertext fullwidth">Mail: <a href="mailto:<?php echo SITE_EMAIL; ?>"> <?php echo SITE_EMAIL; ?> </a></div>
    <div class="centertext fullwidth"><?php 
    $time_end = microtime(true);
	$execution_time = ($time_end - $_SESSION['time_start']);
    echo 'Request served in '.$execution_time.'s'; ?></div>
    <a target="_blank" href="http://wiki.apollolms.co.za/index.php/Help:FAQ" title="Help Pages">Help</a>
	-
	<a target="_blank" href="http:/apollolms.co.za/termsOfService.html" title="View the terms of service">Terms of Service</a>
	-
	<a target="_blank" href="http:/apollolms.co.za/privacyPolicy.html" title="View the privacy policy">Privacy Policy</a>
	-
	<?php
		if(is_user_loggedIn()){
		?>
		<a href="help.php?f=request">Content Request</a>
		<?php
		$fulldata = "";
		foreach($_GET as $key=>$val){ $fulldata .= '&' . $key . '=' . $val;}
		echo '<a href="index.php?f=reportitem' . $fulldata . '">Report this page</a>';
		}
		?>
    <br class="clear" />
  </div>
</div>
</div>

</body>
