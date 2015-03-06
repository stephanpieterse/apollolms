<script type="text/javascript" src="<?php echo SCRIPTS_PATH;?>jquery-1.9.1.js"></script> 
<script type="text/javascript" src="<?php echo SCRIPTS_PATH; ?>jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_PATH;?>gdocsview/jquery.gdocsviewer.js"></script>
<script type="text/javascript" src="<?php echo SCRIPTS_PATH;?>ajax_searches.js"></script>
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
	if(isset($_SESSION['userID'])){
		include("adminNavBar.php");
	 }
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
