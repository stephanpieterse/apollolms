<?php
	$id = $_GET['id'];

	$query = "SELECT * FROM tests WHERE id='$id'";
	$result = sql_execute($query);

	$row = sql_get($result);
	echo print_bold("NAME: ");
	echo $row['NAME'];
	br();
	echo print_bold("DESCRIPTION: ");
	echo $row['DESCRIPTION'];
	br();
	echo $row['CODE'];
	br();
	echo $row['ACCESS'];
	br();
	
	echo print_bold("Permissions:");
	br();
	$xmlDoc = new DOMDocument;
	$xmlDoc->loadXML($row['ACCESS']);
	$rootNode = $xmlDoc->documentElement;
		foreach($rootNode->childNodes as $child){
			switch($child->nodeName){
						case 'public':
						echo "Public Access";
						$thisType = 'public';
						break;
						
						case 'group':
						echo "Group Access:";
						$thisType = 'group';
						break;
						}
			echo " ";
			if($child->hasAttributes()){
			foreach($child->attributes as $attr){
				if($attr->name == 'id'){
					switch($thisType){
						case 'group':
						echo retrieve_groupName($attr->value);
						break;
					}
					}
					echo "<br />";
					}	
				}
			}
	br();	
	
	echo print_bold("Questions:");
	br();
	
	$xmlDoc = new DOMDocument;
	$xmlDoc->loadXML($row['QUESTIONS']);
	$rootNode = $xmlDoc->documentElement;
	if(($rootNode->childNodes->length) > 0){
		echo '<table class="admin_view_table">';
		
	$x=1; //counter for moving items;
	foreach($rootNode->childNodes as $child){
			if($child->hasAttributes()){
				echo '<tr>';
				echo '<td>';
			foreach($child->attributes as $attr){
					if(($attr->name) == "id"){ $qid = $attr->value; }
					echo '(' . $attr->name .')';
					echo " = ";
					echo $attr->value;
					echo " ";
					}	
				}
				echo '</td>';
				echo "<td><img src=\"icons/silk/icons/pencil.png\" alt=\"Edit\"/></td>";
				echo "<td><a href=\"index.php?aq=mod_test_rmQuestion&tid=" . $row['ID'] ."&qid=" . $qid ." \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Remove\"/></a><td>";
				echo "<td><a href=\"index.php?aq=mv_tstQ&id=" . $row['ID'] ."&dir=up&qid=".$x ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
			echo "<a href=\"index.php?aq=mv_tstQ&id=" . $row['ID'] ."&dir=down&qid=" .$x ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a></td>";
				br();
				echo '</tr>';
			}
		echo '</table>';
	}else{
		echo "There are no questions set for this test.";
	}
	br();
	if(check_user_permission('test_modify')){
		echo "<a href=\"tests.php?f=editItem_permissions&id=" . $row['ID'] ." \"> Edit Permissions <img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a>";
		br();
		echo "<a href=\"tests.php?f=editItem_questions&id=" . $row['ID'] ." \"> Add a Question <img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a>";
		br();
		echo "<a href=\"tests.php?f=editItem_prereq&tid=" . $row['ID'] ." \">Edit Prequisites<img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/></a>";
	}
?>
