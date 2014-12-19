<?php
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = '';
	//$control->secNav = 'media.php';
	$control->formPre = 'billing_form_';
	$control->funcPre = 'billing_func_';
	$control->executeControl($_GET,$_POST);
?>
