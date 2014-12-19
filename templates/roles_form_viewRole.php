<?php 
	$rid = $_GET['rid'];
	$q = "SELECT * FROM roles WHERE id='$rid' LIMIT 1";
	$r = sql_execute($q);
	$r = sql_get($r);
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($r['PERMISSIONS']);
	$rootNode = $xmlDoc->documentElement;
	
	foreach($rootNode->childNodes as $child){
			if($child->hasAttributes()){
			foreach($child->attributes as $attr){
					//echo $attr->name;
				//	echo $attr->value;
					}
					}
						//echo $child->tagName;
						$permName[] = $child->tagName;
						
					//	echo $child->nodeValue;
						//br();
				}
	
	$sqlArr = implode("','",$permName);
	$q = "SELECT * FROM role_permissions WHERE permission IN ('" . $sqlArr . "')";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		echo '<p>';
		echo print_bold($r['NAME']);
		br();
		echo $r['DESCRIPTION'];
		br();
		echo '</p>';
	}
?>