<?php
	$aid = $_GET['aid'];
	$q = "SELECT * FROM articles WHERE id='$aid' LIMIT 1";
	$r = sql_execute($q);
	$data = sql_get($r);
	?>
	
	<p><a href="articles.php?f=showArticles&id=<?php echo $data['COURSE'] ?>">Back to Course</a></p>
	<p><a href="pages.php?f=edit&aid=<?php echo $_GET['aid'] ?>">Add a New Page</a></p>
	<p><a href="index.php?aq=new_page_resource&aid=<?php echo $_GET['aid']; ?>">Add a New Resource</a></p>
	
	<?php
		$xmlDoc = new DOMDocument();
		if($data['PAGES'] == ''){
			$tempXML = "<root></root>";
		}else{
			$tempXML = $data['PAGES'];
		}
		
		$rootNode = $xmlDoc->loadXML($tempXML);
		$rootNode = $xmlDoc->documentElement;
		$x = -1;
		
		echo '<table class="admin_view_table">'; 
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
						echo '<td>';
						$link = '<a target="_blank" href=?uq=viewPage&pnm=' . $x . '&aid=' . $aid . '>' . $adata['NAME'] . '</a>';
						echo $link;
						echo '</td>';
						echo '<td>';
						$link = '<a href="pages.php?f=mod_page&pid=' . $artID . '"><img src="' . ICONS_PATH . 'pencil.png" alt="Edit"/> Edit</a>';
						echo $link;
						echo '</td>';
						echo '<td>';
						echo "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=up&pid=". $x ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
						echo "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=down&pid=" . $x ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
						echo '</td>';
						echo '<td>';
						echo "<a href=\"index.php?confrim&aq=rm_page&pid=" . $artID . '&aid=' . $aid . " \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
						echo '</td>';
						echo '</tr>';
				}else{
					echo 'Invalid or corrupt data, please contact your site or course administrator';
					br();
				}
				break;
					
				case 'resource':
					if($child->hasAttributes()){
							$resname = $child->getAttribute('name');
							$resurl = $child->getAttribute('url');
								echo '<td>';
								$link = '<a target="_blank" href="resource_view.php?f=' . $resurl . ' ">' . $resname . '</a>';
								echo $link;
								echo '</td>';
								echo '<td>';
								$link = '<a href="articles.php?f=editResource&aid=' . $aid . '&resid=' . $x . '"><img src="' . ICONS_PATH . 'pencil.png" alt="Edit"/> Edit</a>';
								echo $link;
								echo '</td>';
								echo '<td>';
								echo "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=up&pid=". $x ." \"><img src=\"" . ICONS_PATH . "arrow_up.png\" alt=\"Move Up\"/></a>";
								echo "<a href=\"index.php?aq=mv_page&aid=" . $aid ."&dir=down&pid=" . $x ." \"><img src=\"" . ICONS_PATH . "arrow_down.png\" alt=\"Move Down\"/></a>";
								echo '</td>';
								echo '<td>';
								echo "<a href=\"articles.php?q=removeResource&id=" . $x . '&aid=' . $aid . " \"><img src=\"" . ICONS_PATH . "cancel.png\" alt=\"Delete\"/></a>";
								echo '</td>';
								echo '</tr>';
								}
					break;
				}
	}
		echo '</table>';
		echo tooltip("View, edit, move, or delete pages from this article.", "article_pages");
?>
</p>
