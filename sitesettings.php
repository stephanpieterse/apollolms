<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'sitesettings.php';
	$control->formPre = 'settings_form_';
	$control->funcPre = 'settings_func_';
	$control->executeControl($_GET, $_POST);	
?>
