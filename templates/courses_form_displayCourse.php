<?php
/**
 *  
 * Displays the content of the selected course;
 * 
 */
	$courseID = $_GET['cid'];
	
	if((!isset($_GET['uid'])) || ($_GET['uid'] != -1)){
		$userID = $_SESSION['userID'];
		$normUser = true;
	}
	
	if($userID == -1){
		$normUser = false;
	}
	
	if($normUser == true && !isUserRegisteredForCourse($userID,$courseID)){
		page_redirect('courses.php?f=register&cid=' . $courseID);
		return false;
	}
	
	if(!userHasCourseTime($userID,$courseID)){
		echo 'The course is not yet / no longer available, or your time for this course has expired.'; 
		return false;
	}
	
	$query = "SELECT * FROM courses WHERE id='" . $courseID . "' LIMIT 1";
	$result = sql_execute($query);
	
	$data = sql_get($result);
	echo print_h2($data['NAME']);
br();
	echo $data['HTML_CONTENT'];
	br();
	$xmlDoc = new DOMDocument;
	
		if($data['ARTICLES'] == ''){
			$articlesData = '<empty></empty>';
		}else{
			$articlesData = $data['ARTICLES'];
		}
		$rootNode = $xmlDoc->loadXML($articlesData);
		$rootNode = $xmlDoc->documentElement;
		
		$nodeID = 1;
		foreach($rootNode->childNodes as $item){
			
			if($item->tagName == 'article'){
				if($item->hasAttributes()){
				foreach($item->attributes as $attr){
				$queryArt = 'SELECT NAME FROM articles WHERE id="' . $attr->value . '" AND published_status="1" LIMIT 1';
				$resultArt = sql_execute($queryArt);
				$articleData = sql_get($resultArt);
					echo '<img src="' . ICONS_PATH . 'book.png" alt="Article"/>' . "<a href=\"articles.php?f=displayArticle&id=" . $attr->value ."&cid=" . $courseID . " \"> " . $articleData['NAME'] . "</a>";
					br();
					}
				}
				}

			if($item->tagName == 'resource'){
				if($item->hasAttributes()){
					$resurl = $item->getAttribute('url');
					$resname = $item->getAttribute('name');
					
					$resurl = urldecode($resurl);
					if(strpos($resurl,'resource_view.php') !== false){
					$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="' . $resurl . ' "> ' . $resname . '</a><br/>';
					echo $link;
					}else{
					$link = '<img src="' . ICONS_PATH . 'brick.png" alt="Resource"/><a href="resource_view.php?f=' . urlencode($resurl) . '&ref=' . urlencode(selfURL()) . '"> ' . $resname . '</a><br/>';
					echo $link;	
					}
				}
			}
		$nodeID++;
		}
	//modules_plugin_feature('user_course_view_single', $dataarr);
?>
