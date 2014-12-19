<form method="POST" action="./index.php?aq=rnmeFile&dir=<?php echo $_GET['dir']; ?>&file=<?php echo $_GET['file'];?>">
NAME:
<input style="width:50%;" type="text" name="newFileName" value="<?php echo $_GET['file'];?>" />
<br/>
<input type="submit" value="Rename" />
</form>
