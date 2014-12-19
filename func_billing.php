<?php
/**
 * Basic functions for the billing part of the site.
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
 
 /**
  * Returns the registered payfast account of the site
  * */
function get_site_payfast_account(){
	$q = "SELECT * FROM site_settings WHERE item='payfast_details'";
	$d = sql_get(sql_execute($q));
	
	if($d['VALUE'] == ""){
		return false;
	}else{
		return $d['VALUE'];
	}
}

/**
 * Returns the registered paypal adress
 * */
function get_site_paypal_adress(){
	$q = "SELECT * FROM site_settings WHERE item='paypal_details'";
	$d = sql_get(sql_execute($q));
	
	if($d['VALUE'] == ""){
		return false;
	}else{
		return $d['VALUE'];
	}
}

/**
 * Returns an array with:
 * bank_name
 * account_number
 * account_type
 * branch_code
 */
function get_site_banking_details(){
	$q = "SELECT value FROM site_settings WHERE item='bank_details'";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$details = $r['value'];
	
	$temp = xmlGetSpecifiedNode($details, array('tagname'=>'bank_bankname','value'=>''));
	$retval['bank_name'] = $temp['value'];
	$temp = xmlGetSpecifiedNode($details, array('tagname'=>'bank_accountnumber','value'=>''));
	$retval['account_number'] = $temp['value'];
	$temp = xmlGetSpecifiedNode($details, array('tagname'=>'bank_accounttype','value'=>''));
	$retval['account_type'] = $temp['value'];
	$temp = xmlGetSpecifiedNode($details, array('tagname'=>'bank_branchcode','value'=>''));
	$retval['branch_code'] = $temp['value'];
	
	return $retval;
}

/**
 * Calculates the cost of all the registered courses to the specific site. Normal percentage is 3% of sales.
 * */
function bill_calculateCoursesCost(){
	$salesPercentage = 0.03;
	
	$q = "SELECT * FROM course_registrations";
	$r = sql_execute($q);
	
	$bill_allUser = 0;

	while($d = sql_get($r)){
	$bill_thisUser = 0;
		// get activated row
	$activeCourses = $d['REGISTERED'];
	$xmlDoc = new DOMDocument();
	$xmlDoc->loadXML($activeCourses);
	$xmlRoot = $xmlDoc->documentElement;
	
		foreach($xmlRoot->childNodes as $c){
				//if(time_difference($c->getAttribute('regtime'),date("Y-m-d-H-i-s"),false) <= 2678400){
				if(time_isInSelectedMonth($c->getAttribute('regtime'),date("m"))){
					$cid = $c->getAttribute('cid');
					$cq = "SELECT * FROM courses WHERE id='$cid' LIMIT 1";
					$cd = sql_execute($cq);
					$cr = sql_get($cd);
					if($cr['PRICE'] != 0){
					$unitPrice = $cr['PRICE'] * $salesPercentage;
					$bill_thisUser = $bill_thisUser + $unitPrice;
					}
				}
	$bill_allUser = $bill_allUser + $bill_thisUser;
}		
	return $bill_allUser;
}
}
 
 /*
function bill_calculateUserCost($amntUsers){
		
	$maxUsers = 100000;
	$minPercent = 0.10;
	$pricePerUser = 0.65;
	$calcUsers = $maxUsers - ($maxUsers * $minPercent);

	$i = $calcUsers - $amntUsers;
	$j = $i / $maxUsers;

	$userBill = floor(($j * $pricePerUser) * $amntUsers);
	
	return $userBill;
	}
* 
 */

/**
 * Displays in MB the space on the bill
 * */
function bill_calculateSpaceUsed(){
	$data = foldersize('uploads');	
	return round($data[0] / 1024 / 1024,3);
}

/**
 * Calculates the space used by the user for their content in
 * @param string $dir the uploads folder to scan
 * */
function foldersize($dir){
	chdir(dirname(__FILE__));
	$dir =  '' . $dir;
	
 $count_size = 0;
 $count = 0;
 $dir_array = scandir($dir);
 foreach($dir_array as $key=>$filename){
  if($filename!=".." && $filename!="."){
   if(is_dir($dir."/".$filename)){
    $new_foldersize = foldersize($dir."/".$filename);
    $count_size = $count_size + $new_foldersize[0];
    $count = $count + $new_foldersize[1];
   }else if(is_file($dir."/".$filename)){
    $count_size = $count_size + filesize($dir."/".$filename);
    $count++;
   }
  }
 
 }
 // access with $ret[0] and $ret[1];
 return array($count_size,$count);
}
?>
