<?php

	require('../config.php');

	$oldUrls = $_POST['oldurls'];
	$newUrls = $_POST['newurls'];

	$q = "SELECT * FROM courses";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		
		$haystack = $r['DESCRIPTION'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE courses SET description='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
		
		$haystack = $r['HTML_CONTENT'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE courses SET html_content='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
		
		$haystack = $r['ARTICLES'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE courses SET articles='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
		
	}
	
	$q = "SELECT * FROM articles";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		
		$haystack = $r['DESCRIPTION'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE articles SET description='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
		
		$haystack = $r['HTML_CONTENT'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE articles SET html_content='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
	
		$haystack = $r['PAGES'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE articles SET pages='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
		
	}
	
	$q = "SELECT * FROM pages";
	$d = sql_execute($q);
	
	while($r = sql_get($d)){
		
		$haystack = $r['HTML_CONTENT'];
		$newstr = str_ireplace($oldUrls, $newUrls, $haystack);
		
		$nq = "UPDATE pages SET html_content='$newstr' WHERE id='" . $r['ID'] . "'";
		$nd = sql_execute($nq);
		
	}
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=controller.php">';

?>
