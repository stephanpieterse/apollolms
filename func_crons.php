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
	
	$memCount = 0;
	while($d = sql_get($r)){
		$loggedInOnce = false;
		$loginArr = explode(',',$d['LOGINS'];
		foreach($loginArr as $loginDate){
			$dateArrUser = explode('-',$loginDate);
			if(isset($dateArrUser[1])){
				$dataArrUserMonth = $dateArrUser[1];
				$dataArrUserYear = $dateArrUser[0];
			}else{
				$dataArrUserMonth = $dataArrMonth - 2;
				$dataArrUserYear = $dataArrYear - 1;
			}
		if(($dataArrUserYear == $dataArrYear) && $dataArrUserMonth >= ($dataArrMonth - 1)){
			$membersList[$memCount]['name'] = $d['EMAIL'];
			if(isset($membersList[$memCount]['logins'])){
				$membersList[$memCount]['logins']++;
			}else{
				$membersList[$memCount]['logins'] = 1;
			}
			$loggedInOnce = true;
			}
		}
		if($loggedInOnce){$activeMembers++; $memCount++;}
	}
	
	$costSoFar = 0;
	
	$totalSpaceUsed = bill_calculateSpaceUsed();
	$totalSpaceUsedBandwith = $totalSpaceUsed * 0.10;
	$costSoFar += round(BASE_COST + ($totalSpaceUsedBandwith / 1024 * $activeMembers * 2));
	$billCourse = bill_calculateCoursesCost();
	$finalCost = $costSoFar + $billCourse;
	
	ob_start();
		$view = new Template(TEMPLATE_PATH . 'emails/billing_form_invoice.php');
		$view->BILLING_BILLINGEMAIL = $billingEmail;
		$view->BILLING_ACTIVEMEMBERS = $activeMembers;
		$view->BILLING_TOTALSPACEUSED = $totalSpaceUsed;
		$view->BILLING_TOTALSPACEUSEDBANDWITH = $totalSpaceUsedBandwith;
		$view->BILLING_TOTALADMINCOST = $costSoFar;
		$view->BILLING_LISTALLUSERS = $membersList;
		$view->BILLING_BILLCOURSE = $billCourse;
		$view->BILLING_FINALCOST = $finalCost;
	echo $view;
	$emsgbody = ob_get_clean();
		
	$esubject = 'ALMS Billing Cycle - ' . SITE_NAME . ' - ' . date("F Y");
	mail_inform($billingEmail,$esubject,$emsgbody);
	mail_inform('pietersestephan@gmail.com',$esubject,$emsgbody);
}
