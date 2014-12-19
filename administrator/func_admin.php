<?php

function server_size_bill(){

}

function active_users_detail($thres, $amnt){

	$q = "SELECT * FROM members";
	$r = sql_execute($q);

	$totUsers = 0;
	while($i = sql_get($r)){
		if($i['LAST_LOGIN'] >= (date("s") - (30 * 24 * 60 * 100))){
		$totUsers++;
		echo $i['FULLNAME'];
		}
	}
	echo "Total Users: ";
	echo $totUsers;
	
	for($x = 0; $x < sizeof($thres); $x++){
		if(!($totUsers >= $thres[$x])){
		$thresMax = $x;
		break;
		}
	}
	
	echo "User Threshold Level: ";
	echo $thresMax;

	echo "Price per user: ";
	echo $amnt[$x];

}

function active_users_bill($thres, $amounts){
	$q = "SELECT * FROM members";
	$r = sql_execute($q);

	$totUsers = 0;
	while($i = sql_get($r)){
		if($i['LAST_LOGIN'] >= (date("s") - (30 * 24 * 60 * 100))){
		$totUsers++;
		}
	}

	for($x = 0; $x < sizeof($thres); $x++){
		if(!($totUsers >= $thres[$x])){
		$MperUser = $amounts[$x];
		break;
		}
	
	$bill = $totUsers * $MperUser;
	}
	return $bill;
}

function paid_courses_bill($perc){

	$q = "SELECT * FROM courses";
	$r = sql_execute($q);

	$totAmnt = 0;
	while($i = sql_get($r)){
		$amnt = 0;
		if($i['FEE'] >= 1){
			$amnt = $i['FEE'] * $perc;
		}
		$totAmnt = $totAmnt + $amnt;
	}
	return $totAmnt;
}

function create_billing_info(){
	$userSizeThreshold = array('500','1500','5000','12000','25000','75000','125000','240000','500000');
	$userSizeMoney = array('0.50','0.45','0.40','0.35','0.30','0.25','0.20','0.15','0.10');

	$serverSizeThreshold = array('500','2500','9000','24000','80000','320000','750000');
	$serverSizeMoney = array('250','500','750','1200','2500','4700','8300');

	$coursesPercent = 3;

	$Mserver = server_size_bill($serverSizeThreshold, $serverSizeMoney);
	server_size_detail($serverSizeThreshold);

	$Musers = active_users_bill($userSizeThreshold, $userSizeMoney);
	active_users_detail($userSizeThreshold, $userSizeMoney);
	
	$Mcourses = paid_courses_bill($coursesPercent);
	paid_courses_detail();

	$allFees = $Mserver + $Musers + $Mcourses;
	
		echo "Total Payable: R";
		echo $allFees;


}

?>
