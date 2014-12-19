<form method="POST" action="index.php?action=addToGroup">
	<?php
		if(check_user_permission('join_closed_groups')){
		$sqlquery = "SELECT * FROM groupslist";
		}else{
		$sqlquery = "SELECT * FROM groupslist WHERE closed='0'";
		}
		$result = sql_execute($sqlquery);
		
		while($row = sql_get($result)){
			if(count($groupSets[$row['GROUPTYPE']] >= 1)){
				$groupSets[$row['GROUPTYPE']][count($groupSets[$row['GROUPTYPE']]) + 1] = $row['ID'];
			}else{
				$groupSets[$row['GROUPTYPE']][0] = $row['ID'];
			}	
		}
		
		$q = "SELECT * FROM members WHERE id='" . $_SESSION['userID'] . "' LIMIT 1";
		$r = sql_execute($q);
		$udata = sql_get($r);
		$udata = $udata['GROUPS'];

		while (list($key, $value) = each($groupSets)){
				echo $key . " ";
				br();		
				
				foreach($groupSets[$key] as $item){
				$checked = '';
				//if(isUserInGroup_XML($udata, $item)){
				if(isUserInGroup($_SESSION['userID'], $item)){
					$checked = 'checked';
				}
				echo '<input id="' . $key .'-' . $item . '" type="checkbox" name="add-group-' . $item . '" ' . $checked . '/>' ;
				echo '<label for="' . $key . '-' . $item . '">' . $item .'</label>';
	
			}
				
				/*echo '<select name="' . $key . '">';
				echo "<option>-NONE-</option>";	
			foreach($groupSets[$key] as $item){
				echo "<option>" . $item . "</option>";	
			}
			echo "</select>"; */
			br();
		}
	?>
<br />
<input type="submit" name="submit" value="Join Group" />
</form>
