<?php
/**
 * PCD Form moduleVars
 * 
 * Designed for use by Woord en Lewe
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS Module
 * */
class mod_wnl_pcd_form extends module_item{

	private $myID = 0;
	private $moduleVars = array('MVER'=>'1','MTYPE'=>'group','MNAME'=>'PCD Form','MDESC'=>'This module contains the PCD (Pastoral Continuous Development) form to be filled in by members to keep track of their progress.');
	public $plugin_support = array('admin_user_view_single','admin_user_view_single_link');	
	public $css_needs = array('pcd_form/pcd.css');
	
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

function showPCDMenu(){
	include('pcd_form/pcd_menu.php');
}

function removeFormItem($data){
	if($data == -1){
		if(isset($_GET['md1'])){
			$uid = $_GET['md1'];	
		}
	}else{
		if(is_array($data)){
		$uid = $data['md1'];
		}else{	
		$uid = $data;
		}
	}
	
	$removeNum = $_GET['num'];
	
	$q = "SELECT * FROM module_storage WHERE mid='". $this->myID . "' AND data1='" . $uid . "' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$newXML = rmNodeX($r['DATA2'], $removeNum);
	
	$q = "UPDATE module_storage SET data2='" . $newXML . "' WHERE mid='". $this->myID . "' AND data1='" . $uid . "'";
	$d = sql_execute($q);
}

function showItemReport($data){
	if($data == -1){
		if(isset($_GET['md1'])){
			$uid = $_GET['md1'];	
		}
	}else{
		if(is_array($data)){
		$uid = $data['md1'];
		}else{	
		$uid = $data;
		}
	}
	
	$reportNum = $_GET['rn'];
	
	$q = "SELECT * FROM module_storage WHERE mid='". $this->myID . "' AND data1='" . $uid . "' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
		
	$xmlDoc = new DOMDocument;
	if($r['DATA2'] == ""){
	$xmlDoc->loadXML('<root></root>');
	}else{
	$xmlDoc->loadXML($r['DATA2']);	
	}
	
	$rootNode = $xmlDoc->documentElement;

	$pcditem = $rootNode->childNodes->item($reportNum)->getAttribute('item');
	
	$pcdreport = $rootNode->childNodes->item($reportNum)->childNodes->item(0)->nodeValue;		
	
	echo 'Report for: ' . $uid . '</br>';
	echo $pcditem;
	echo '<br/>';
	echo $pcdreport;
}

function showAllPCDEntries(){
	$q = "SELECT id,name FROM members";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		$usernames[$r['id']] = $r['name'];
	}
	
	$q = "SELECT * FROM module_storage WHERE mid='". $this->myID . "'";
	$d = sql_execute($q);
	while($r = sql_get($d)){
		
		//$currentUser = $r['DATA1'];	
		$currentUser = $usernames[$r['DATA1']];
		/*
		$xmlDoc = new DOMDocument;
		if($r['DATA2'] == ""){
		$xmlDoc->loadXML('<root></root>');
		}else{
		$xmlDoc->loadXML($r['DATA2']);	
		}
		
		$rootNode = $xmlDoc->documentElement;
		
		
		foreach($rootNode->childNodes as $child){
			$pcditem = $child->getAttribute('item');
			$pcdhours = $child->getAttribute('hours');
			
			$tableitem[] = '<tr><td>'.$pcditem.'</td><td>'.$pcdhours.'</td></tr>';
		}
			
		 * 
		 */
		 	$pcditems = $this->pcd_XmlToArr($r['DATA2']);
		 	foreach($pcditems as $form){
		 		$tableitem[] = '<tr><td>'.$form['item'].'</td><td>'.$form['hours'].'</td></tr>';
		 	}
		 
			$currenttable = '<table class="admin_view_table">';
			$currenttable .= '<tr><th>ITEM</th><th>HOURS</th></tr>';
			if(isset($tableitem)){
			foreach($tableitem as $tdi){
				$currenttable .= $tdi;
			}
			}
			$currenttable .= '</table>';
		
			echo $currentUser;
			echo $currenttable;
	}
}

