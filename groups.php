<?php
	/**
	 * @package ApolloLMS
	 * */
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'groups.php';
	$control->formPre = 'groups_form_';
	$control->funcPre = 'groups_func_';
	$control->protectedPages = true;
	$control->executeControl($_GET,$_POST);
?>
