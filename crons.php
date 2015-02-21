<?php
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = 'CRON Job Management';
	$control->formPre = 'cron_form_';
	$control->funcPre = 'cron_func_';
//	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
