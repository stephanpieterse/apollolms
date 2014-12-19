<?php
	include('controller.php');
	$control = new Controller;
	$control->_SITE_TITLE = 'Home';
	$control->build_site_start();
	$control->build_header();
	$control->build_navigation();
	require("home.php");
//	$control->executeControl($_GET, $_POST);
    $control->build_footer();
?>