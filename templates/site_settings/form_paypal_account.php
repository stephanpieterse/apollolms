<?php
	$q = "SELECT value FROM site_settings WHERE item='paypal_account'";
	$d = sql_get(sql_execute($q));
	$val = $d['value'];
?>
<form method="post" action="/sitesettings.php?update=paypal_details">
<span class="bold">Please enter your Paypal Account Name or Merchant ID</span>
<input type="text" name="paypalaccount" value="<?php echo $val; ?>" />
<input type="submit" value="Update" />	
</form>