<?php
/*
 * @author Stephan Pieterse
 * */

function stat_getGroupStats(){
	$gq = "SELECT * FROM groupslist";
	$gr = sql_execute($gq);
	while($gd = sql_get($gr)){
		$groupTotals[$gd['ID']]['NAME'] = $gd['NAME'];
		$groupTotals[$gd['ID']]['TOTALS'] = 0;
	}
	
	$mq = "SELECT * FROM members";
	$mr = sql_execute($mq);
	while($md = sql_get($mr)){
			$ui = new ALMS_UserItem;
			$ui->load($md['ID']);
			$gids = $ui->get_userGroupIDs();
			if($gids){
				foreach($gids as $gid){
					//if(in_array($gid,$groupTotals)){
					$groupTotals[$gid]['TOTALS'] = $groupTotals[$gid]['TOTALS'] + 1;
					//}
				}
			}
	}
	return $groupTotals;
	}

function stat_getGenderStats(){
		$q = "SELECT * FROM members";
		$r = sql_execute($q);
		
		$males = 0;
		$females = 0;
		$totalcount = 0;
		
		while($d = sql_get($r)){
			$totalcount++;
			if($d['GENDER'] == 0){
				$males++;
		}else{
				$females++;
		}
		}
		$values['m'] = $males;
		$values['f'] = $females;
		$values['t'] = $totalcount;
		
		return $values;

}

function stat_getAgeStats(){
	
	$q = "SELECT * FROM members";
	$r = sql_execute($q);
	
	$less18 = 0;
	$between18and25 = 0;
	$between25and40 = 0;
	$over40 = 0;
	$totalcount = 0;
	
	while($d = sql_get($r)){
		$totalcount++;
		if($d['BIRTHDATE'] != ''){
			$bdate = explode('-',$d['BIRTHDATE']);
			$bdateY = $bdate[0];
		}else{
			$bdateY = 1988;
		}
		
		$now = date("Y");
		
		$compare = $now - $bdateY;
		if($compare <= 18){
			$less18++;
			}
		if($compare > 18 && $compare <=25){
			$between18and25++;
		}
		if($compare > 25 && $compare <= 40){
			$between25and40++;
		}
		if($compare > 40){
			$over40;
			}
		}
	
	$retvals[] = $less18;
	$retvals[] = $between18and25;
	$retvals[] = $between25and40;
	$retvals[] = $over40;
	
	return $retvals;
	}
