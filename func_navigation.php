<?php
function generateNiceURL($variables){
	
	$niceref = '/';
	foreach($variables as $key=>$value){
		switch($key){
			
			case 'aq':
				$niceref .= 'admin/';
				$niceref .= $value . '/';
			break;
			case 'uq':
				$niceref .= 'user/';
				$niceref .= $value . '/';
			break;
			case 'gq':
				$niceref .= 'general/';
				$niceref .= $value . '/';
			break;
			case 'action':
				$niceref .= 'action/';
				$niceref .= $value . '/';
			break;
			}
		}
	return $niceref;
	
}

function generateURL($variables){
	$niceref = '/' . 'index' . '.php?';
	
	foreach($variables as $key=>$value){
			$niceref .= $key . '=' . $value;
		}
	
	return $niceref;
	
	}
?>