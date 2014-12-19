<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'events.php';
	$control->formPre = 'events_form_';
	$control->funcPre = 'events_func_';
	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
