<form class="noMarg" name="loginForm" method="post" action="logins.php?pq=checkLogin">
	<input type="hidden" name="fromURL" value="<?php echo selfURL()?>" />	
	<label class="loginlabel" for="login_username">E-Mail:
	<input name="login_username" type="text" placeholder="E-Mail"  autocomplete="off" id="login_username" />
	</label>
	
	<label class="loginlabel" for="login_password">Password:
	<input name="login_password" autocomplete="off" placeholder="Password" type="password" id="login_password">
	</label>
	
	<input class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" id="Submit" role="button" value="Login">
	<br/>
	
	<a href="users.php?f=lostpassword">Recover Lost Password</a>
</form>
