<?php
	$courseID = $_GET['id'];
	if(isUserRegisteredForCourse($_SESSION['userID'],$courseID)){
	$query = 'SELECT * FROM courses WHERE id="' . $courseID . '"';
	$result = sql_execute($query);
	
	$data = sql_get($result);
	echo print_h2($data['NAME']);
br();
	echo $data['HTML_CONTENT'];
	br();
	$xmlDoc = new DOMDocument;
	
		$rootNode = $xmlDoc->loadXML($data['ARTICLES']);
		$rootNode = $xmlDoc->documentElement;
		
		foreach($rootNode->childNodes as $item){
				if($item->hasAttributes()){
				foreach($item->attributes as $attr){
				$queryArt = 'SELECT * FROM articles WHERE id="' . $attr->value . '" AND published_status="1"';
				$resultArt = sql_execute($queryArt);
				$articleData = sql_get($resultArt);
					echo "<a href=\"index.php?action=article&id=" . $attr->value ."&cid=" . $courseID . " \">" . $articleData['NAME'] . "</a>";
					br();
					}
				}
				}
	}else{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?uq=reg_course&cid=' . $courseID . '">';
		
	}
?>