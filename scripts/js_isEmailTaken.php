<?php

include('../config.php');

$wantEmail = $_GET['email'];
$taken = false;

$q = "SELECT email FROM members";
$d = sql_execute($q);
while($r = sql_get($d)){
	if($r['email'] == $wantEmail){
		$taken = true;
	}
}

if($taken){
echo 'This email is already in use.';
}else{
echo 'This email is available.';
}

?>