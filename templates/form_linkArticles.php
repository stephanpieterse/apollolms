<?php
/*
function isArticleAlreadySelected($cdata, $aid){
	$isSel = false;
	
	$xmlDoc = new DOMDocument();
	$rootNode = $xmlDoc->loadXML($cdata['ARTICLES']);
	$rootNode = $xmlDoc->documentElement;
	
	foreach($rootNode->childNodes as $child){
		if($child->hasAttributes()){
		foreach($child->attributes as $attr){
			if($attr->value == $aid){
				$isSel = true;
				break;
			}
			}			
		}
	}
	return $isSel;
}
*/
?>
<?php
	$sqlquery = "SELECT * FROM courses WHERE id='" . $_GET['id'] . "' LIMIT 1";
	$sqlresult = sql_execute($sqlquery);
	$crow = sql_get($sqlresult);
	echo print_h1($crow['NAME']);
	
?>
<br/>
<p><a href="courses.php?f=admin_CourseManage">Back to Courses</a></p>
<p><a href="articles.php?f=editArticle&cid=<?php echo $_GET['id']; ?>">Add a New Article</a></p>
<p><a href="courses.php?f=editResource&cid=<?php echo $_GET['id']; ?>">Add a New Resource</a></p>
<br/>
<?php
	$cid = $_GET['id'];

	$sqlquery = "SELECT * FROM articles";
	$sqlresult = sql_execute($sqlquery);
	
	$xmlDoc = new DOMDocument();
	$rootNode = $xmlDoc->loadXML($crow['ARTICLES']);
	$rootNode = $xmlDoc->documentElement;
	
	if(!xmlHasNextNode(0,$crow['ARTICLES'])){
		print_bold("This course does not currently contain any articles");
		}else{
		print_bold("Articles:");
		br();
	echo '<table class="admin_view_table">';
	
	$nodeID = 1;
	foreach($rootNode->childNodes as $child){
		if($child->tagName == 'article'){
			echo '<tr>';
			$sid = $child->getAttribute('id');
			$sqlquery = "SELECT * FROM articles WHERE id='$sid' LIMIT 1";
			$sqlresult = sql_execute($sqlquery);
			$data = sql_get($sqlresult);
			if(check_user_permission("content_view")){
			echo '<td>';
			echo "<a href=\"index.php?action=article&id=" . $data['ID'] ." \"><img src=\"" . ICONS_PATH . "magnifier.png\" alt=\"View\"/>" . $data['NAME'] . "</a>";
			echo '</td>';
			}
			if(check_user_permission("content_modify")){
			echo '<td>';
			echo "<a href=\"articles.php?f=mod_article&aid=" . $data['ID'] ." \"><img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/>Article</a>";
			echo '</td>';
			echo '<td>';
			echo "<a href=\"index.php?aq=mod_article_pages&aid=" . $data['ID'] ." \"><img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/>Pages</a>";
			echo '</td>';
			echo '<td>';
			echo "<a href=\"index.php?action=mv_art&id=" . $cid ."&dir=up&aid=". $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
			echo "<a href=\"index.php?action=mv_art&id=" . $cid ."&dir=down&aid=" . $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
			echo '</td>';
			}
			if(check_user_permission("content_remove")){
			echo '<td>';
			echo "<a href=\"index.php?confirm&aq=rm_article&aid=" . $data['ID'] ."&cid=" . $_GET['id'] . " \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
			echo '</td>';
			
			}
			echo '</tr>';
		}
		if($child->tagName == 'resource'){
			echo '<tr>';
			$sid = $child->getAttribute('id');
			$resurl = $child->getAttribute('url');
			$resname = $child->getAttribute('name');
			$sqlquery = "SELECT * FROM articles WHERE id='$sid' LIMIT 1";
			$sqlresult = sql_execute($sqlquery);
			$data = sql_get($sqlresult);
			echo '<td>' . $resname . '</td>';
			if(check_user_permission("content_view")){
				echo '<td>';
				echo '<a target="_blank" href="resource_view.php?f=' . $resurl .'"><img src="' . ICONS_PATH . 'magnifier.png" alt="View"/>' . $data['NAME'] . "</a>";
				echo '</td>';
			}
			if(check_user_permission("content_modify")){
				echo '<td>';
				echo "<a href=\"courses.php?f=editResource&cid=".$cid."&resid=" . $nodeID ." \"><img src=\"" . ICONS_PATH . "pencil.png\" alt=\"Edit\"/>Edit</a>";
				echo '</td>';
				echo '<td>';
				echo "<a href=\"index.php?action=mv_art&id=" . $cid ."&dir=up&aid=". $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
				echo "<a href=\"index.php?action=mv_art&id=" . $cid ."&dir=down&aid=" . $nodeID ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
				echo '</td>';
			}
			if(check_user_permission("content_remove")){
				echo '<td>';
				$link = '<a href="courses.php?q=removeResource&id=' . $nodeID . '&cid=' . $_GET['id'] .' "><img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a><br/>';
				echo $link;
				echo '</td>';
			}
			echo '</tr>';	
		}
		$nodeID++;
	}
	echo '</table>';
	
	while ($row = sql_get($sqlresult)){
		echo '<br />';
	}
	}
?>
