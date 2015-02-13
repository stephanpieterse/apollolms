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

	echo '<span class="group_content_show">';	
		$sqlquery = "SELECT * FROM groupslist";
		$r = sql_execute($sqlquery);
		while($d = sql_get($r)){
			if(isUserInGroup($_SESSION['userID'],$d['ID'])){
				echo $d['NAME'];
				echo '<br/>';
				$courseSet = groups_backend_listGroupCourses($d['ID']);
				for($xi = 0; $xi < sizeOf($courseSet['ID']); $xi++){
					echo $courseSet['NAME'][$xi];
					echo '<br/>';
				}
			}
		}
	echo "</span>";

		$sqlquery = "SELECT * FROM courses WHERE published_status='1' ORDER BY published_date ASC LIMIT 10";
		echo print_bold("Check out these recently added courses:");
		br();
		br();
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
			$smarty->assign('courseData',$dataArray);
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
