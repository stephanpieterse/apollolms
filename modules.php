<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'modules.php';
	$control->formPre = 'modules_form_';
	$control->funcPre = 'modules_func_';
	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
