<?php
	$q = "SELECT value FROM site_settings WHERE item='payfast_account'";
	$d = sql_get(sql_execute($q));
	$arr = $d['value'];
	$arr = explode(',',$arr);
	$valID = $arr[0];
	$valKey = $arr[1];
?>
<form method="post" action="sitesettings.php?pq=update_payfastDetails">
<span class="bold">Please enter your Payfast Merchant ID</span><br/>
<input type="text" name="payfastid" value="<?php echo $valID; ?>" /><br/>
<span class="bold">Please enter your Payfast Merchant Key</span><br/>
<input type="text" name="payfastkey" value="<?php echo $valKey; ?>" /><br/>
<input type="submit" value="Update" /><br/>
</form>