<?php
/*
 * @author Stephan Pieterse
 * */
	$smarty = new Smarty;
	
	$query = "SELECT * FROM archived_data";
	$result = sql_execute($query);
	
	if(sql_numrows($result) == 0){
		echo "There are no items in the archive.";	
	}
	
	$cc = 0;
	while($data = sql_get($result)){
		$bdata[$cc]['DATE'] =  $data['DATE'];
		$bdata[$cc]['ID'] =  $data['ID'];
		$bdata[$cc]['COMMENTS'] =  $data['COMMENTS'];
		$cc++;
	}
	
	$smarty->assign('iconsPath',ICONS_PATH);
	$smarty->assign('bdata',$bdata);
	$tplName = changeExtension(pathinfo(__FILE__,PATHINFO_BASENAME),'tpl');
	$smarty->display($tplName);
