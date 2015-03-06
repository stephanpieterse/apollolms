<?php
	$courseID = $_GET['cid'];
	$query = 'SELECT * FROM courses WHERE id="' . $courseID . '"';
	$result = sql_execute($query);

	$data = sql_get($result);
	echo print_h2($data['NAME']);
	echo '<div class="css-treeview"><ul>';

	$xmlDoc = new DOMDocument;
	
		$rootNode = $xmlDoc->loadXML($data['ARTICLES']);
		$rootNode = $xmlDoc->documentElement;
		
		foreach($rootNode->childNodes as $item){
			switch($item->tagName){
				case 'article':
				if($item->hasAttributes()){
					foreach($item->attributes as $attr){
						$queryArt = 'SELECT * FROM articles WHERE id="' . $attr->value . '"';
						$resultArt = sql_execute($queryArt);
						$articleData = sql_get($resultArt);
						$link = '<img src="' . ICONS_PATH . 'book.png" alt="Article"/>' . "<a href=\"articles.php?f=displayArticle&id=" . $attr->value ."&cid=" . $courseID . " \">" . $articleData['NAME'] . "</a>";
						echo '<li>' . $link . '</li>';
						br();
					}
				}
				break;
				
				case 'resource':
					$resd['resource_url'] = $item->getAttribute('url');
					$resd['resource_name'] = $item->getAttribute('name');
					
					$res = new Resource_Handler();
					$res->importResource($resd);
					echo $res->resourceLink_view();
				//	$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a target="_blank" href="resource_view.php?f=' . $resurl . ' ">' . $resname . '</a><br/>';
			//		echo '<li>' . $link . '</li>';
				break;
			}
		}
		echo '</ul></div>';
?>
