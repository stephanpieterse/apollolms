<!--
BY STEPHAN PIETERSE
THIS FORM IS THE BASIC TEMPLATE FOR DATA WHEN EDITING EXISTING USERS IN THE DATABASE
-->
<?php
	$monthsNames = array(1=>'January','February','March','April','May','June','July','August','September','October','November','December');

	$q = "SELECT * FROM roles";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		$roles[$r['ID']] = $r['ROLENAME'];
		$rolehidden[$r['ID']] = $r['HIDDEN'];
	}

	$query = 'SELECT * FROM members WHERE id="' . $_GET['uid'] . '"';
	$result = sql_execute($query);
	if((sql_numrows($result)) != 1){
		echo "User cannot be found. <br />";
		echo '<a href="index.php">Return Home</a>';
	}else{
	$row = sql_get($result);
	}?>

	<?php
	echo '<form name="editUser" method="post" action="users.php?pq=updateUserItem">';
//	echo '<form name="form1" method="post" action="index.php?action=addNewUser&login=<?php echo $shouldLogin; 
	?>
	<input type="hidden" name="uid" value="<?php echo $_GET['uid'] ?>" />
	<td>
	<table class="centerfloat">
	<tr>
	<td colspan="3"><strong>Member Details</strong></td>
	</tr>
	<tr>
	<td>Date Registered:</td>
	<td><?php $times = explode('-',$row['REGDATE']); 
		echo $formattedDate = date("F d, Y", mktime(0,0,0,$times[1],$times[2],$times[3]));
	?></td>
	</tr>
	
	<tr>
	<td>Full Name:</td>
	<td><input name="name" type="text" id="name" value="<?php echo $row['NAME'] ?>" /></td>
	</tr>
	<tr>
	<td>E-Mail Address:</td>
	<td><input name="emailad" type="text" id="emailad" value="<?php echo $row['EMAIL'] ?>" /></td>
	</tr>
	<tr>
	<td>Contact Number:</td>
	<td><input name="contactnum" type="text" id="contactnum" value="<?php echo $row['CONTACTNUM'] ?>" /></td>
	</tr>	
	<tr>
	<td>Gender:</td>
	<td><select name="gender"><option <?php if($row['GENDER'] == 0){echo 'selected';}?>>Male</option><option <?php if($row['GENDER'] == 1){echo 'selected';}?>>Female</option></select></td>
	</tr>	
	<tr>
	<td>Role:</td>
	<td>Current role:<?php echo $roles[$row['ROLE']]; ?><br/>
	<?php
	if(check_user_permission('user_modify',true)){
		$curRole = $row['ROLE'];
		echo '<select name="role" id="role">';
		//$sqlquery = "SELECT * FROM roles WHERE hidden=0";
		//$result = sql_execute($sqlquery);
		
		foreach($roles as $key=>$val){//($option = sql_get($result)){
			$isIinList = false;
			$fullstring = "<option ";
		if(isset($roles[$curRole]) && ($key == $curRole)){
				$fullstring .= ' selected="selected" ';
				$isIinList = true;
				$fullstring .= ">" . $roles[$curRole] . "</option>";
				echo $fullstring;
			}
	
			if($isIinList == false && ($rolehidden[$key] == 0)){
				$fullstring = '<option>'. $roles[$key] . "</option>";
				echo $fullstring;
			}
		}
	}
		echo '</select>';
	?>
	</td>
	<td></td>
	</tr>
<tr>
<td>Birthdate:</td>
<td>
<?php
	$bdatesplit = explode('-',$row['BIRTHDATE']);
?>
Year:<select name="birthy"><?php for($x = 2008; $x > 1940; $x--){  $opt = '<option'; if($bdatesplit[0] == $x){$opt .= ' selected ';} $opt.='>' . $x . '</option>'; echo $opt;} ?></select>
Month:<select name="birthm"><?php for($x = 1; $x <= 12; $x++){  $opt = '<option';if($bdatesplit[1] == $x){$opt .= ' selected ';} $opt .= ' value="' . $x. '">' . $monthsNames[$x] . '</option>'; echo $opt;} ?></select>
Day:<select name="birthd"><?php for($x = 1; $x <= 31; $x++){  $opt = '<option'; if($bdatesplit[0] == $x){$opt .= ' selected ';} $opt.='>' . $x . '</option>'; echo $opt;} ?></select>
</td>
</tr>
	<tr>
	<td>&nbsp;</td>
	<td><input type="submit" name="Submit" value="Update User"></td>
	</tr>
	</table>
	</td>
</form>