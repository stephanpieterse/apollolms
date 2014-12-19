<?php
	$q = "SELECT value FROM site_settings WHERE item='bank_details' LIMIT 1";
	$d = sql_execute($q);
	if(sql_numrows($d) == 1){
	$r = sql_get($d);
	$xmldata = $r['value'];	
	}
?>
<form method="post" action="sitesettings.php?pq=update_bankDetails">
<table class="centerfloat">
<tr><td>Account Number:</td>
<td><input type="text" name="bank_accountnumber" value="<?php if(isset($xmldata)){$tempDat = xmlGetSpecifiedNode($xmldata, array('tagname'=>'bank_accountnumber','value'=>'')); echo $tempDat['value'];} ?>" /></td></tr>
<tr><td>Bank:</td>
<td><select class="fullWidth" name="bank_bankname">
<?php

	$bankNames = array('ABSA','Nedbank','FNB','Standard Bank','Capitec','First Rand Mercantile,','Bank of Athens');
	if(isset($xmldata)){
			$curBankA = xmlGetSpecifiedNode($xmldata, array('tagname'=>'bank_bankname','value'=>''));	
			$curBank = $curBankA['value'];	
		}
	for($x = 0; $x < sizeof($bankNames); $x++){
		$opt = '<option';
		if($curBank == $bankNames[$x]){
			$opt .= ' selected>';
		}else{
			$opt .= '>';
		}
		$opt .= $bankNames[$x];
		$opt .= '</option>';
		
		echo $opt;
	}

?>
</select></td></tr>
<tr><td>Account Type:</td>
<td><select class="fullWidth" name="bank_accounttype">
	<?php

	$accountTypes = array('Savings Account','Transmission Account','Cheque Account');
	if(isset($xmldata)){
			$temp = xmlGetSpecifiedNode($xmldata, array('tagname'=>'bank_accounttype','value'=>''));
			$curAcc = $temp['value'];
		}
	for($x = 0; $x < sizeof($accountTypes); $x++){
		$opt = '<option';
		if($curAcc == $accountTypes[$x]){
			$opt .= ' selected>';
		}else{
			$opt .= '>';
		}
		$opt .= $accountTypes[$x];
		$opt .= '</option>';
		
		echo $opt;
	}

?>
</select></td></tr>
<tr><td>Branch Code:</td>
<td><input type="text" name="bank_branchcode" value="<?php if(isset($xmldata)){$temp = xmlGetSpecifiedNode($xmldata, array('tagname'=>'bank_branchcode','value'=>'')); echo $temp['value'];} ?>" />
<input type="submit" value="Update"/></td></tr>
</table>
</form>