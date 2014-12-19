<form class="centerfloat" method="post" action="index.php?aq=module_settings_update&mid=<?php echo $_GET['mid'];?>">
<?php


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