<?php
/*
 * @author Stephan Pieterse
 * @package ApolloLMS
 * 
 * */

function deleteHelpMsg($msgid){
	$query = 'SELECT * FROM help WHERE id="' . $msgid . '"';
	$result = sql_get(sql_execute($query));
	backupData($result, ("Help message " . $msgid . " " . $result['HELPMSG']), 'help');
	
	$query = 'DELETE FROM help WHERE id="' . $msgid . '"';
	$result = sql_execute($query);
	return 'helpmsg_delete_success';	
}

function base_func_submitHelpMsg(){
//if(isset($_SESSION['userID'])){
	//$username = $_SESSION['userID'];
//}else{
	$username = $_POST['email'];
//}
	$helpmsg = $_POST['msgbox'];
	$helpmsg = makeSafe($helpmsg);
	$timeof = date("y-m-d-h-m");

	$sql="INSERT INTO help(helpmsg, user, date)VALUES('$helpmsg','$username', '$timeof')";
	$result=sql_execute($sql);
	
	mail_inform('bugreport@apollolms.co.za','Help Message from ' . SITE_EMAIL, $helpmsg);
	mail_inform($username,'Help Message from ' . SITE_EMAIL, $helpmsg);
	
	return 'help_message_posted_success';
}

function submitContentRequest($data){
//if(isset($_SESSION['userID'])){
	//$username = $_SESSION['userID'];
//}else{
//}
	$username = $_SESSION['userID'];
	$helpmsg = $data['msgbox'];
	$helpmsg = makeSafe($helpmsg);
	$timeof = date("y-m-d-h-m");

	$sql="INSERT INTO help(helpmsg, user, date)VALUES('$helpmsg','$username', '$timeof')";
	$result=sql_execute($sql);
	
	mail_inform('admin@apollolms.co.za','Content request from ' . SITE_EMAIL, $helpmsg);
	
	return 'success';
}

?>
