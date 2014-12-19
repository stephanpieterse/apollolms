<?php
	/**
	 * @package ApolloLMS
	 * */
	include('controller.php');
	$control = new Controller;
//	$control->secNav = 'groups.php';
	$control->formPre = 'help_form_';
	$control->funcPre = 'help_func_';
	$control->executeControl($_GET,$_POST);
?>
