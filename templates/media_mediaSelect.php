<html>
<head>

<script langauge="javascript">
function post_value(){
opener.document.resdetails.resurl.value = document.selector.filename.value;
opener.document.resdetails.resource_url.value = document.selector.filename.value;
self.close();
}
</script>

<title>Select a media file</title>
</head>


<body >

<form name="selector" method="POST" action="">
<table border=0 cellpadding=0 cellspacing=0 width=250>

<?php

	include("media_form_admin_viewAllMedia.php");

?>

<tr><td align="center"> Your name<input type="text" name="filename" size=12 value="Test Input">
<input type=button value='Submit' onclick="post_value();">
</td></tr>
</table></form>
