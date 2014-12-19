<?php
/**
 * The base class for all test items, contains the basic functions that will need to be called by ApolloLMS.
 * Additional can be added of course.
 * 
 * Created by Stephan Pieterse. 
 * 
 */
abstract class test_item {

private $thisClassName = "Test Question Item";
private $thisClassDescription = "Test question abstract template default";
private $thisCanAutoMark = true;
private $thisIsMarkable = true;
private $thisClassNiceName = "Abstract Template";
private $thisClassVersion = '1';

function installTestVars(){
	$retVars['name'] = $this->thisClassName;
	$retVars['description'] = $this->thisClassDescription;
	$retVars['version'] = $this->thisClassVersion;
	return $retVars;
}

function get_class_nicename(){
	return $this->thisClassNiceName;
}

function get_class_name(){
	return $this->thisClassName;
}

function get_class_description(){
	return $this->thisClassDescription;
}

function can_autoMark(){
	return $this->thisCanAutoMark;
}

function is_markable(){
	return $this->thisIsMarkable;
}

function form_insertQuestions(){

}

function markData($xmlData){

}

function printQuestion($questionData){

}
}
?>