<?php
/**
 * Basic functions for adjusting the settings of the site.
 * 
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * @version 1
 * 
 * */

function settings_func_update_siteLogo($post){
	chdir(dirname(__FILE__));
	$target_path = "media/logo.";
	$ext = strtolower(pathinfo($post['newlogofile']['name'], PATHINFO_EXTENSION));

	$picExtensions = array('jpg','jpeg','png');
	if(in_array($ext, $picExtensions)){

	foreach($picExtensions as $extTest)
	if(file_exists($target_path.$extTest)){
		unlink($target_path.$extTest);
	}
	
	$target_path .= $ext;	

	if(move_uploaded_file($post['newlogofile']['tmp_name'], $target_path)) {
		return true;
	}
	}
	return 'err_upload_logo';
}

function settings_func_update_bulksmsDetails($post){
			$dataID = makeSafe($post['payfastid']);
			$dataKEY = makeSafe($post['payfastkey']);
			
			$dataKEY = simple_encrypt('bulksms', $dataKEY);
			
			$bsData = $dataID . ',' . $dataKEY;
			
			$q = "SELECT id FROM site_settings WHERE item='bulksms_account' LIMIT 1";
			$d = sql_execute($q);
			if(sql_numrows($d) != 1){
				$nq = "INSERT INTO site_settings (item,name) VALUES('bulksms_account','BulkSMS account details')";
				$nd = sql_execute($nq);
			}
			
			$q = "UPDATE site_settings SET value='" . $bsData . "' WHERE item='bulksms_account'";
			$d = sql_execute($q);
			
			return true;
}

function settings_func_update_bankDetails($post){
			$xmldata = '<bank_details></bank_details>';
			foreach($post as $key=>$value){
				$xmldata = addNode($xmldata, $key, array('value'=>makeSafe($value)));
			}
			$q = "SELECT id FROM site_settings WHERE item='bank_details' LIMIT 1";
			$d = sql_execute($q);
			if(sql_numrows($d) != 1){
				$nq = "INSERT INTO site_settings (item,name) VALUES('bank_details','Banking Details')";
				$nd = sql_execute($nq);
			}
			
			$q = "UPDATE site_settings SET value='" . $xmldata . "' WHERE item='bank_details'";
			$d = sql_execute($q);
			
			return true;
	}
	
function settings_func_update_paypalDetails($post){
			$data = makeSafe($post['paypalaccount']);
			$q = "SELECT id FROM site_settings WHERE item='paypal_account' LIMIT 1";
			$d = sql_execute($q);
			if(sql_numrows($d) != 1){
				$nq = "INSERT INTO site_settings (item,name) VALUES('paypal_account','Paypal Account or Merchant ID')";
				$nd = sql_execute($nq);
			}
			
			$q = "UPDATE site_settings SET value='$data' WHERE item='paypal_account'";
			$d = sql_execute($q);
			
			return 'Details succesfully updated';
	}
	
function settings_func_update_payfastDetails($post){
			$dataID = makeSafe($post['payfastid']);
			$dataKEY = makeSafe($post['payfastkey']);
			
			$data = $dataID . ',' . $dataKEY;
			
			$q = "SELECT id FROM site_settings WHERE item='payfast_account' LIMIT 1";
			$d = sql_execute($q);
			if(sql_numrows($d) != 1){
				$nq = "INSERT INTO site_settings (item,name) VALUES('payfast_account,'Payfast Account Details')";
				$nd = sql_execute($nq);
			}
			
			$q = "UPDATE site_settings SET value='$data' WHERE item='payfast_account'";
			$d = sql_execute($q);
			
			return 'success';
	}
	
function settings_func_update_defaultHomepage($post){
		$data = $post['defaultSitePage'];
		$q = "SELECT id FROM site_settings WHERE item='default_homepage' LIMIT 1";
		$d = sql_execute($q);
		if(sql_numrows($d) != 1){
			$nq = "INSERT INTO site_settings (item,name) VALUES('default_homepage','Site default homepage')";
			$nd = sql_execute($nq);
		}
		
		$q = "UPDATE site_settings SET value='$data' WHERE item='default_homepage'";
		$d = sql_execute($q);
		
		return 'success';
	}	
