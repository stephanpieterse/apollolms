<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'roles.php';
	$control->formPre = 'roles_form_';
	$control->funcPre = 'roles_func_';
	$control->executeControl($_GET,$_POST);
?>