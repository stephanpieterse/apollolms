<?php
	/**
	 * @package ApolloLMS
	 * */
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = 'E-Mail';
	$control->secNav = 'mail.php';
	$control->formPre = 'mail_form_';
	$control->funcPre = 'mail_func_';
	$control->executeControl($_GET,$_POST);
?>
