<form autocomplete="off" class="noMarg" name="loginForm" method="post" action="users.php?pq=checkLogin">
<input type="hidden" name="fromURL" value="<?php echo selfURL()?>" />
<label class="loginlabel" for="username">E-Mail:
<input name="username" type="text" autocomplete="off" id="username" />
</label>
<label class="loginlabel" for="password">Password:
<input name="password" autocomplete="off" type="password" id="password">
</label>
<input class="ui-button ui-widget ui-state-default ui-corner-all" type="submit" id="Submit" role="button" value="Login">
<br/>
<a href="index.php?action=lostpassword">Recover Lost Password</a>
</form>
