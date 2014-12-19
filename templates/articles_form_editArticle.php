<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	if(isset($_GET['aid'])){
	$aid = $_GET['aid'];
	$q = "SELECT * FROM articles WHERE id='$aid' LIMIT 1";
	$r = sql_execute($q);
	$data = sql_get($r);
	}
	$cid = $_GET['cid'];
?>
<?php
if(isset($aid)){
echo '<form method="POST" action="articles.php?pq=updateArticle">';
echo '<input type="hidden" name="id" value="' . $aid . '" />';
}else{
echo '<form method="POST" action="articles.php?pq=addNewArticle">';
echo '<input type="hidden" name="courseID" value="' . $cid . '" />';
}
?>
<div style="border: 1px solid; padding: 5px;">
<table>
<tr>
<td width="150px;">Article name:</td><td>
<input type="text" name="articleName" value="<?php if(isset($aid)){echo $data['NAME'];}?>" /></td>
</tr>
<tr>
<td>Description:</td><td>
<input type="text" name="articleDescription" value="<?php if(isset($aid)){echo $data['DESCRIPTION'];} ?>" /></td>
</tr>
<tr>
<td>Code:</td><td><input type="text" name="articleCode" value="<?php if(isset($aid)){ echo $data['CODE'];} ?>" /></td>
</tr>
<tr>
<td>Published:</td>
<td>
<select name="publishedStatus">
<option>Yes</option>
<option>No</option>
</select>
</td>
</tr>
</table>
</div>
<span class="bold">Page Content:</span>
<textarea id="pageContent" name="pageContent">
<?php
if(isset($aid)){
	echo $data['HTML_CONTENT'];
}
?></textarea>
<br/>
<?php
if(isset($aid)){
echo '<input type="submit" name="save" value="Save" />';
echo '<input type="submit" name="saveCont" value="Save & Continue" />';
}else{
echo '<input type="submit" value="Add New Article" />';
}
?>
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'pageContent' );
        CKEDITOR.replace( 'articleDescription' );
		CKEDITOR.config();
    };
</script>