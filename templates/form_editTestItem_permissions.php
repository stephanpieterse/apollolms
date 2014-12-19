
<form method="post" action="index.php?action=set_test_permissions&id=<?php echo $id; ?>" >
<?php
buildPermissionsForm();
?>
<br />
<input type="submit" value="Change Permissions" />
</form>