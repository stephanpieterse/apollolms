<form method="post" action="sitesettings.php?q=update_billingEmail">
Billing Adress:<br/>
<input class="fullWidth" type="text" name="bill_email" value="{$billingEmail}"/>
<input value="Update" type="submit" />
</form>
<table class="centerfloat">
<tr>
<td>Total Active Users: </td><td>{$activeMembers}</td>
</tr><tr><td>
Space Used:</td><td>{$totalSpaceUsed} MB of {$totalUploadsMax}</td>
</tr><tr><td>
Estimated Bandwith per user: </td><td> {$totalSpaceUsedBandwith} MB</td>
</tr><tr><td>
Administration + Server Cost: </td><td> {$totalAdminCost}</td>
</tr><tr><td>
Active users: </td><td><div style="max-height:200px; overflow:auto;">{section name=sec1 loop=$listAllUsers}{$listAllUsers[sec1]}<br/>{/section}</div></td>
</tr><td>
Cost for newly registered courses: </td><td>{$totalCoursesBill}</td>
</tr><tr>
<td>Applicable Discount:</td><td>0</td>
</tr><tr>
<td>TOTAL COST</td><td>R{$totalFinalCost}</td>
</tr>
</table>
These figures are for testing and reference only, no bills will be sent and the information displayed is purely for informing you of the estimated cost of the system once out of beta phase.
<a href="crons.php?f=invoicePreview">Preview Invoice</a>
