<?php
	$smarty = new Smarty;
	
	$new = true;
	if(isset($_GET['rid'])){
	$new = false;
	$q = 'SELECT * FROM roles WHERE id="' . $_GET['rid'] . '"';
	$result = sql_execute($q);
	$data = sql_get($result);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($data['PERMISSIONS']);
	$rootNode = $xmlDoc->documentElement;
	}

	if($new){
		echo '<form class="roleForm" name="addRole" method="post" action="roles.php?pq=newRoleItem">';
	}else{
		echo '<form class="roleForm" name="editRole" method="post" action="roles.php?pq=updateRoleItem">';
		echo '<input type="hidden" name="rid" value="' . $_GET['rid'] . '" />';
	}

?>
Role Name:
<?php if($new){echo'<input name="rolename" id="rolename" type="text" value="role_name"/>';} else{echo print_bold($data['ROLENAME']);}  ?>
<!--<input name="rolename" id="rolename" type="text" value="<?php echo $data['ROLENAME']; ?>"/> -->
<br/>
Permissions:
<?php
	$query = 'SELECT * FROM role_permissions WHERE hidden="0"';
	$result = sql_execute($query);
	
	echo '<ul>';
	while($row = sql_get($result)){
	$checkStat = '';
	if(!$new){
		foreach($rootNode->childNodes as $child){
			if($child->nodeName == $row['PERMISSION']){
				$checkStat = ' checked="checked" ';
				break;
				}
			}
	}
		echo '<label for="' . $row['PERMISSION'] . '">';
		echo '<li>';
		echo '<input name="' . $row['PERMISSION'] . '" id="' . $row['PERMISSION'] . '" type="checkbox" ' . $checkStat . '/>'. print_bold($row['NAME']);
		echo '<br />';
		echo $row['DESCRIPTION'];
		echo '</li>';
		echo '</label>';
	}
	echo '</ul>';
?>
<br class="clear" />
<?php

	if($new){
		echo '<input type="submit" value="Create Role" />';
	}else{
		echo '<input type="submit" value="Update Role" />';
	}
	
	$smarty->assign('roledata',$dataArray);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
