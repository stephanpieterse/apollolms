<?php 
	$smarty = new Smarty;

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
				}
	
	$sqlArr = implode("','",$permName);
	$q = "SELECT * FROM role_permissions WHERE permission IN ('" . $sqlArr . "')";
	$d = sql_execute($q);
	
	$cc = 0;
	while($r = sql_get($d)){
		$rdata[$cc]['NAME'] =  $r['NAME'];
		$rdata[$cc]['DESCRIPTION'] = $r['DESCRIPTION'];
		$cc++;
	}

	$smarty->assign('rdata',$rdata);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);

