<script type="text/javascript" src="<?php echo SCRIPTS_PATH; ?>ckeditor/ckeditor.js"></script>
<?php
	if(isset($_GET['eid'])){
	$eid = $_GET['eid'];
	$q = 'SELECT * FROM events WHERE id="' . $eid . '"';
	$result = sql_execute($q);
	$data = sql_get($result);
	}
?>
<?php
if(isset($eid)){
echo '<form method="POST" action="events.php?pq=updateEvent">';
echo '<input type="hidden" name="eid" value="'.$eid.'" />';
}else{
echo '<form method="POST" action="events.php?pq=addEvent">';
}
?>
<?php
/**
if(isset($eid)){
	echo '<input type="hidden" name="eid" value="' . $eid . '" />';
}
*/
?>
<div style="border:1px solid; padding: 5px;">
<table>
<tr>
<td>Event name: </td>
<td><input type="text" name="eventName" value="<?php
	if(isset($eid)){echo $data['NAME'];}
?>"/>
</td>
</tr>
<tr>
<td>
Description:</td><td><textarea type="text" name="eventDescription"><?php if(isset($eid)){echo $data['DESCRIPTION'];} ?></textarea></td>
</tr>
<tr>
<td>Code:</td><td><input type="text" name="eventCode" value="<?php if(isset($eid)){echo $data['CODE'];} ?>" /></br></td>
</tr>
</table>
Event HTML advertisement
<textarea type="text" name="eventHTML"><?php if(isset($eid)){echo $data['HTML_CONTENT'];} ?></textarea>
</div>
<?php
	buildPermissionsForm();
?>
<br />
<input type="submit" value="Submit" />
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'eventDescription' );
        CKEDITOR.replace( 'eventHTML' );
		CKEDITOR.config();
    };
</script>
