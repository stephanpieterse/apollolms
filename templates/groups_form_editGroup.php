<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	if(isset($_GET['gid'])){
	$gid = makeSafe($_GET['gid']);
	$q = "SELECT * FROM groupslist WHERE id='$gid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	}
	else{
		$gid = false;
	}
?>
<?php
if($gid == false){
	echo' <form name="newGroup" method="post" action="groups.php?pq=addGroup">';
}else{
	echo '<form name="newGroup" method="post" action="groups.php?pq=updateGroup">';
	echo '<input type="hidden" name="gid" value="' . $gid . '" />';
}
?>
<label for="groupName">Group Name</label>
<input type="text" id="groupName" name="groupName" value="<?php if($gid != false){echo $rd['NAME'];}?>"/>
<br />
<label for="groupDescription">Description</label>
<textarea type="textbox" id="groupDescription" name="groupDescription">
<?php if($gid != false){echo $rd['DESCRIPTION'];}?>
</textarea>

<br />
<!--
<label for="groupType">Group Type</label>
<select id="groupType" name="groupType">
<?php
/**
		$query = 'SELECT * FROM groups_types';
		$result = sql_execute($query);
		
		while ($row = sql_get($result)){
			echo "<option ";
			if($gid != false && $rd['GROUPTYPE'] == $row['NAME']){
				echo "selected";
			}
			echo ">";
			echo $row['NAME'];
			echo "</option>";
		}	
*/
?>
</select>
-->

<br />
<label for="groupClosed">Closed Group</label>
<select id="groupClosed" name="closed">
<?php
if($gid != false){
if($rd['CLOSED'] == 0){
	echo '<option selected>No</option>';
	echo '<option>Yes</option>';
}else{
	echo '<option selected>Yes</option>';
	echo '<option>No</option>';
}
}else{
	echo '<option>No</option>';
	echo '<option>Yes</option>';
}
?>
</select>

<label for="groupAutoJoin">Auto Join</label>
<select id="groupAutoJoin" name="autojoin">
<?php
if($gid != false){
if($rd['AUTOJOIN'] == 0){
	echo '<option selected>No</option>';
	echo '<option>Yes</option>';
}else{
	echo '<option selected>Yes</option>';
	echo '<option>No</option>';
}
}else{
	echo '<option>No</option>';
	echo '<option>Yes</option>';
}
?>
</select>
<br/><br/>
<span class="bold">Group parents:</span>
<br/>
<?php
	if(isset($gid)){
	buildGroupsForm($gid,$rd['PARENTS']);
	}else{
	buildGroupsForm();
	}
?>

<br />
<input type="submit" value="Update Group"/>
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'groupDescription' );
		CKEDITOR.config();
    };
</script>
