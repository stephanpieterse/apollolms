<?php
/**
 * @package ApolloLMS
 * @author Stephan Pieterse
 * */
?>
<form method="post" action="media.php?pq=moveMedia" >
<select name="rootDirPath">

<?php
	echo print_option("uploads/");
	$result = scanMkDir("uploads/","uploads/");
	
	foreach($result as $f){
	echo print_option($f . "/");
	}
?>

</select>

<input type="hidden" name="dir" value="<?php echo $_GET['dir'];?>" />
<input type="hidden" name="file" value="<?php echo $_GET['file'];?>" />
<input type="submit" value="Move To Folder" />
</form>
