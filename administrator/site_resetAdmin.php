<?php
/**
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS Admin
 * @description Basic functions to restore 2 superuser admins to default settings
 * */

require('../config.php');

if(isset($_GET['admin']) && ($_GET['admin'] == 'site')){
	reset_siteadmin();
}else{
	reset_admin();
}

/**
 * Hard reset the developer superadmin to defaults.
 * */
function reset_admin()
{
	$q = "SELECT * FROM members WHERE email='pietersestephan@gmail.com'";
	$d = sql_execute($q);
	
	while ($row = sql_get($d)){
	    if('pietersestephan@gmail.com' == $row['EMAIL']){
	        $currentID = $row['ID'];
			$q = "DELETE FROM members WHERE id='$currentID'";
			sql_execute($q);
	        break;
	    }
	}
	
	$emailad = 'pietersestephan@gmail.com';
	$name = 'Stephan Pieterse';
	$password = 'slet2697';
	$password = substr($emailad,0,5) . $password;
	$password = hash('sha512',$password);
	
	$regdate = date("Y-m-d-H-i-s");
	$secuA = "You Wont believe it but No it is ! not";
	$secuQ = "Not that easy...";

	$firsttime = '0';
	$groups = "<groups></groups>";
	$gender = '0';
	$contactnum = '0814670705';
	$locked = '1';
	
	$q = $sql="INSERT INTO members(regdate, password, name, email, role, contactnum, firsttime, securityquestion, securityanswer, groups, locked)VALUES('$regdate','$password', '$name', '$emailad', 'admin', '$contactnum', '$firsttime', '$secuQ', '$secuA', '$groups','$locked')";
	$d = sql_execute($q);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=controller.php">';
}

/**
 * Resets the site admin to the default db listed settings
 * 
 * */
function reset_siteadmin()
{
	$q = "SELECT * FROM members WHERE email='" . SITE_EMAIL . "'";
	$d = sql_execute($q);
	
	while ($row = sql_get($d)){
	    if(SITE_EMAIL == $row['EMAIL']){
	        $currentID = $row['ID'];
			$q = "DELETE FROM members WHERE id='$currentID'";
			sql_execute($q);
	        break;
	    }
	}
	
	$emailad = SITE_EMAIL;
	$name = 'Site Admin';
	$password = DB_PASSWORD;
	$password = substr($emailad,0,5) . $password;
	$password = hash('sha512',$password);
	$regdate = date("Y-m-d-H-i-s");
	$secuA = "You Wont believe it but No it is ! not";
	$secuQ = "Not that easy...";
	
	$firsttime = '0';
	$groups = "<groups></groups>";
	$gender = '0';
	$locked = '1';
		
	$q = $sql="INSERT INTO members(regdate, password, name, email, role,  firsttime, securityquestion, securityanswer, groups, locked)VALUES('$regdate','$password', '$name', '$emailad', 'admin', '$firsttime', '$secuQ', '$secuA', '$groups', '$locked')";
	$d = sql_execute($q);
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=controller.php">';
}
?>
