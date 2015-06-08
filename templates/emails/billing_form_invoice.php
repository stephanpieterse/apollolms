<html doctype="html5">
<head></head>
<body>
<img width="200px" src="http://apollolms.co.za/media/logo.png" />
<br/>
Bill for: <?php echo $BILLING_NAME; ?><br/>
Total Active Users: <?php echo $BILLING_ACTIVEMEMBERS; ?><br/>
Space Used:<?php echo $BILLING_TOTALSPACEUSED; ?><br/>
Estimated Bandwith per user: <?php echo $BILLING_TOTALSPACEUSEDBANDWITH; ?> MB<br/>
Administration + Server Cost: <?php echo $BILLING_TOTALADMINCOST;?><br/>
Active users:<br/><?php foreach($BILLING_LISTALLUSERS as $ui){echo $ui['name'] . ' - ' . $ui['logins'] . ' logins.<br/>';} ?><br/>
Cost for newly registered courses:<?php echo $BILLING_TOTALCOURSESBILL; ?><br/>
<br/>
We thank you for your continued support.
</body>
</html>
