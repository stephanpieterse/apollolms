<p>
You can import a user list via a CSV file with the following format:<br/>
NAME, SURNAME, E-MAIL ADDRESS, CONTACT NUMBER
<br/><br/>
Passwords will be automatically generated for users, and an e-mail will be sent to them with their login details.
</p>
<form enctype="multipart/form-data" action="index.php?action=uplcsvuser" method="post">
Automatically Add Users to Group:<select name="autogroup"><option>0-None</option>
<?php 
	$q = "SELECT * FROM groupslist";
	$r = sql_execute($q);
	while($d = sql_get($r)){
		$opt = '<option>' . $d['ID'] . '-' . $d['NAME'] . '</option>';
		echo $opt;
	}
	?></select>
<br/>
<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
File to upload: <input name="uploadedfile" type="file" /> <br />
<input type="submit" value="Upload" />
</form>