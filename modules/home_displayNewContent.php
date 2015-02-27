<?php	
	class module_displayNewContent extends module_item {
	
	private $myID = 0;
	public $plugin_support = array('course_edit');
	
	function set_module_id($id){
		$myID = $id;
	}
		
	function m_plug_course_edit(){
		echo '<input type="text" /> '. "die sal n featured option wees";
	}

	function default_action_home(){
		$smarty = new Smarty();
		
		$sqlquery = "SELECT * FROM groupslist";
		$r = sql_execute($sqlquery);
		
		$gx = 0;
		while($d = sql_get($r)){
			if(isUserInGroup($_SESSION['userID'],$d['ID'])){
				$groupdataArray[$gx]['HEADLINK'] = 'groups.php?f=viewGroup&gid=' . $d['ID'];
				$groupdataArray[$gx]['NAME'] = $d['NAME'];
				$groupdataArray[$gx]['DESCRIPTION'] = strip_tags($d['DESCRIPTION'],'<p><br><ul><li>');
				
				$xmlDoc = new DOMDocument();
				
				if ($d['DESCRIPTION'] == ''){
					$d['DESCRIPTION'] = '<html></html>';
				}
				
				$xmlDoc->loadHTML($d['DESCRIPTION']);
				$rootNode = $xmlDoc->documentElement;
	
				$imgList = $rootNode->getElementsByTagName('img');
				if(($imgList->item(0))){
					$firstImgVal = $imgList->item(0)->getAttribute('src');
				}else{ 
					$firstImgVal = ''; 
					}
				$groupdataArray[$gx]['ITEMIMG'] = $firstImgVal;
				
				$courseSet = groups_backend_listGroupCourses($d['ID']);
				for($xi = 0; $xi < sizeOf($courseSet['ID']); $xi++){
					$groupdataArray[$gx]['COURSES']['LINK'][] = $courseSet['NAME'][$xi];	
				}
				$gx++;
			}
		}

		$sqlquery = "SELECT * FROM courses WHERE published_status='1' ORDER BY published_date ASC LIMIT 10";
		$sqlresult = sql_execute($sqlquery);
		//echo '<link type="text/css" rel="stylesheet" href="modules/content_icons/style.css"/>';
	//	echo '<ul class="displayNewContent">';
		$curItem = 0;
		while($rowdata = sql_get($sqlresult)){
			$memberID = $_SESSION['userID'];
			$hasAccess = userHasCoursePermissionXML($memberID, $rowdata['PERMISSIONS']);
			
			if(!$hasAccess){ continue; }
					$isRegistered = isUserRegisteredForCourse($memberID, $rowdata['ID']);
				if($isRegistered){
					$dataArray[$curItem]['NAME'] = '<a class="disp_block" href="courses.php?f=displayCourse&cid=' . $rowdata['ID'] ." \">" . $rowdata['NAME'] . "";
					$dataArray[$curItem]['HEADLINK'] = 'courses.php?f=displayCourse&cid=' . $rowdata['ID'];
				}else{
					if(!isset($onlyRegCourses)){
						$link = print_bold($rowdata['NAME'] . "<a class=\"disp_block\" href=\"courses.php?f=register&cid=" . $rowdata['ID'] ." \"> - REGISTER");
						$dataArray[$curItem]['HEADLINK'] = 'courses.php?f=register&cid=' . $rowdata['ID'];
						$link .= " Price: ";
						if($rowdata['PRICE'] == 0){
							$link .= "Free";
							}else{
								$link .= 'R'. $rowdata['PRICE'];
						}
					$dataArray[$curItem]['NAME'] = $link . '</a>';
					}else{
						continue;
					}
				}
				$dataArray[$curItem]['DESCRIPTION'] = strip_tags($rowdata['DESCRIPTION'],'<p><br><ul><li>');//strip_html_tags(strip_img_tags($rowdata['DESCRIPTION']));			
					$xmlDoc = new DOMDocument();
					
					if ($rowdata['DESCRIPTION'] == ''){
						$rowdata['DESCRIPTION'] = '<html></html>';
					}
					
					$xmlDoc->loadHTML($rowdata['DESCRIPTION']);
					$rootNode = $xmlDoc->documentElement;
		
					$imgList = $rootNode->getElementsByTagName('img');
					if(($imgList->item(0))){
						$firstImgVal = $imgList->item(0)->getAttribute('src');
					}else{ $firstImgVal = ''; }
					$dataArray[$curItem]['ITEMIMG'] = $firstImgVal;
				
				$tags = explode(';',$rowdata['TAGS']);
				foreach($tags as $key=>$val){
					$newval = preg_replace('/\s+/', ' ', trim($val));
					$li = '<a class="smallText" href="courses.php?q=check_tags&tag=' . $newval . '">';
					$li .= $val;
					$li .= '</a>';
					$dataArray[$curItem]['TAGS'] = $li;
					}
				$curItem++;
			}
			if(isset($dataArray)){
			$smarty->assign('courseData',$dataArray);
			}
			if(isset($groupdataArray)){
			$smarty->assign('groupData',$groupdataArray);
			}
			$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
			$smarty->display(MODULE_PATH . $tplName);
	//echo "</ul>";
	br_clear();
	}
	
		function default_action($pagename){
			switch($pagename){
				case 'home':
				$this->default_action_home();
				break;
				case 'course_edit':
				$this->action_course_edit();
				break;
				default:
				echo "Module Loaded - No action present";
				break;
			}
		}
}
?>
