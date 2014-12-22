<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'courses.php';
	$control->formPre = 'courses_form_';
	$control->funcPre = 'courses_func_';
	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
