<?php
	include('controller.php');
	$control = new Controller;
	//$control->secNav = 'tests.php';
	$control->formPre = 'public_';
	$control->funcPre = 'public_func_';
	$control->executeControl($_GET,$_POST);
?>
