<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'tests.php';
	$control->formPre = 'test_form_';
	$control->funcPre = 'test_func_';
	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
