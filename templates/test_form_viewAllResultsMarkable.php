<?php
/*
 * @author Stephan Pieterse
 * */
	$sqlquery = "SELECT * FROM testresults WHERE marked='0' ORDER BY name ASC";
	$sqlresult = sql_execute($sqlquery);
	
	if(!sql_numrows($sqlresult) > 0){
		echo "No markable tests found.";
	}else{
		
	echo '<table class="admin_view_table centerfloat">';
	while($rowdata = sql_get($sqlresult)){
		echo '<tr>';
		echo '<td>' . $rowdata['NAME'] . '</td>';
		
		$sq = "SELECT name FROM members WHERE id='" . $rowdata['STUDENT'] . "' LIMIT 1";
		$sr = sql_execute($sq);
		$sd = sql_get($sr);
		
		echo '<td>' . $sd['name'] . '</td>';
		//echo $rowdata['STUDENT'];
		if(check_user_permission("mark_result")){
		echo "<td><a href=\"tests.php?f=admin_markTest&rid=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "tick.png\" alt=\"Mark\"/></a></td>";
		//echo "<td><a target=\"_blank\" id=\"a_admin_mark_result\" href=\"index.php?action=admin_automark_result&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "computer_go.png\" alt=\"Automark\"/></a></td>";
		echo "<td><a href=\"tests.php?q=deleteResult&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a></td>";
		}
		echo "</tr>";
	}
	echo '</table>';
	}
?>
