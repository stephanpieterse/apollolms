<form method="post" action="sitesettings.php?pq=update_siteStyle">
<option>
<select>Default</select>
<?php
// get all directories within custom styles folder
foreach($dir as $i){
	$link = "<select>";
	$link .= $i;
	$link .= "</select>";
	echo $link;
}
?>
</option>
</form>