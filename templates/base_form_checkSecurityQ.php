<?php
/*
 * @author Stephan Pieterse
 * */

		$typedAns = makeSafe($_POST['secAns']);
		$nameCell = makeSafe($_POST['identifier']);
		$query = "SELECT * FROM tmp_password_reset WHERE email='$nameCell'";
		//$query = "SELECT * FROM members WHERE email='$nameCell' LIMIT 1";
		$result = sql_execute($query);
		$count = sql_numrows($result);
		$row = sql_get($result);
		$dbAns = $row['CODE'];
		
		if(time() > $row['REQUEST_TIME'] + 5400){
			$q = "DELETE FROM tmp_password_reset WHERE email='$nameCell'";
			$d = sql_execute($q);
			page_redirect("index.php",'',array('SITE_ERROR_MSG'=>'The reset request from the specified adress has expired.'));
		}

if($dbAns == $typedAns){
	$_SESSION['nameCell'] = $nameCell;
	
	echo "Please enter a new password:";
	echo '
		<form name="newPassForm" method="post" action="index.php?pq=updatePasswordOnly">
		<input type="text" name="newPass" id="newPass" >
		<input type="submit" name="submit" value="Update">
		</form>"';	
	$q = "DELETE FROM tmp_password_reset WHERE email='$nameCell'";
	$d = sql_execute($q);
	}else{
		sleep(5);
		echo "Supplied code was incorrect";
	}

?>
