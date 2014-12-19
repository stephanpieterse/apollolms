<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'resources.php';
	$control->formPre = 'resource_form_';
	$control->funcPre = 'resource_func_';
	$control->executeControl($_GET,$_POST);
?>