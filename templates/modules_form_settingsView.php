<form class="centerfloat" method="post" action="modules.php?pq=settingsUpdate">
<?php
	echo '<input type="hidden" name="mid" value="' . $_GET['mid']  . '" />';

	buildLocationsForm();

	$q = "SELECT PLUGINS,PERMISSIONS FROM modules WHERE id='".$_GET['mid']."' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);

	buildPluginSectionsForm(explode(',',$d['PLUGINS']));	

	buildPermissionsForm($d['PERMISSIONS']);
?>
<br/>
<input type="submit" value="Update" name="submit" />
</form>
