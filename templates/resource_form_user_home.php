<?php
	$q = "SELECT * FROM resources";
	$d = sql_execute($q);
	
	if(sql_numrows($d) == 0){
		echo 'There are no resources currently available';
	}
	
	$mq = "SELECT GROUPS FROM members WHERE id='". $_SESSION['userID'] ."' LIMIT 1";
	$md = sql_get(sql_execute($mq));
	
	$domdoc = new DOMDocument;
	$domdoc->loadXML($md['GROUPS']);
	$rootnode = $domdoc->documentElement;
	
	$allGroups = $rootnode->getElementsByTagName('group');
	foreach($allGroups as $i){
		$groupIDs[] = $i->getAttribute('id');
	}
	
	$anyResource = false;
	
	while($r = sql_get($d)){
		if(!isset($groupIDs)){
			continue;
		}
		foreach($groupIDs as $k=>$groupID){
			if(xmlHasSpecifiedNode($r['PERMISSIONS'], array('tagname'=>'group','id'=>$groupID))){
				$anyResource = true;
				//$resurl = urldecode($resurl);
				if(strpos($r['NAME'],'resource_view.php') !== false){
				$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $r['URL'] . ' "> ' . $r['NAME'] . '</a><br/>';
				echo $link;
				}else{
				$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . $r['URL'] . '&ref=' . selfURL() . '"> ' . $r['NAME'] . '</a><br/>';
				echo $link;	
			}	
		}
		}
	}

	if(!$anyResource && !sql_numrows($d) == 0){
		echo 'There are no resources currently available to you.'; 
	}
?>
