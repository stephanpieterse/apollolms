<form method="POST" action="media.php?pq=renameFile">
<input type="hidden" name="orignalName" value="<?php echo $_GET['dir'] . $_GET['file']?>" />
<input type="hidden" name="originalDir" value="<?php echo $_GET['dir'] ?>" />
NAME:
<input style="width:50%;" type="text" name="newName" value="<?php echo $_GET['file'];?>" />
<br/>
<input type="submit" value="Rename" />
</form>
