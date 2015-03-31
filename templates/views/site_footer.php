
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
		<a href="help.php?f=request">Content Request</a>-
		<?php
		$fulldata = "";
		foreach($_GET as $key=>$val){ $fulldata .= '&' . $key . '=' . $val;}
			echo '<a href="index.php?f=reportitem' . $fulldata . '">Report this page</a>';
		}
		?>
		</div>
