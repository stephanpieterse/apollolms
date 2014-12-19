<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'backup.php';
	$control->formPre = 'backup_form_';
	$control->funcPre = 'backup_func_';
	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
