<?php
/**
* @author Stephan Pieterse
* @package ApolloLMS
* @description Holds all the cron jobs that run at specified times.
*/

function cron_createLock(){
	chdir(dirname(__FILE__));
	if(file_exists("crons.lock")){
		return false;
	}else{
		echo shell_exec("touch crons.lock");
		return true;
	}
}

function cron_removeLock(){
	chdir(dirname(__FILE__));
	if(file_exists("crons.lock")){
		return unlink("crons.lock");
	}else{
		return false;
	}
}

function cron_func_mediaConversion(){
	if(cron_createLock()){
	chdir(dirname(__FILE__));
	$fulldir = scanForFiles('uploads','uploads/',true,false);
	//var_dump($fulldir);
	foreach($fulldir as $file){
	//	echo $file;
		echo "Trying " . $file;
		media_func_convertFile($file);
	}
	cron_removeLock();
	exit;
	}
	
}

function cron_func_killCaches(){
        chdir(dirname(__FILE__));
        shell_exec("find . -name .vid_res -exec rm -rf {} \;");
	shell_exec("find . -name .aud_res -exec rm -rf {} \;");
	return true;
}

function cron_func_billingInvoice(){
	define('BASE_COST',350);

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
	$totalSpaceUsedBandwith = $totalSpaceUsed * 0.10;
	$smarty->assign('totalSpaceUsedBandwith',round($totalSpaceUsedBandwith));
	$costSoFar += round(BASE_COST + ($totalSpaceUsedBandwith / 1024 * $activeMembers * 2));
	$smarty->assign('totalAdminCost',$costSoFar);
	$smarty->assign('listAllUsers',$membersList);
	$billCourse = bill_calculateCoursesCost();
	$costSoFar += $billCourse;
	$smarty->assign('totalCoursesBill',$billCourse);
	$smarty->assign('totalFinalCost',$costSoFar);
	//insert into template and email it	
	
	mail_inform($billingEmail,'ApolloLMS Billing Cycle',$emsgbody);
}