function showPCDForm($data = -1){
	if($data == -1){
		if(isset($_GET['md1'])){
			$uid = $_GET['md1'];	
		}
	}else{
		if(is_array($data)){
		$uid = $data['md1'];
		}else{	
		$uid = $data;
		}
	}
	
	$q = "SELECT * FROM module_storage WHERE mid='". $this->myID . "' AND data1='" . $uid . "' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
		
	$xmlDoc = new DOMDocument;
	if($r['DATA2'] == ""){
	$xmlDoc->loadXML('<root></root>');
	}else{
	$xmlDoc->loadXML($r['DATA2']);	
	}
	
	$rootNode = $xmlDoc->documentElement;
	
	$curChildNode = 0;
	foreach($rootNode->childNodes as $child){
		$pcditem = $child->getAttribute('item');
		$pcdhours = $child->getAttribute('hours');
		
		$pcdreport = $child->childNodes->item(0)->nodeValue;
		
		$tableitem[] = '<tr><td>'.$pcditem.'</td><td>'.$pcdhours.'</td><td><a target="_blank" href="index.php?mi=' . $this->myID . '&mq=showItemReport&md1=' . $uid . '&rn=' . $curChildNode . '"><img src="' . ICONS_PATH . 'page_white_stack.png" /> View Report (New Window)</a></td><td><a href="index.php?mi=' . $this->myID . '&mq=removeFormItem&md1=' . $uid . '&num=' . $curChildNode . '"><img src="' . ICONS_PATH . 'cancel.png" /> Remove Item</a></td></tr>';
		$curChildNode++;
	}
		
		$currenttable = '<table class="admin_view_table pcdTable">';
		if(isset($tableitem)){
		foreach($tableitem as $tdi){
			$currenttable .= $tdi;
		}
		}
		$currenttable .= '</table>';
		
	$FORMLAYOUT = '
	<span class="bold">Add an item:</span>
	<form method="post" action="index.php?mi=' . $this->myID . '&mq=saveUpdatedPCDForm">
	<input type="hidden" name="pcd_user" value="'.$_SESSION['userID'].'"/>
	Item:<br/>
	<input class="fullWidth" type="text" name="pcdentry_item" /><br/>
	Hours:<br/>
	<input class="shortInput" type="text" name="pcdentry_hours" /><br/>
	Item Report:<br/>
	<textarea class="fullWidth" type="text" name="pcdentry_report" /></textarea><br/>
	<input type="submit" value="Update" />
	</form>
	';
	
	echo '<style type="text/css">';
	include(MODULE_PATH . 'pcd_form/pcd.css');
	echo '</style>';
	echo $currenttable;
	echo $FORMLAYOUT;
	
}

function installModuleVars(){
		$varArray['name'] = $this->get_module_name();
		$varArray['description'] = $this->get_module_description();
		$varArray['version'] = $this->get_module_version();
		
	return $varArray;
	}

function saveUpdatedPCDForm($thisUser = 0){
		$item = makeSafe($_POST['pcdentry_item']);
		$hours = makeSafe($_POST['pcdentry_hours']);
		$report = makeSafe($_POST['pcdentry_report']);
		
		if(isset($_POST['pcd_user'])){
		$thisUser = $_POST['pcd_user'];
		}
	
		$q = "SELECT * FROM module_storage WHERE mid='" . $this->myID . "' AND data1='" . $thisUser . "'";
		$r = sql_execute($q);
		if(sql_numrows($r) == 0){
			$rd = "<pcdentries></pcdentries>";
			$nodeChildren = array('report'=>$report);
			$newXML = addNode($rd, 'entry', array('item'=>$item,'hours'=>$hours));	
			$newXML = addNodeChildren($newXML, 'entry', array('item'=>$item), $nodeChildren);
			
		$q = "INSERT INTO module_storage (mid,data1,data2) VALUES ('".$this->myID."','$thisUser','".$newXML."')";
		$r = sql_execute($q);
		}
		else
		{
			$d = sql_get($r);
			if($d['DATA2'] != ""){
				$rd = $d['DATA2'];
			}else{
				$rd = "<pcdentries></pcdentries>";
			}
			
			$nodeChildren = array('report'=>$report);
			$newXML = addNode($rd, 'entry', array('item'=>$item,'hours'=>$hours));	
			$newXML = addNodeChildren($newXML, 'entry', array('item'=>$item), $nodeChildren);
			
		$q = "UPDATE module_storage SET data2='".$newXML."' WHERE mid='".$this->myID."' AND data1='$thisUser'";
		$r = sql_execute($q);
		}
		
		$url = 'index.php?mi=' . $this->myID . '&mq=showPCDForm&md1=' . $_SESSION['userID'];
		page_redirect($url);
}

