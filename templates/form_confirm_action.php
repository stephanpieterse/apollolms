<?php
function c_rebuild_url_confirmed($data){
	$scriptname = pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME);
	$newLink = $scriptname . '?'; 
	foreach($data as $key=>$val){
		if($key != 'confirm'){
			$newLink = $newLink . "&" .$key . "=" . $val;
			}
	}
//	$newLink = $newLink . 'msg=' . $msg;
	// $newLink = '<META HTTP-EQUIV="Refresh" Content="0; URL=' . $newLink . '">';
	//echo $newLink;
	page_redirect($newLink);
}

if((isset($_POST['submit']) || isset($_GET['submit'])) && $_GET['confirm'] == 1){
	c_rebuild_url_confirmed($_GET);
}else{
	include("form_confirmpage.php");
}
?>
