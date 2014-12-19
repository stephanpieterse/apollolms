<?php
	$q = "SELECT VALUE FROM site_settings WHERE item='default_homepage' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
?>

<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<form method="post" action="/sitesettings.php?update=default_homepage">
<textarea type="text" id="defaultSitePage" name="defaultSitePage"><?php echo $r['VALUE'];?></textarea>
<input type="submit" value="Update" />
</form>
<script>
		window.onload = function() {
        CKEDITOR.replace( 'defaultSitePage' );
		CKEDITOR.config();
    };
</script>