<?php
	if(check_user_permission("help_view")){
	$query = "SELECT * FROM help";
	$result = sql_execute($query);
	
	if(sql_numrows($result) == 0){
		echo "There are no help messages to display.";
	}
	
	while($row = sql_get($result)){
		echo $row['DATE'];
		echo " - ";
		echo '<a href="index.php?action=admin_view_user&var='.$row['USER'] .'" >' .$row['USER'] . '</a>';
		echo " - ";
		echo $row['HELPMSG'];
				
		if(check_user_permission("help_remove")){
		echo "<a href=\"index.php?action=rem_helpmsg&msgid=" . $row['ID'] ." \"> <img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
		echo "<br />";
		}
		}
	}
?>