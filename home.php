<?php
/**
 * This is a part of the original controller for the ApolloLMS system, will be deprecated soon.
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
if(isset($_SESSION['userID'])){
	$loggedIn = true;
}else{
	$loggedIn = false;
}
	require("dispatch_table_actions.php");
		$action = isset( $_GET['action'] ) ? $_GET['action'] : null;
		$msg = isset( $_GET['msg'] ) ? makeSafe($_GET['msg']) : "";
		$uq = isset( $_GET['uq'] ) ? $_GET['uq'] : "";
		$aq = isset( $_GET['aq'] ) ? $_GET['aq'] : "";
		$gq = isset( $_GET['gq'] ) ? $_GET['gq'] : "";
		$mq = isset( $_GET['mq'] ) ? $_GET['mq'] : "";
		$mailq = isset( $_GET['mail'] ) ? $_GET['mail'] : "";
		
		if(isset( $_GET['search_course'] )){
			$sq = $_GET['search_course'];
			$sqw = 'courses';
		}
		
		//unset($_SESSION['searchResults']);	

		if((isset($sq)) && ($sq != "")){
			if((isset($sqw)) && ($sqw != "")){
			$whereIs = makeSafe($sqw);
			$contains = makeSafe($sq);
			switch ($sqw){
				case 'courses':
				 if($list = search_courses($sq)){
				 $csvlist = implode("','",$list);
	
					$q = "SELECT id,name FROM courses WHERE id IN ('" . $csvlist . "')";
					$r = sql_execute($q);
					
					echo 'Search Results: ';
					br();
					while($d = sql_get($r)){
						if(userHasCoursePermission($_SESSION['userID'], $d['id'])){
							//echo $d['id'];
							echo $d['name'];
							br();
						}
					}
					}else{
				echo 'Nothing matches your search';
			}
				 break;	
			}
			//$_SESSION['searchResults'] = $data;	
				}
		}
		 // Display a status message
		
		if(isset($msg)){
		$msg = makeSafe($msg);
		$query = "SELECT * FROM statmessages";
		$queryRes = sql_execute($query);
		while($row = sql_get($queryRes)){
			if($row['MSGNAME'] == $msg){
				$SYSTEM_HELP_MSG = $row['MESSAGE'];
	echo <<<REF
<div class="greenMsgBox" id="system_stat_msg"> $SYSTEM_HELP_MSG </div>
<script>
	$('#system_stat_msg').delay(2000).fadeOut(5000);
</script>
REF;
					break;
			}
		}	
		}
	 
	 if(isset($_GET)){
		logAction($_GET);
	 }else{
		logAction(array('bounce'=>'index'));
	 }
	 
	 $Home = true;
	if((isset($mail)) && ($uq != "") && (isset($dispatch_mail[$mail])) && $loggedIn){
		call_user_func($dispatch_mail[$mail],"");
		$Home = false;
	 }
	if(isset($_GET['confirm']) && ($_GET['confirm'] != 1)){
		include(TEMPLATE_PATH . "form_confirm_action.php");
	}else{
	if((isset($gq)) && ($gq != "") && (isset($dispatch_gq[$gq]))){
		call_user_func($dispatch_gq[$gq],"");
		$Home = false;
	 }
	 if((isset($action)) && (isset($dispatch_action[$action]))){
		call_user_func($dispatch_action[$action],"");
		$Home = false;
	 } 
	 if((isset($uq)) && ($uq != "") && (isset($dispatch_uq[$uq])) && $loggedIn){
		call_user_func($dispatch_uq[$uq],"");
		$Home = false;
	 }
	 if((isset($aq)) && ($aq != "") && (isset($dispatch_aq[$aq])) && $loggedIn){
	 	call_user_func($dispatch_aq[$aq],"");

		$Home = false;
	}
	
	if((isset($mq)) && ($mq != "") && (isset($_GET['mi'])) && $loggedIn){
		module_getCSS($_GET['mi']);
		module_runFunction($_GET['mi'],$mq,$_GET);
		$Home = false;
	}
	
	if($Home){
		defaultHome();
	}
	}
?>
