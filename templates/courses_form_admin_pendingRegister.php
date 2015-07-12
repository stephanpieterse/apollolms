<?php
	$smarty = new Smarty;
	$q = "SELECT * FROM course_registrations ORDER BY uid ASC";
	$r = sql_execute($q);

	while($d = sql_get($r)){
		$pendreq = $d['PENDING'];
		
		if($pendreq == ""){
			$pendreq = "<pending></pending>";
			//echo 'There are no pending requests.';
			continue;
		}
		
		if(!xmlHasChildren($pendreq)){
			//echo 'There are no pending requests.';
			continue;
			//return false
		}

		$uq = "SELECT name FROM members WHERE id='" . $d['UID'] . "' LIMIT 1";
		$ur = sql_execute($uq);
		$ud = sql_get($ur);
		
		$membername = $ud['name'];
		
		$xmlDoc = new DOMDocument;
		$xmlDoc->loadXML($pendreq);
		$rootNode = $xmlDoc->documentElement;
		
		$cc = 0;
		foreach($rootNode->childNodes as $item){
			$curCID = $item->getAttribute('cid');
			$reference[$cc] = 'Reference Number: ' . $item->getAttribute('purchaseRef');
			$cq = "SELECT name FROM courses WHERE id='$curCID'";
			$cr = sql_execute($cq);
			$cd = sql_get($cr);
			$link[$cc] = $cd['name'] . '<a href="courses.php?q=activateRequest&cid=' . $curCID . '&uid=' . $d['UID'] . '"> Activate</a>';
		}
		
		if(isset($references)){
				$smarty->assign('references',$reference);
				$smarty->assign('links',$link);
				$smarty->assign('membername',$membername);
				
				$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
				$smarty->display($tplName);
			}
			
	}
	
	
