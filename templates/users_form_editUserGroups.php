<?php
	if(isset($_GET['uid'])){
	$uid = makeSafe($_GET['uid']);
	$q = "SELECT * FROM members WHERE id='$uid'";
	$r = sql_execute($q);
	$rd = sql_get($r);
	}else{
		return false;
	}
	echo '<form name="editGroups" method="post" action="users.php?pq=updateGroupsOnly">';
	echo '<input type="hidden" name="uid" value="' . $uid . '" />';
?>
<a href="users.php?f=viewUser$uid=<?php echo $uid; ?>" ><?php echo $rd['NAME'];?></a>
<br />
<span class="bold">Groups:</span>
<br/>
<?php
	buildGroupsForm($uid,$rd['GROUPS']);
?>
<br/>
<input type="submit" value="Update Groups"/>
</form>
