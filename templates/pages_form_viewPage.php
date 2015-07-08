<?php
/*
*	@author Stephan Pieterse
*/
	$pnm = $_GET['pnm'];
	$aid = isset($_GET['aid']) ? $_GET['aid'] : 0;
	$cid = isset($_GET['cid']) ? $_GET['cid'] : 0;
	
	$query = 'SELECT * FROM articles WHERE id="' . $aid . '" LIMIT 1';
	$result = sql_execute($query);
	$data = sql_get($result);

	$xmldata = $data['PAGES'];
	$pid = getPageIDFromXML($pnm, $xmldata);
	
	$hasNext = xmlHasNextNode($pnm, $xmldata);
	$hasPrev = xmlHasPrevNode($pnm, $xmldata);
	
	$query = "SELECT * FROM pages WHERE id='" . $pid . "' LIMIT 1";
	$result = sql_execute($query);
	$data = sql_get($result);
	sidebarIndexPages($aid, $data['HTML_CONTENT']);
	
	echo '<div class="mainArticle">';
	echo $data['NAME'];
	echo '<br/>';
	echo $data['HTML_CONTENT'];
	echo '</div>';
	echo '<br class="clear" />';
	
	print_page_footer($hasPrev, $hasNext);

