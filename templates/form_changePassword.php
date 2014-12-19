<form autocomplete="off" name="newPassForm" method="post" action="index.php?action=updatePasswordOnly">
	<label for="newPass">Enter a new password:</label>
	<input autocomplete="off" type="password" name="newPass" id="newPass" />
	<input type="hidden" name="nameCell" id="nameCell" value="<?php ?>" />
	<input type="submit" name="submit" value="Update" />
</form>

