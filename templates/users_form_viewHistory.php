<?php
	/*
 *	@author Stephan Pieterse*
 * @package ApolloLMS
 * */
	$smarty = new Smarty;

	$uid = $_GET['uid'];
	$maxamnt = isset($_GET['maxamount']) ? $_GET['maxamount'] : 10;
	
	$niceDates = array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
	
	$allCourses[] = null;
	$q = "SELECT * FROM courses";
	$r = sql_execute($q);
	while($d = sql_get($r)){
		$allCourses[$d['ID']] = $d['NAME'];
	}
	
	$allArticles[] = null;
	$q = "SELECT * FROM articles";
	$r = sql_execute($q);
	while($d = sql_get($r)){
		$allArticles[$d['ID']] = $d['NAME'];
	}
	
	$q = "SELECT * FROM member_view_history WHERE uid='$uid'";
	$r = sql_execute($q);

	if(sql_numrows($r) != 0){
	while($data = sql_get($r)){
	
		$xmlDoc = new DOMDocument();
		
		if($data['HISTORY'] == ''){
			$data['HISTORY'] = '<history></history>';
		}
		
		$xmlDoc->loadXML($data['HISTORY']);
		$rootNode = $xmlDoc->documentElement;
					
		$tempStat = $rootNode->childNodes->length;
		
		if($tempStat == 1){
			//return false;
			continue;
			}
			
		$totAvailNodes = 0;
		while(($totAvailNodes <= $maxamnt) && ($totAvailNodes < $tempStat)){
			$totAvailNodes++;
			}
		
		$curitem = 0;
		for($x = $tempStat-1; $x > $tempStat - $totAvailNodes; $x--){
		$item = $rootNode->childNodes->item($x);
		//foreach($rootNode->childNodes as $item){
			if($item->hasAttributes()){
				foreach($item->attributes as $attr){
					
					switch($attr->name){
						case 'page':
							$dataArray[$curitem]['PAGE'] = $attr->value;
						break;
						case 'time':
							//echo "Viewed at:";
							//date("Y-m-d-H-i-s"),
							$fullTime = explode('-',$attr->value);
							$nice =  $fullTime[2] . ' of ' . $niceDates[(int)$fullTime[1]] . ' ' . $fullTime[0];
							//echo $nice;
							
							if(!isset($prevDate)){$prevDate = $attr->value;}
							$dataArray[$curitem]['TIME'] =  time_difference($prevDate,$attr->value);
							$prevDate = $attr->value;
					
							break;
												
						case 'f':
							//echo 'Viewed a form: ';
							$dataArray[$curitem]['FORM'] =  $attr->value;
						
						break;
						
						case 'pq':
							$dataArray[$curitem]['POSTQUERY'] =  $attr->value; $attr->value;
						break;
						
						case 'q':						
							$dataArray[$curitem]['GETQUERY'] = $attr->value;
						break;
						default:
						
							$dataArray[$curitem][] = $attr->value;
						break;
				}
			}
		}
			$curitem++;
		}
		}
	}

	if(isset($dataArray)){
		$smarty->assign('itemdata',$dataArray);
	}
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
?>
