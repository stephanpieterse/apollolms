<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<form method="post" action="index.php?action=insertNewGroupType">
	Name: 
	<input type="text" name="name" />
	<br/>
	Description: <br/>
	<textarea type="text" name="description" cols="100" rows="5"></textarea><br/>
	<br/>
<input type="submit" value="Create New Group Type" />
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'description' );
		CKEDITOR.config();
    };
</script>