<p>
If you are unable to contact the developer or content managers in any way, please leave a message regarding the problem you are having in the box below. A technician will have a look at the situation and (if possible) contact you regarding the matter.

<form name="msgForm" method="post" action="logins.php?pq=submitHelp">

<?php
	if(!isset($_SESSION['userID'])){
		echo print_bold("E-Mail: ");
		br();
		echo '<input type="text" name="email" />';
		br();
	}else{
		echo '<input type="hidden" name="email" value="user' . $_SESSION['userID'] . '"/>';
	}
	echo print_bold("Message:");
	br()
?>

<textarea type="text" name="msgbox" id="msgbox" cols="125" rows="7">Please enter your comments here</textarea></br>
<input type="submit" name="submit" value="Send Message" >
</form>
</p>
