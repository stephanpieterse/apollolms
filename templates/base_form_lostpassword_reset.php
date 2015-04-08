<?php
/*
 * @author Stephan Pieterse
 * */
 
	$identifiedBy = $_POST['usermail'];
	$identified = false;
			$query = "SELECT * FROM members WHERE email='$identifiedBy' LIMIT 1";
			$result = sql_execute($query);
			$count = sql_numrows($result);
			
	if($count == 1){
				$identified = true;
			}
			
			/*if($count != 1){
					$sqlquery = "SELECT * FROM members WHERE contactnum='$identifiedBy'";
					$result = mysql_query($sqlquery) or die("query failed");
					$newcount = mysql_num_rows($result);
				if($newcount != 1){
					echo "User not found. Please check your spelling and formatting and try again.";
				}else{
					$identified = true;
				}
			}else{
				$identified = true;
			}
			*/
		
	if(!$identified){
		page_redirect("index.php",'',array('SITE_ERROR_MSG'=>'The details you have supplied were invalid.'));
	}
			$email = $identifiedBy;
			$req_time = time();
			$newcode = randomAlphaNum(9);
			
			$q = "DELETE FROM tmp_password_reset WHERE email='$email'";
			$insTemp = sql_execute($q);
			
			$q = "INSERT INTO tmp_password_reset(email,code,request_time) VALUES('$email','$newcode','$req_time')";
			$insTemp = sql_execute($q);
			
			$mailbody = 'A request has been logged to reset a password from this email address. Please enter the supplied code on the page you sent the request from to continue. <br/><br>' . print_bold($newcode);
			mail_inform($email, 'Site password reset request', $mailbody);
		
			$row = sql_get($result);
			
			//echo "Please answer the following security question:</br>";
			//echo $row['SECURITYQUESTION'];
			require ( TEMPLATE_PATH . "form_lostPassword2.php" );
			}

?>
