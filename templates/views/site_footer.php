</div>
</div>
</div>

<div class="wrapper col5 bannercolour">
  <div id="footer">
    <div id="newsletter">
		<img src="media/bottomAdDefault.png" title="Default Ad"/>
    </div>
    <div class="footbox">
    	<h2>Misc</h2>
    	<ul>
		<?php
		if(isset($_SESSION['userID'])){
        echo '<li class="last"><a href="index.php?f=request">Content Request</a></li>';
        echo '<li class="last"><a href="index.php?f=help">Help</a></li>';
		}
		?>
		<?php
		if(isset($_SESSION['userID'])){
	//	load_user_permissions($_SESSION['userID']);
	 }
		?>
	<li><a href="index.php?f=reportitem<?php foreach($_GET as $key=>$val){ echo '&' . $key . '=' . $val;} ?>">Report this page</a></li>
	 </ul>
    </div>
    <div class="footbox">
      <h2>Site Information</h2>  
      <ul>
        <li><a target="_blank" href="http:/apollolms.co.za/info/standard_tos.pdf" title="View the terms of service">Terms of Service</a></li>
		<li><a target="_blank" href="http:/apollolms.co.za/info/standard_pp.pdf" title="View the privacy policy">Privacy Policy</a></li>
		<li><a target="_blank" href="http://wiki.apollolms.co.za/index.php/Help:FAQ" title="View the privacy policy">F.A.Q.</a></li>
      </ul>
    </div>
    <div class="footbox">
    <!-- Just a spacer -->
    </div>
    <br class="clear" />
  </div>
</div>

<div class="wrapper col6">
  <div id="copyright">
    <div class="centertext fullwidth">Copyright &copy; 2013-<?php echo date("Y"); ?> - All Rights Reserved - <a target="_blank" href="http://www.apollolms.co.za">Apollo Learning Management System</a></div>
    <div class="centertext fullwidth">Mail: <a href="mailto:<?php echo SITE_EMAIL; ?>"> <?php echo SITE_EMAIL; ?> </a></div>
    <div class="centertext fullwidth"><?php 
    $time_end = microtime(true);
	$execution_time = ($time_end - $_SESSION['time_start']);
    echo 'Request served in '.$execution_time.'s'; ?></div>
    <br class="clear" />
  </div>
</div>
</body>
