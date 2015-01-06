<form method="POST" action="media.php?pq=renameFile">
<input type="hidden" name="orignalName" value="<?php echo $_GET['dir'] . $_GET['file']?>" />
NAME:
<input style="width:50%;" type="text" name="newName" value="<?php echo $_GET['file'];?>" />
<br/>
<input type="submit" value="Rename" />
</form>
