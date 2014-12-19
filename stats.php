<?php
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = 'Site Statistics';
	//$control->secNav = 'media.php';
	$control->formPre = 'stats_form_';
	$control->funcPre = 'stats_func_';
	$control->executeControl($_GET,$_POST);
?>
