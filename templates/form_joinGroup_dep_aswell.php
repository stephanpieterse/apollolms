<?php
	if(check_user_permission('join_closed_groups')){
		$sqlquery = "SELECT * FROM groupslist";
	}else{
		$sqlquery = "SELECT * FROM groupslist WHERE closed='0'";
	}
		$result = sql_execute($sqlquery);
	
		echo '<table class="centerfloat">';
		while($row = sql_get($result)){
		$link = "";
			echo '<tr><td>';
				echo '<a class="bold">' . $row['NAME'] . '</a>';
				echo '<br/>';
				echo $row['DESCRIPTION'];
				echo '</td>';
				echo '<td>';
				if(!isUserInGroupID($_SESSION['userID'], $row['ID'])){
					$link = '<a href="groups.php?q=addGroupRequest&gid=' . $row['ID'] . '&uid=' . $_SESSION['userID'] . '">';
					$link = $link . "REQUEST TO JOIN";
					$link = $link . '</a>';
					echo $link;
				}else{
					$link = '<a href="index.php?action=lst_inGroup&id=' . $row['ID'] . '">';
					$link = $link . "VIEW GROUP";
					$link = $link . '</a>';
					echo $link;
				}
				echo '</td>';
		}
		echo '</table>';
?>