function default_action_profile(){
		if(isset($_GET['uid'])){
			$uid = $_GET['uid'];
		}else{
			$uid = $_SESSION['userID'];
		}
		
		$link = '<a href="index.php?mi=' . $this->myID . '&mq=showPCDForm&md1=' . $uid . '">My PCD Form</a>';
		echo $link;
		
	//	$this->showPCDForm($uid);	
	}
	
function default_action_user_item(){
		$uid = $_GET['uid'];
		echo "load form for user $uid";
	}

function default_action_admin_nav_item(){
	//$img  = '<img src="' . ICONS_PATH . 'cog.png"/>';
	$img  = '<img src="' . MODULE_PATH . 'pcd_form/page_white_stack.png"/>';
	$link = '<li><a href="index.php?mi=' . $this->myID . '&mq=showPCDMenu">' . $img . 'PCD Form</a></li>';
	
	echo $link;
	//return array('link'=>$link,'img'=>$img);
}

function default_action($location){
		switch($location){
			case 'course_create':
				//	$this->default_action_course_create();
					break;
			
			case 'profile':
				$this->default_action_profile();
				break;
			case 'user_item':
				$this->default_action_user_item();
			break;
			case 'adminnav':
				$this->default_action_admin_nav_item();
			break;
			case 'navbar':
				echo '<li><a href="index.php?mi=' . $this->myID . '&mq=showPCDForm&md1=' . $_SESSION['userID'] . '">PCD Form</a></li>';
			break;
		}
	}

function pcd_ArrToXml($arr){
	
}

function pcd_XmlToArr($xml){
	$xmlDoc = new DOMDocument;
		if($xml == ""){
		$xmlDoc->loadXML('<root></root>');
		}else{
		$xmlDoc->loadXML($xml);	
		}
		
		$rootNode = $xmlDoc->documentElement;
		
		$pcd = array();
		$x = 0;
		foreach($rootNode->childNodes as $child){
			$pcd[$x]['item'] = $child->getAttribute('item');
			$pcd[$x]['hours'] = $child->getAttribute('hours');
			$x++;
		}
	return $pcd;
}

function m_plugin_handler($type,$data){
	if(!in_array($type, $this->plugin_support)){
		return array();
	}
	
	$pluginFunc = 'm_plug_' . $type;
	return $this->$pluginFunc($data);
}
	
function m_plug_admin_user_view_single($data){
	$uid = $data['ID'];
	
	$q = "SELECT * FROM module_storage WHERE mid='" . $this->myID . "' AND data1='" . $uid . "' LIMIT 1";
	$d = sql_execute($q);
	$r = sql_get($d);
	
	$pcditems = $this->pcd_XmlToArr($r['DATA2']);
	return array('content'=>$pcditems);
}

function m_plug_admin_user_view_single_link($data){
	$uid = $data['ID'];
	
	/*
	 * $retarr['LINKS'] = array('PCD Form'=>'<a href="index.php?mi=' . $this->myID . '&mq=showPCDForm&md1=' . $uid . '">PCD Form</a>');
	 * 
	 */
	
	return array('links'=>array('PCD Form'=>'<a href="index.php?mi=' . $this->myID . '&mq=showPCDForm&md1=' . $uid . '">PCD Form</a>'));

}
}
?>
