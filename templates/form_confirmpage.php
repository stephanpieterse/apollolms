<?php
	$scriptname = pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME);
	$action = $scriptname . '?confirm=1';
	$reqpart = "";
	foreach($_GET as $key=>$value){if($key != 'confirm'){$reqpart .= '&'.$key . '=' . $value;}}
	$action .= $reqpart;
?>

<form method="POST" action="<?php echo $action; ?>">
<p>
Are you sure you wish to do this? This action can only be undone by the system administrator.
</p>
<input name="submit" type="submit" value="Yes, I'm sure" />
<p>
<a href="index.php?q=goToLastPage">No! Take me back now! </a>
</p>
</form>
