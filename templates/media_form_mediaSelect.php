<html>
<head>

<script type="text/javascript">
function post_value(){
	opener.document.resdetails.resource_url.value = document.selector.fileurl.value;
	self.close();
}
</script>

<title>Select a media file</title>
</head>


<body >

<form name="selector" method="POST" action="">


<?php

	include("media_form_admin_viewAllMedia.php");

?>

 <input type="button" value="Submit" onclick="post_value();">

</form>
