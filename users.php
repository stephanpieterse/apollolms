<?php
	/**
	 * @author Stephan Pieterse
	 * @package ApolloLMS
	 * */
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'users.php';
	$control->formPre = 'users_form_';
	$control->funcPre = 'users_func_';
	$control->executeControl($_GET,$_POST);
?>
