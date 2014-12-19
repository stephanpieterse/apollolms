<?php
	/**
	 * @package ApolloLMS
	 * */

	$q = "SELECT value FROM site_settings WHERE item='bulksms_account'";
	$d = sql_get(sql_execute($q));
	$arr = $d['value'];
	$arr = explode(',',$arr);
	$valID = $arr[0];
	$valKey = simple_decrypt('bulksms',$arr[1]);
?>
<form method="post" action="sitesettings.php?pq=update_bulksmsDetails">
<span class="bold">Please enter your Bulksms Username</span><br/>
<input type="text" name="bulksmsUsername" value="<?php echo $valID; ?>" /><br/>
<span class="bold">Please enter your Bulksms Password</span><br/>
<input type="password" name="bulksmsPassword" value="<?php echo $valKey; ?>" /><br/>
<input type="submit" value="Update" /><br/>
</form>
