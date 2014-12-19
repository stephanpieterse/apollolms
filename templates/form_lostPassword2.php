<form name="secAnsForm" method="post" action="index.php?action=checkSecurityQ">
<?php
echo "<input type=\"hidden\" name=\"identifier\" id=\"identifier\" value=\"$identifiedBy\">";
?>
<input type="text" name="secAns" id="secAns">
<input type="submit" name="Submit" value="Submit">
</form>