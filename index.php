<?php
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = 'Home';
	//$control->build_site_start();
	//$control->build_header();
	//$control->build_navigation();
	$control->formPre = 'base_form_';
	$control->funcPre = 'base_func_';
	$control->executeControl($_GET, $_POST);
	require("home.php");
//    $control->build_footer();
?>
