<?php
//function displayArticle($articleID, $courseID = "0"){
	$articleID = makeSafe($_GET['id']);
	$courseID = isset($_GET['cid']) ? makeSafe($_GET['cid']) : '0';
	$query = 'SELECT * FROM articles WHERE id="' . $articleID . '"';
	$result = sql_execute($query);
	$data = sql_get($result);
	sidebarIndex($courseID, $data['HTML_CONTENT']);
	
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($data['PAGES']);
	$rootNode = $xmlDoc->documentElement;
	
	echo '<div class="mainArticle">';
	echo print_h2($data['NAME']);
	br();
	echo $data['HTML_CONTENT'];
	
	$pnm = 1;
	foreach($rootNode->childNodes as $child){
	switch($child->tagName){
		case 'page':
		$pid = $child->getAttribute('id');
				$q = "SELECT * FROM pages WHERE id='$pid' LIMIT 1";
				$r = sql_execute($q);
				$d = sql_get($r);
								
				$link = '<a href="index.php?uq=viewPage&pnm=' . $pnm . '&aid=' . $articleID .'">' . $d['NAME'] . '</a><br/>';
				echo $link;
				$pnm++;
				
			break;
			
		case 'resource':
			$resurl = $child->getAttribute('url');
			$resname = $child->getAttribute('name');
			
				$resurl = urldecode($resurl);
				if(strpos($resurl,'resource_view.php') !== false){
				$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $resurl . ' "> ' . $resname . '</a><br/>';
				echo $link;
				}else{
				$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . urlencode($resurl) . '&ref=' . urlencode(selfURL()) . '"> ' . $resname . '</a><br/>';
				echo $link;	
				}
			break;
	}
	}
	echo '</div>';
	echo '<br class="clear" />';
?>
