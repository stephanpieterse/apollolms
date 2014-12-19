<?php
	/**
	 * @author Stephan Pieterse
	 * @package ApolloLMS
	 * */
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'users.php';
	$control->formPre = 'login_form_';
	$control->funcPre = 'login_func_';
	$control->executeControl($_GET,$_POST);
?>
