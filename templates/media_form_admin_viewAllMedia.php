<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
		$smarty = new Smarty;
		
		$breadcrumbData = '';
		$fileDataArray = array();
		
		if(isset($_GET['selector'])){
			if($_GET['selector'] == 'single'){
					$selectFor = 'radiobtn';
			}
		}
		
		$dir = $_GET['dir'] .'/';
		if($dir == '/' || $dir == '../' || $dir == './'){
			$dir = 'uploads/';
		}

		$linkB = "";
		$breadcrumbs = explode('/',$dir);
		for($x = 0; $x < count($breadcrumbs); $x++){
			$L = $breadcrumbs[$x];
			if($L != ''){
				$L = $L . '/';
			}
			$linkB = $linkB . $L;
			$breadcrumbData .= '<a href="media.php?f=admin_viewAllMedia&dir=' . $linkB . '">';
			$breadcrumbData .= print_bold($L);
			$breadcrumbData .= '</a>';
		}
		
		$curfile = 0;
		foreach ( scanForFiles($dir,'',false,false) as $item ){

		$fileDataArray[$curfile]['NAME'] = $item;

		$ext = pathinfo($item, PATHINFO_EXTENSION);
		
		if(is_dir($dir . $item)){
			if(isset($_GET['selector'])){
				$fileDataArray[$curfile]['TYPE'] = 'folder';
				$fileDataArray[$curfile]['LINKVIEW'] = 'mediaslim.php?selector=' . $_GET['selector'] . '&f=mediaSelect&dir=' . rawurlencode($dir) . rawurlencode($item);
			}else{
				$fileDataArray[$curfile]['TYPE'] = 'folder';
				$fileDataArray[$curfile]['LINKVIEW'] = 'media.php?f=admin_viewAllMedia&dir=' . rawurlencode($dir) . rawurlencode($item);
				$fileDataArray[$curfile]['LINKREMOVE'] = 'media.php?q=rmFolder&folder=' . rawurlencode($dir) . rawurlencode($item);	
			}			
		}else{
			$fileDataArray[$curfile]['LINKVIEW'] = get_serverURL() . '/' . SUBDOMAIN_NAME . '/' . ($dir) . ($item);
			$knownMedia = true;
			switch($ext){
			
				case 'pdf':
					$fileDataArray[$curfile]['TYPE'] = "pdf";
				break;
				case 'mp4':
				case 'm4v':
				case 'mpg':
				case 'mpeg':
				case 'flv':
				case 'wmv':
					$fileDataArray[$curfile]['TYPE'] = "video";
				break;
				case 'mp3':
				case 'wav':
					$fileDataArray[$curfile]['TYPE'] = "audio";
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
					$fileDataArray[$curfile]['TYPE'] = "document";
				case 'jpg':
				case 'jpeg':
				case 'png':
				case 'gif':
				case 'ico':
				case 'bmp':
				case 'tiff':			
					$fileDataArray[$curfile]['TYPE'] = "image";
					$fileDataArray[$curfile]['IMAGELINK'] = $dir . $item;
				break;
				default:
					$fileDataArray[$curfile]['TYPE'] = "other";
					$knownMedia = false;
				break;
			}
			}

			if(!is_dir($dir.$item)){
			if (check_user_permission('media_modify')){
				$smarty->assign('userCanMod',true);
				$fileDataArray[$curfile]['LINKRENAME'] = 'media.php?f=rename&dir=' . rawurlencode($dir) . '&file=' . rawurlencode($item);
				$fileDataArray[$curfile]['LINKREMOVE'] = 'media.php?q=removeFile&media=' . rawurlencode($dir) . rawurlencode($item);
				$fileDataArray[$curfile]['LINKMOVE'] = 'media.php?f=moveFile&dir=' . rawurlencode($dir) . '&file=' . rawurlencode($item);
			}
			$ext = pathinfo($item, PATHINFO_EXTENSION);
			if($knownMedia){
				$fileDataArray[$curfile]['RESOURCEVIEW'] = 'resource_view.php?f=' . rawurlencode($dir) . rawurlencode($item);
				$fileDataArray[$curfile]['MEDIAKNOWN'] = true;
			}else{
				$fileDataArray[$curfile]['MEDIAKNOWN'] = false;
			}
			
			$fileDataArray[$curfile]['FILESIZE'] = misc_human_filesize(filesize($dir.$item));
			}
			
			$curfile++;
		}
		
	if(isset($selectFor)){$smarty->assign('selectors',$selectFor);}
	$smarty->assign('itemData',$fileDataArray);
	$smarty->assign('breadcrumbs',$breadcrumbData);
	$smarty->assign('iconpath',ICONS_PATH);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
