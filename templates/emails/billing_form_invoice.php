<html doctype="html5">
<head></head>
<body>
<img width="200px" src="http://apollolms.co.za/media/logo.png" />
<br/>
Bill for: <?php echo $BILLING_NAME; ?><br/>

Total Active Users: <?php echo $BILLING_ACTIVEMEMBERS; ?><br/>
Space Used:<?php echo $BILLING_TOTALSPACEUSED; ?><br/>

Estimated Bandwith per user: </td><td> {$totalSpaceUsedBandwith} MB
Administration + Server Cost: </td><td> {$totalAdminCost}</td>
Active users:{section name=sec1 loop=$listAllUsers}{$listAllUsers[sec1]}<br/>{/section}</div></td>
Cost for newly registered courses: </td><td>{$totalCoursesBill}</td>




<?php echo $BILLING_DATA; ?>
<br/>
Thank you for your continued support.
</body>
</html>
