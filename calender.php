<?php
/**
 * @package ApolloLMS
 * */
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'calender.php';
	$control->formPre = 'calender_form_';
	$control->funcPre = 'calender_func_';
	$control->executeControl($_GET,$_POST);
?>
