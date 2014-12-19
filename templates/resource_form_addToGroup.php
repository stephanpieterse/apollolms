Please provide the URL for the resource to be embedded.
<form method="post" action="resources.php?pq=addToGroup">
	Name: <input style="width:50%;" type="text" name="resource_name" value="" /><br/>
	URL: <input style="width:50%;" type="text" name="resource_url" /><br/>
	<input type="hidden" name="gid" value="<?php echo $_GET['gid']; ?>" />
	<input type="submit" value="Submit" />
</form>