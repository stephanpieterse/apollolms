<form method="post" action="media.php?pq=mknewFolder" >
<select name="rootDirPath">
<?php
echo print_option("uploads/");
$result = scanMkDir("uploads/","uploads/");
	
	foreach($result as $f){
	 echo print_option($f . "/");
	}
?>
</select>
<input name="newFolderName" value="New Folder Name"/>
<input type="submit" value="Create Folder" />
</form>
