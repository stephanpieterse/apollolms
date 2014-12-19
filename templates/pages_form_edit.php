<?php
	if(isset($_GET['pid'])){
	$pid = $_GET['pid'];
	$q = "SELECT * FROM pages WHERE id='$pid' LIMIT 1";
	$r = sql_execute($q);
	$data = sql_get($r);
	}

$aid = $_GET['aid'];
if(isset($pid)){
echo '<form method="POST" action="index.php?aq=upd_page&pid=' . $pid . '">';
}else{
echo '<form method="POST" action="index.php?aq=add_page&aid=' . $aid . '">';
}
?>
<label for="pageName"><b>Name:</b>
<input id="pageName" type="text" name="pageName" value="<?php if(isset($pid)){echo $data['NAME'];}?>" />
</label>
<br />
<textarea id="pageContent" name="pageContent">

<?php
if(isset($pid)){
	echo $data['HTML_CONTENT'];
	}
?></textarea>
<br/>

<?php
if(isset($pid)){
echo '<input type="submit" name="save" value="Save" />';
echo '<input type="submit" name="saveCont" value="Save & Continue" />';
}else{
echo '<input type="submit" value="Add Page" />';
}
?>
</form>
<script type="text/javascript" src="/scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'pageContent' );
    };
</script>
