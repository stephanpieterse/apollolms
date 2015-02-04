<?php
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = 'Media Management';
	$control->secNav = 'media.php';
	$control->formPre = 'media_form_';
	$control->funcPre = 'media_func_';
	$control->protectedPages = true;
	$control->slimPage = true;
	$control->executeControl($_GET,$_POST);
?>
