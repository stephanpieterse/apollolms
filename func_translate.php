<?php
	/**
	 * hierdie is currently bietjie van n fokop, en hierdie code gaan nie werk nie. wat moet gebeur:
	 * @todo standard site words in a db with translations
	 * @todo get translation function
	 * @todo smarty should have placeholders and replace translated sections
	 * @todo eventually content should also have translations submitted or use a google translate api (at a cost)
	 * 
	 * @package ApolloLMS
	 * */

function translate_standard($item, $lang){
	
	$q = "";
	$r = sql_execute($q);
	
}

/**
 * 
 * 
 */
function translate_site_item($itype, $iid, $iarea, $lang){
	
	$q = "SELECT * FROM translations_site WHERE iid='" . $iid . "' AND lang='" . $lang . "' AND type='" . $itype . "' LIMIT 1";
	$r = sql_execute($q);
	if(sql_numrows($r) == 1){
		$d = sql_get($r);
		return $d['TRANSLATION'];
	}else{
		return 0;
	}
	
}

?>
