<?php
	define('BASE_COST',350);

	$smarty = new Smarty;

	$q = "SELECT value FROM site_settings WHERE item='billing_email' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
	$billingEmail = $r['value'];
	if($billingEmail == ''){
		$billingEmail = SITE_EMAIL;
	}

	$q = "SELECT * FROM members";
	$r = sql_execute($q);
	$activeMembers = 0;
	$currentDate = date("Y-m-d-H-i-s");
	$dateArrNow = explode('-',$currentDate);
	$dataArrMonth = $dateArrNow[1];
	$dataArrYear = $dateArrNow[0];
	while($d = sql_get($r)){
		$dateArrUser = explode('-',$d['LASTLOGIN']);
		if(isset($dateArrUser[1])){
			$dataArrUserMonth = $dateArrUser[1];
			$dataArrUserYear = $dateArrUser[0];
		}else{
			$dataArrUserMonth = $dataArrMonth - 2;
			$dataArrUserYear = $dataArrYear - 1;
		}
	if(($dataArrUserYear == $dataArrYear) && $dataArrUserMonth >= ($dataArrMonth - 1)){
		$membersList[] = $d['EMAIL'];
		$activeMembers++;
		}
	}
	
	$costSoFar = 0;

	$smarty->assign('billingEmail',$billingEmail);
	$smarty->assign('activeMembers',$activeMembers);
	$totalSpaceUsed = bill_calculateSpaceUsed();
	$smarty->assign('totalSpaceUsed',$totalSpaceUsed);
	$smarty->assign('totalUploadsMax',MAX_TOTAL_UPLOADS / 1024);
	$totalSpaceUsedBandwith = $totalSpaceUsed * 0.15;
	$smarty->assign('totalSpaceUsedBandwith',round($totalSpaceUsedBandwith));
	$costSoFar += round(BASE_COST + ($totalSpaceUsedBandwith / 1024 * $activeMembers * 4)); // im not so sure what the 4 does anymore
	$smarty->assign('totalAdminCost',$costSoFar);
	$smarty->assign('listAllUsers',$membersList);
	$billCourse = bill_calculateCoursesCost();
	$costSoFar += $billCourse;
	$smarty->assign('totalCoursesBill',$billCourse);
	$smarty->assign('totalFinalCost',$costSoFar);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
