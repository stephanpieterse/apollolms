</div>
</div>
</div>
<!-- ######################################### -->
<div class="wrapper col5 bannercolour">
  <div id="footer">
    <div id="newsletter">
    </div>
    <div class="footbox">
    	<h2>Misc</h2>
    	<ul>
        <!--<li class="last"><a href="#">Search</a></li>-->
		<?php
		if(isset($_SESSION['userID'])){
        echo '<li class="last"><a href="index.php?uq=requestform">Content Request</a></li>';
        echo '<li class="last"><a href="index.php?uq=help">Help</a></li>';
        // echo '<li class="last"><a target="_blank" href="./info/standard_faq.pdf" title="Frequently Asked Questions">F.A.Q</a></li>';
		}
		?>
		<?php
		if(isset($_SESSION['userID'])){
	//	load_user_permissions($_SESSION['userID']);
	 }
		?>
	<li><a href="?gq=report_form<?php foreach($_GET as $key=>$val){ echo '&' . $key . '=' . $val;} ?>">Report this page</a></li>
	 </ul>
    </div>
    <div class="footbox">
      <h2>Site Information</h2>  
      <ul>
        <li><a target="_blank" href="./info/standard_tos.pdf" title="View the terms of service">Terms of Service</a></li>
		<li><a target="_blank" href="./info/standard_pp.pdf" title="View the privacy policy">Privacy Policy</a></li>
		<li><a target="_blank" href="http://wiki.apollolms.co.za/index.php/Help:FAQ" title="View the privacy policy">F.A.Q.</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ######################################### -->
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