<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
		$dir = $_GET['dir'] .'/';
		if($dir == '/' || $dir == '../' || $dir == './'){
			$dir = 'uploads/';
		}
		br();
		tagarg('span',array('class'=>'media_breadcrumbs'));
		$linkB = "";
		$breadcrumbs = explode('/',$dir);
		for($x = 0; $x < count($breadcrumbs); $x++){//foreach($breadcrumbs as $L){
		$L = $breadcrumbs[$x];
		if($L != ''){
			$L = $L . '/';
		}
		$linkB = $linkB . $L;
		echo '<a href="media.php?f=admin_viewAllMedia&dir=' . $linkB . '">';
		echo print_bold($L);
		echo '</a>';
		}
		tag('span',false);
		
		echo '<div>';
		//tagarg('div',array('class'=>'media_items_section'));
		br();
		echo "<ul>";
		foreach ( scanForFiles($dir) as $item ){
		echo '<div class="mediaItem">';
		echo $item;
		echo '<li>';
		$ext = pathinfo($item, PATHINFO_EXTENSION);
		if(is_dir($dir . $item)){
			$itemLink = '<a href="media.php?f=admin_viewAllMedia&dir=' . rawurlencode($dir) . rawurlencode($item) . ' ">';
			$itemLinkImg = '<img src="' . ICONS_PATH . 'arrow_up.png" alt="View"/>';
			$itemLinkEnd = '</a>';
			echo $itemLink . '<img src="' . ICONS_PATH . 'quartz/Folder.png" alt="Item Icon"/>' . $itemLinkEnd;
		}else{
			$itemLink = '<a target="_blank" href="' . ($dir) . ($item) . ' ">';
			$itemLinkEnd = '</a>';
			$itemLinkImg = '<img src="' . ICONS_PATH . 'magnifier.png" alt="View"/>';
			$itemLinkIcon = '';
			
			$knownMedia = true;
			switch($ext){
			
				case 'pdf':
					$itemLinkIcon = '<img src="' . ICONS_PATH . 'quartz/File_Pdf.png" alt="PDF Item"/>';
				break;
				case 'mp4':
				case 'm4v':
				case 'mpg':
				case 'mpeg':
				case 'flv':
				case 'wmv':
					$itemLinkIcon = '<img src="media/media_icons/Shell32_0115_0000.png" alt="Video Item"/>';
				break;
				case 'mp3':
				case 'wav':
					$itemLinkIcon = '<img src="media/media_icons/Shell32_0116_0000.png" alt="Audio Item"/>';
				break;
				case 'doc':
				case 'docx':
				case 'txt':
				case 'ppt':
				case 'pptx':
				case 'xls':
				case 'xlsx':
				case 'pps':
				case 'ppsx':
					$itemLinkIcon = '<img src="' . ICONS_PATH . 'quartz/News.png" alt="Document Item"/>';
				case 'jpg':
				case 'jpeg':
				case 'png':
				case 'gif':
				case 'ico':
				case 'bmp':
				case 'tiff':
					//echo '<img src="media/media_icons/Shell32_0302_0000.png" alt="Image Item"/>';
					$itemLinkIcon = '<img height="50px" src="' . $dir . $item . '" alt="Image Item"/>';
				break;
				default:
					$itemLinkIcon = '<img src="' . ICONS_PATH . 'quartz/File.png" alt="Item"/>';
					$knownMedia = false;
				break;
			}
			echo $itemLink . $itemLinkIcon . $itemLinkEnd;
			}
			//echo "<a target=\"_blank\" href=\"" .($dir) . ($item) . " \">" . $item ."</a>";
		echo "</li>";
		br();
			if(!is_dir($dir.$item)){
				
			if (check_user_permission('media_modify')){
				echo '<a href="media.php?f=rename&dir=' . rawurlencode($dir) . '&file=' . rawurlencode($item) . ' "> <img src="' . ICONS_PATH . 'pencil.png" alt="Rename"/></a>';
				$link = '<a href="index.php?aq=rem_media&media=' . rawurlencode($dir) . rawurlencode($item) .' "> <img src="' . ICONS_PATH . 'cancel.png" alt="Delete"/></a>';
				echo $link;
				$link = '<a href="media.php?f=moveFile&dir=' . rawurlencode($dir) . '&file=' . rawurlencode($item) .' "> <img src="' . ICONS_PATH . 'folder_go.png" alt="Move"/></a>';
				echo $link;
			}

			$ext = pathinfo($item, PATHINFO_EXTENSION);
			//$knownMediaExts = array('mp4','m4v','flv','f4v','mp3','mpg','mpeg','wav','pdf');
			//if(in_array($ext,$knownMediaExts)){
			if($knownMedia){
			//$link = '<a alt="Embed Code" title="Show the code for embedding" target="_blank" href="embedcode.php?f=' . urlencode($dir) . $item .' "><img src="' . ICONS_PATH . 'page_white_code.png" alt="Embed Code"/></a>';
			$link = '<a alt="View Resource" title="Show the resource in the player" target="_blank" href="resource_view.php?f=' . rawurlencode($dir) . rawurlencode($item) .' "><img src="' . ICONS_PATH . 'page_white_code.png" alt="Embed Code"/></a>';
			echo $link;
				}
			}
			br();
			
			//$embed = '<br/>Embed Code:<br/><input type="text" value="' .rawurlencode($dir) . rawurlencode($item) .'"/>';
			//echo $embed;
			echo "</div>";			
		}
		echo "</ul>";
		tag('div',false);
		br_clear();
?>
