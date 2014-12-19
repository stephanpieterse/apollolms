<?php
/*

THIS MODULE HAS BEEN CREATED SPECIFICALLY FOR THE CYNERGY FOUNDATION
BY STEPHAN PIETERSE

IT READS ALL THE TESTS THAT HAVE BEEN COMPLETED BY THE STUDENT, AND USES THE AVERAGE RATING TO DETERMINE WHICH LEVEL OF THE CYNERGY READING PROGRAM WOULD BE MOST SUITED FOR THE STUDENT

TODO:
AFTER SCORE SHOWS, LINK TO APPROPRIATE CONTENT

*/

class mod_cynergy_reading_level extends module_item{

	private $myID = 0;
	private $moduleVars = array('MVER'=>'1','MTYPE'=>'group','MNAME'=>'Cynergy Reading Level','MDESC'=>'');	
	
function get_module_description(){
		return $this->moduleVars['MDESC'];
	}
	
function get_module_name(){
			return $this->moduleVars['MNAME'];
		}
	
function get_module_type(){
			return $this->moduleVars['MTYPE'];
		}

function get_module_version(){
		return $this->moduleVars['MVER'];
		}
		
function set_module_id($id){
		$this->myID = $id;
		}

function main_home(){
if(isset($_SESSION['username'])){
	 // Determine which level student is on.

		$username = $_SESSION['username'];
			
		$sqlquery = "SELECT * FROM testresults WHERE STUDENT='" . $username . "'";
		$result = sql_execute($sqlquery);
		
		$numratings = 1;
		$totalrating = 0;
		while($row = sql_get($result)){
			$totalrating = $totalrating + $row['RATING'];
			$numratings = $numratings+1;
			$score = $totalrating / $numratings;
		}
		if(isset($score)){
		
		$scoreMsg = "";
		
		if($score >= (80)){
		$scoreMsg = "Level 4";
		}elseif($score >= (76)){
		$scoreMsg = "Level 4";
		}elseif($score >= (65)){
		$scoreMsg = "Level 3";
		}elseif($score >= (50)){
		$scoreMsg = "Level 3";
		}elseif($score >= (27)){
		$scoreMsg = "Level 2";
		}elseif($score >= (15)){
		$scoreMsg = "Level 2";
		}elseif($score >= (0)){
		$scoreMsg = "Level 1";
		}
		echo "It is recommended you start at Reading " . $scoreMsg;
	}else{
		echo "No rating data currently available.";
	}
     // end student level
	 }
}
function default_action($location){
	switch($location){
		case 'home':
			$this->main_home();
			break;
	}
}
}
?>