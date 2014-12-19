<script type="text/javascript" src="/scripts/ckeditor/ckeditor.js"></script>
<?php
	$eid = $_GET['eid'];
	$q = 'SELECT * FROM events WHERE id="' . $eid . '"';
	$result = sql_execute($q);
	$data = sql_get($result);
?>
<?php
if(isset($eid)){
echo '<form method="POST" action="index.php?aq=upd_evnt&eid=' .$eid .'">';
}else{
echo '<form method="POST" action="index.php?aq=add_new_event">';
}
?>
<div style="border:1px solid; padding: 5px;">
<table>
<tr>
<td>Event name: </td>
<td><input type="text" name="eventName" value="<?php
	if(isset($eid)){echo $data['NAME'];}
?>" /></br></td>

</tr>
<tr>
<td>Description:</td><td><textarea type="text" name="eventDescription"><?php if(isset($eid)){echo $data['DESCRIPTION'];} ?></textarea></br></td>
</tr>
<tr>
<td>Code:</td><td><input type="text" name="eventCode" value="<?php if(isset($eid)){echo $data['CODE'];} ?>" /></br></td>
</tr>
</table>
</div>
<?php
	buildPermissionsForm();
?>
<br />
<input type="submit" value="Submit" />
</form>

<script>
    window.onload = function() {
        CKEDITOR.replace( 'courseIntroContent' );
        CKEDITOR.replace( 'courseDescription' );
		CKEDITOR.config();
    };
</script>