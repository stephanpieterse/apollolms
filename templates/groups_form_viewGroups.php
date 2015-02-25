<?php
	$smarty = new Smarty();

	$uid = $_SESSION['userID'];
	$q = "SELECT * FROM groupslist";
	$r = sql_execute($q);

	$xi = 0;
	while($d = sql_get($r)){
		if(isUserInGroup($uid,$d['ID']) || isUserInGroupAdminID($uid,$d['ID'])){
			$itemData[$xi]['NAME'] = $d['NAME'];
			$itemData[$xi]['ID'] = $d['ID'];
			$itemData[$xi]['DESCRIPTION'] = $d['DESCRIPTION'];
			$xi++;
		}
	}
		$smarty->assign('itemData',$itemData);
                $tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
                $smarty->display(TEMPLATE_PATH . $tplName);

/*
		$groupQuery = "SELECT GROUPS FROM members WHERE id=\"" . $_SESSION['userID'] . "\"";
		$mqResult = sql_execute($groupQuery);
			while($row = sql_get($mqResult)){
				//include($row['GROUPS']);
				$xmlDoc = new DOMDocument();
				$xmlDoc->loadXML($row['GROUPS']);
				$rootNode = $xmlDoc->documentElement;
				
				if(!xmlHasChildren($row['GROUPS'])){
					echo 'You are currently not part of any groups :(';
					return false;
				}
				
				foreach($rootNode->childNodes as $item){
				if($item->hasAttributes()){
					$gid = $item->getAttribute('id');
					$q = "SELECT * FROM groupslist WHERE id='$gid' LIMIT 1";
					$r = sql_execute($q);
					$dat = sql_get($r);
				//	echo $attr->name;
					echo '<a href="groups.php?f=viewGroup&gid=' . $gid .' ">' . $dat['NAME'] . " </a>";
					echo " - ";
					echo $dat['DESCRIPTION'];
					br();
					
				}
			}
		}

*/
?>
