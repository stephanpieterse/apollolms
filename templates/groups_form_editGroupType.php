<?php
if(!check_user_permission('grouptype_modify')){
	return false;
	}

if(isset($_GET['id'])){
	$gtid = $_GET['id'];
	$query = 'SELECT * FROM groups_types WHERE id="' . $gtid . '"';
	$result = sql_execute($query);
	$row = sql_get($result);
}
?>
<?php if(isset($gtid)){
	echo '<form method="post" action="index.php?action=update_groupType&id=' . $gtid . ' ">';
}else{
	echo '<form method="post" action="index.php?action=insertNewGroupType">';
}
?>
Name: 
	<input type="text" name="name" value="<?php if(isset($gtid)){echo $row['NAME'];} ?>"/>
	<br/>
<br/>
<textarea rows="5" cols="250" type="text" id="description" name="description" ><?php if(isset($gtid)){echo $row['DESCRIPTION'];} ?></textarea>
<br/>
<input type="submit" value="<?php if(isset($gtid)){echo 'Update';}else{echo 'Insert';} ?>" />
</form>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'description' );
		CKEDITOR.config();
    };
</script>