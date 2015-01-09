<?php
	if(isset($_GET['resid'])){
		$res = $_GET['resid'];
		$q = "SELECT PAGES FROM articles WHERE id='" . $_GET['aid'] . "' LIMIT 1";
		$d = sql_get(sql_execute($q));
		$data = $d['PAGES'];
		
		$nodedata = xmlGetSpecifiedNode($data, array('tagname'=>'resource','id'=>$resid,'url'=>'','name'=>''));
		$resname = $nodedata['name'];
		$resurl = $nodedata['url'];
	}
?>

<form method="post" action="<?php
if(!isset($res)){
	echo 'articles.php?pq=addResource" >';
}else{
	echo 'articles.php?pq=updateResource" >';
}
?>
<input type="hidden" name="resid" value="<?php echo isset($res) ? $res : ''; ?>" /> 
<input type="hidden" name="aid" value="<?php echo isset($_GET['aid']) ? $_GET['aid'] : ''; ?>" /> 
Please provide the URL for the resource to be embedded.
	<label for="resn">Name: </label><input style="width:50%;" type="text" id="resn" name="resource_name" value="<?php if(isset($res)){echo $resname;} ?>" /><br/>
	<label for="resurl">URL: </label><input style="width:50%;" type="text" id="resurl" name="resource_url" value="<?php if(isset($res)){echo urldecode($resurl);} ?>" /><br/>
	<input type="hidden" name="aid" value="<?php echo $_GET['aid']; ?>" />
	<?php if(isset($res)){ echo '<input type="hidden" name="resid" value="' . $res . '" />';} ?>
	<input type="submit" value="Submit" />
</form>
