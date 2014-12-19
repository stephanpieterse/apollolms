<script type="text/javascript" src="<?php echo SCRIPTS_PATH;?>passwordfuncs.js"></script>

<?php
	if(!isset($_SESSION['userID'])){
		$shouldLogin = true;
	}else{
		$shouldLogin = false;
	}
?>
	<form class="registerMember" method="post" action="index.php?action=addNewUser&login=<?php echo $shouldLogin; ?>">
	<fieldset>
	<?php if($shouldLogin){echo '<h1><legend>Register as New User</legend></h1>';} ?>
	<label for="name">Full Name & Surname</label>
	<input name="name" type="text" id="name"><br/>
	<label for="emailad">E-Mail Address</label>
	<input class="container" name="emailad" type="text" id="emailad" /><br/><div id="emailTaken"></div>
	<script type="text/javascript">
	document.write('<br/>Generate a password for you?<input type="checkbox" id="genMyPassword" onclick="genPasswordStr(); checkPasswordStr(); hidePasswordArea();" />');
	</script>
	<div id="passwordAreaDiv">
		<label for="regpassword">Password</label>
		<input name="password" type="password" id="regpassword"/>
		
		<script type="text/javascript">document.write('Password Strength:<span tabindex="-1" id="strength">?</span>');</script>
		
		<?php echo tooltip("Remember to use strong passwords!", "Help:FAQ"); ?>
		<!--
		<tr>
		<td>Confirm Password:</td>
		<td><input name="cpassword" type="password" id="cpassword"></td>
		</tr>	
		-->
		<br/>
		<label for="confirmregpassword">Confirm Password</label>
		<input name="confirmpassword" type="password" id="confirmregpassword" /><span id="passwordsmatchspan"></span>
		<br/>
	</div>
	
	<label for="contactnum">Contact Number</label>
<input name="contactnum" type="text" id="contactnum"><br/>
<input class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" id="Submit" role="button" value="Register">
<br/>
</fieldset>
By registering as a new user to the site you verify that you have read and accept the <a href="info/standard_tos.pdf">Terms of Service</a>.
</form>

<script type="text/javascript">
	var emailEl = document.getElementById('emailad');
	emailEl.onkeyup = checkEmailTaken;
	
	var passEl = document.getElementById('regpassword');
	passEl.onkeyup = function(){checkPasswordStr();checkPasswordSame();};
	
	var cpassEl = document.getElementById('confirmregpassword');
	cpassEl.onkeyup = checkPasswordSame;
</script>
