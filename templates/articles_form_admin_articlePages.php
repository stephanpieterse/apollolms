<?php
	
	$aid = $_GET['aid'];
	$q = "SELECT * FROM articles WHERE id='$aid' LIMIT 1";
	$r = sql_execute($q);
	$data = sql_get($r);
	
	$smarty = new Smarty;
		$xmlDoc = new DOMDocument();
		if($data['PAGES'] == ''){
			$tempXML = "<root></root>";
		}else{
			$tempXML = $data['PAGES'];
		}
		
		$headArray['AID'] = $aid;
		$headArray['COURSE'] = $data['COURSE'];
		
		$rootNode = $xmlDoc->loadXML($tempXML);
		$rootNode = $xmlDoc->documentElement;
		$x = -1;
		
		$curI = 0;
		foreach($rootNode->childNodes as $child){
		$x++;
		echo '<tr>';
		switch($child->tagName){
			case 'page':
				if($child->hasAttributes()){
					$artID = $child->getAttribute('id');
					
					$artName = $child->getAttribute('name');
					$aQ = "SELECT * FROM pages WHERE id='" . $artID . "' LIMIT 1";
					$aR = sql_execute($aQ);
					$adata = sql_get($aR);
						$dataArray[$curI]['NAME'] = '<a target="_blank" href=?uq=viewPage&pnm=' . $x . '&aid=' . $aid . '>' . $adata['NAME'] . '</a>';
						$dataArray[$curI]['LINKS'][] = '<a href="pages.php?f=mod_page&pid=' . $artID . '"><img src="' . ICONS_PATH . 'pencil.png" alt="Edit"/> Edit</a>';
						$dataArray[$curI]['LINKS'][] =  "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=up&pid=". $x ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
						$dataArray[$curI]['LINKS'][] =  "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=down&pid=" . $x ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
						$dataArray[$curI]['LINKS'][] =  "<a href=\"index.php?confirm&aq=rm_page&pid=" . $artID . '&aid=' . $aid . " \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
					
				}else{
					echo 'Invalid or corrupt data, please contact your site or course administrator';
				}
				break;
					
				case 'resource':
					if($child->hasAttributes()){
							$resname = $child->getAttribute('name');
							$resurl = $child->getAttribute('url');
							$resid = $child->getAttribute('id');
							$resitem = new Resource_Handler;
							$resitem->importResource(array('resname'=>$resname,'resurl'=>$resurl,'resid'=>$resid));
							$reslink = $resitem->resourceLink_view();
								$dataArray[$curI]['NAME'] = $reslink . $resname;
								$dataArray[$curI]['LINKS'][] = '<a href="articles.php?f=editResource&aid=' . $aid . '&resid=' . $resid . '"><img src="' . ICONS_PATH . 'pencil.png" alt="Edit"/> Edit</a>';
								$dataArray[$curI]['LINKS'][] = "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=up&pid=". $resid ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
								$dataArray[$curI]['LINKS'][] = "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=down&pid=" . $resid ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
								$dataArray[$curI]['LINKS'][] = "<a href=\"articles.php?q=removeResource&resid=" . $resid . '&aid=' . $aid . " \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
								}
					break;
				}
		$curI++;
	} // end foreach
		
	$smarty->assign('pageData',$dataArray);
	$smarty->assign('headerData',$headArray);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
	echo tooltip("View, edit, move, or delete pages from this article.", "article_pages");
?>
