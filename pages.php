<?php
	/**
	 * @package ApolloLMS
	 * */
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'pages.php';
	$control->formPre = 'pages_form_';
	$control->funcPre = 'pages_func_';
	$control->executeControl($_GET,$_POST);
?>
