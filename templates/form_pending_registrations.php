<?php
	$q = "SELECT * FROM course_registrations ORDER BY uid ASC";
	$r = sql_execute($q);

	while($d = sql_get($r)){
		$pendreq = $d['PENDING'];
		
		if($pendreq == ""){
			$pendreq = "<pending></pending>";
			echo 'There are no pending requests.';
			return false;
		}
		
		if(!xmlHasChildren($pendreq)){
			echo 'There are no pending requests.';
			return false;
		}
		$uq = "SELECT name FROM members WHERE id='" . $d['UID'] . "' LIMIT 1";
		$ur = sql_execute($uq);
		$ud = sql_get($ur);
		
		br();
		echo print_bold($ud['name']) . ' ';
		
		$xmlDoc = new DOMDocument;
		$xmlDoc->loadXML($pendreq);
		$rootNode = $xmlDoc->documentElement;
		
		foreach($rootNode->childNodes as $item){
			$curCID = $item->getAttribute('cid');
			$reference = 'Reference Number: ' . $item->getAttribute('purchaseRef');
			$cq = "SELECT name FROM courses WHERE id='$curCID'";
			$cr = sql_execute($cq);
			$cd = sql_get($cr);
			$link = $cd['name'] . '<a href="courses.php?q=activateRequest&cid=' . $curCID . '&uid=' . $d['UID'] . '"> Activate</a>';
			echo $link;
			echo $reference;
			br();
		}
	
	}
?>
