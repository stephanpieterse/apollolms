<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
?>

<form method="post" action="index.php?pq=report_item">
<input type="hidden" name="reporturl" value="
<?php 
	echo pathinfo($_SERVER['SCRIPT_FILENAME'],PATHINFO_BASENAME) . '?' .  $_SERVER['QUERY_STRING'];
?>" />

<input type="checkbox" id="icp" name="copyright" /> <label for="icp">Copyright Issues
</label>

<input type="checkbox" id="ifc" name="false" /><label for="ifc"> False / Misleading Content
</label>

<input type="checkbox" id="ioc" name="offensive" /><label for="ioc"> Offensive / Inappropriate Content
</label>
Details:<br/>
<textarea type="text" name="details">Please provide us with a description of the content you are reporting</textarea>
<p>
<input type="submit" value="Report" />
</p>
</form>
