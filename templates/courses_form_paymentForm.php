<?php
/**
 * Payment form for the courses.
 * 
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */

	// ={userID}{courseID}{usernameFirst3Digits}{coursenameFirst3Digits}{first5digits of ids hashed}
	$userandcourse = $_SESSION['userID'] . $_GET['cid'];
	
	$q = "SELECT name FROM members WHERE id='".$_SESSION['userID']."' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$username = $d['name'];
	
	$q = "SELECT name,price FROM courses WHERE id='".$_GET['cid']."' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
	$coursename = $d['name'];
	$courseprice = $d['price'];
	
	$userReferenceNum = $userandcourse . substr($username,0,3) . substr($coursename,0,3) . substr(hash("sha256",$userandcourse),0,5);

?>
<p>
Your Reference Number: <b><?php echo $userReferenceNum; ?></b>
<br/>
Price of this course:<b>R <?php echo $courseprice; ?></b>
</p>
<p><h1>Pay manually:</h1>
<span class="bold">Banking details:</span><br/>
<?php
	$details = get_site_banking_details();
	echo "Bank Name: " . $details['bank_name'] . '<br/>';
	echo "Account Number: " . $details['account_number'] . '<br/>';
	echo "Account Type: " . $details['account_type'] . '<br/>';
	echo "Branch Code: " . $details['branch_code'] . '<br/>';
?>
<form method="POST" action="courses.php?pq=registerForCourse">
Once you have completed the manual payment, please submit the captcha. <br/>
<input type="hidden" name="purchRef" value="<?php echo $userReferenceNum; ?>" />
<input type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>" />
<img id="captcha" src="scripts/securimage/securimage_show.php" alt="CAPTCHA Image" /><br/>
<input type="text" name="captcha_code" size="10" maxlength="6" />
<a href="" onclick="document.getElementById('captcha').src = 'scripts/securimage/securimage_show.php?' + Math.random(); return false;">[ Different Image ]</a><br/>
<input type="submit" value="Submit" />
</form>
Please forward a proof of payment to <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a> to expedite activation.
</p>
<p>
<?php
	$paypalaccount = get_site_paypal_adress();
	if($paypalaccount !== false){
?>
<hr/>OR<hr/>
Pay via Paypal <a></a>
<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo get_site_paypal_adress(); ?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="custref" value="<?php echo $userReferenceNum; ?>">
<input type="hidden" name="item_name" value="<?php echo $coursename; ?>">
<input type="hidden" name="amount" value="<?php echo round($courseprice * get_current_exchange_rate()); ?>">
<input type="image" src="http://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
<?php
}else{
	echo "Paypal account details are not yet available.<br/>";
	} //endif
?>
<?php
	$payfastaccount = get_site_payfast_account();
	if($payfastaccount !== false){
?>
<form name="_payfast" action="https://www.payfast.co.za/eng/process" method="post">
<input type="hidden" name="merchant_id" value="<?php echo $payfastaccount['id'];?>"/>
<input type="hidden" name="merchant_key" value="<?php echo $payfastaccount['key'];?>"/>
<input type="hidden" name="return_url" value="" />
<input type="hidden" name="cancel_url" value="" />
<input type="hidden" name="notify_url" value="https://apollolms.co.za/ -- insert sitename --/online_payment/payfast_integrate_itn.php" />

<input type="hidden" name="name_first" value="" />
<input type="hidden" name="name_last" value="" />
<input type="hidden" name="email_address" value="" />

<input type="hidden" name="m_payment_id" value="" />
<input type="hidden" name="amount" value="" />
<input type="hidden" name="item_name" value="" />
<input type="hidden" name="item_description" value="" />

<input type="hidden" name="email_confirmation" value="1" />
<input type="hidden" name="confirmation_address" value="<?php echo SITE_EMAIL;?>" />
</form>
<?php
	}else{
	echo "Payfast account details are not yet available.<br/>";
	} //endif
?>
</p>
