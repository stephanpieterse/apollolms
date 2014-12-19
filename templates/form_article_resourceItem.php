Please provide the URL for the resource to be embedded.
<form method="post" action="index.php?aq=add_article_res&aid=<?php echo $_GET['aid']; ?>">
	Name: <input style="width:50%;" type="text" name="resource_name" value="" /><br/>
	URL: <input style="width:50%;" type="text" name="resource_url" /><br/>
	<input type="submit" value="Submit" />
</form>