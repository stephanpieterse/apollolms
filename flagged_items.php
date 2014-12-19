<?php
/**
 * @package ApolloLMS
 * */
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'flagged.php';
	$control->formPre = 'flagged_form_';
	$control->funcPre = 'flagged_func_';
	$control->executeControl($_GET,$_POST);
?>
