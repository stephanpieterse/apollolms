<?php
	include('controller.php');
	$control = new Controller;
	$control->secNav = 'articles.php';
	$control->formPre = 'articles_form_';
	$control->funcPre = 'articles_func_';
	$control->executeControl($_GET,$_POST);
?>