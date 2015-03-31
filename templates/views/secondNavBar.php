<?php
/*
 * @author Stephan Pieterse
 * @package ApolloLMS
 * 
 * Link generation / getting for the second level navbar
 * */
?>
<ul class="secondnavbar">
<?php
	chdir(dirname(__FILE__));
	if(isset($VAR_SEC_MENU)){
	if(file_exists('secnav/' . $VAR_SEC_MENU)){
	include('secnav/' . $VAR_SEC_MENU);
	}
	}
?>
</ul>
