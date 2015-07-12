<?php
    $smarty = new Smarty;

	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);

