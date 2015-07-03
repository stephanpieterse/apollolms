<form name="newFolderForm" method="post" action="media.php?pq=mknewFolder" >
<?php
 if(isset($_GET['dir']){
	$pdir = makeSafe($_GET['dir']) . '/';
	}else{
	$pdir = "uploads/";
	}
?>
<input name="newFolderName" value="New Folder Name"/>
<input type="hidden" name="rootDirPath" value="<?php echo $pdir; ?>"/>
<input type="submit" value="Create Folder" />
</form>
