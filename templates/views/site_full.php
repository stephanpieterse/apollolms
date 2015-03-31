<body>
	<noscript>
		<span style=" margin-left:auto; margin-right:auto; font-weight: bold; height: 75px; width: 100%; background: #AA5500">This website has many features which depend on JavaScript. Not having JavaScript enabled in your browser will mean that some features will not work properly.</span>
	</noscript>
	<script type="text/javascript">
	var cookieEnabled = (navigator.cookieEnabled) ? true : false;
	if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled)
	{ 
		document.cookie="testcookie";
		cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
	}
	if(!cookieEnabled){
		document.write('JavaScript has detected that <a target="_blank" href="https://en.wikipedia.org/wiki/HTTP_cookie">cookies</a> are not currently enabled. This site uses cookies to identify you. Please enable them before you will be able to continue.');
	}
	</script>
<?php
	
	if(isset($_SESSION['SITE_ERROR_MSG'])){
		$SYSTEM_ERROR_MSG = $_SESSION['SITE_ERROR_MSG'];
		unset($_SESSION['SITE_ERROR_MSG']);
	}
	if(isset($_SESSION['SITE_INFO_MSG'])){
		$SYSTEM_STAT_MSG = $_SESSION['SITE_INFO_MSG'];
		unset($_SESSION['SITE_INFO_MSG']);
	}
	if(isset($_GET['msg'])){
		$q = "SELECT * FROM statmessages WHERE msgname='" . $_GET['msg'] . "' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
		if(isset($d['MESSAGE'])){
			$SYSTEM_STAT_MSG = $d['MESSAGE'];
		}
	}
?>

<div id="maincontainer">

<div id="topsection"><div class="innertube">
	<?php echo $ADMINNAV_AREA; ?>
<?php
echo siteLogoUrl();
include("loginSection.php");

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
</div></div>

<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
	<?php echo $CONTENT_AREA; ?>
</div>
</div>
</div>

<div id="leftcolumn">
<div class="innertube mainNav">
	<?php echo $NAVBAR_AREA; ?>
</div>
</div>

<div id="rightcolumn">
<div class="innertube">
	<!--<div id="adverts">
		<div><img src="media/bottomAdDefault.png" title="Default Ad"/></div>
		<div>ads section not populated yet</div>
    </div>
    <script type="text/javascript" src="scripts/ad-slideshow.js"></script>
	</div>
	-->
</div>

</div>

<div id="footer">
  <?php echo $FOOTER_AREA; ?>
</div>
</div>

</body>
