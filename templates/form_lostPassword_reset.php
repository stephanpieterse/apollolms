<span class="bold">Please enter the security number you received via e-mail:</span><br/>
<form name="secAnsForm" method="post" action="index.php?f=checkSecurityQ">
<?php
echo "<input type=\"hidden\" name=\"identifier\" id=\"identifier\" value=\"$identifiedBy\">";
?>
<input type="text" name="secAns" id="secAns">
<input type="submit" name="Submit" value="Submit">
</form>
