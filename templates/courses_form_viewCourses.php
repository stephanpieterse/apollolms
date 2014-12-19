<?php
	$smarty = new Smarty();
	$order = "id";
	$sqlquery = 'SELECT * FROM courses WHERE published_status="1" ORDER BY '. $order .' ASC';
	
	$sqlresult = sql_execute($sqlquery);
	
	$curItem = 0;
	while($rowdata = sql_get($sqlresult)){
	
	$memberID = $_SESSION['userID'];
	$hasAccess = userHasCoursePermissionXML($memberID, $rowdata['PERMISSIONS']);
	if($hasAccess){
			
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
			}else{
			
			}
			$curItem++;
	}
	
	$smarty->assign('courseData',$dataArray);
		// 	-	-	-	-	-	-	-	-	-	PACKAGES SECTION 	-	-	-	-	-	-	-	-	-	-	-	-	-//
		
	$sqlquery = 'SELECT * FROM course_packages WHERE published_status="1" ORDER BY '. $order .' ASC';
	
	$sqlresult = sql_execute($sqlquery);
	$dataArray = array();
	$curItem = 0;
	while($rowdata = sql_get($sqlresult)){
	
	$memberID = $_SESSION['userID'];
	$hasAccess = userHasCoursePermissionXML($memberID, $rowdata['PERMISSIONS']);
	if($hasAccess){
			
		//	$isRegistered = isUserRegisteredForCourse($memberID, $rowdata['ID']);
		$isRegistered = false;
			if($isRegistered){
				$dataArray[$curItem]['NAME'] = '<a class="disp_block" href="courses.php?f=displayCourse&cid=' . $rowdata['ID'] ." \">" . $rowdata['NAME'] . "";
			}else{
				$link = print_bold($rowdata['NAME'] . "<a class=\"disp_block\" href=\"courses.php?f=register&cid=" . $rowdata['ID'] ." \"> - REGISTER");
				$link .= " Price: ";
				if($rowdata['PRICE'] == 0){
					$link .= "Free";
						}else{
							$link .= 'R'. $rowdata['PRICE'];
						}
			$dataArray[$curItem]['NAME'] = $link . '</a>';
			}
			$dataArray[$curItem]['DESCRIPTION'] = $rowdata['DESCRIPTION'];			
			
			$tags = explode(';',$rowdata['TAGS']);
			foreach($tags as $key=>$val){
				$newval = preg_replace('/\s+/', ' ', trim($val));
				$li = '<a class="smallText" href="courses.php?q=check_tags&tag=' . $newval . '">';
				$li .= $val;
				$li .= '</a>';
				$dataArray[$curItem]['TAGS'] = $li;
			}
			}else{
			
			}
			$curItem++;
	}	
		
		
	$smarty->assign('coursePacks',$dataArray);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
