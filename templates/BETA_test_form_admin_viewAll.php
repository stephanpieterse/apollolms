<?php
	$sqlquery = "SELECT * FROM tests ORDER BY name ASC";
	$sqlresult = sql_execute($sqlquery);
	
	$html = new html_Templater(TEMPLATE_PATH . 'views/html/' . basename(__FILE__)'.html');
	
	$newdata = array('name'=>'td');
	$html->insertNewItem('td');	

	while($rowdata = sql_get($sqlresult)){
		echo "<tr>";
		echo '<td>' . $rowdata['NAME'] . '</td>';
		//if(check_user_permission("test_view")){
		//echo "<td><a target=\"_blank\" href=\"index.php?aq=admin_view_test&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "magnifier.png\" alt=\"View\"/></a></td>";
		//}
		if(check_user_permission("test_modify")){
		echo "<td><a target=\"_blank\" href=\"tests.php?f=modItem&id=" . $rowdata['ID'] ." \"> <img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a></td>";
		}
		if(check_user_permission("test_remove")){
		echo "<td><a href=\"index.php?confirm&aq=rem_test&id=" . $rowdata['ID'] . " \"> <img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a></td>";
		}
		echo "</tr>";
	}
	echo "</table>";

?>
