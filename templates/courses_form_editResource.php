<?php
	if(isset($_GET['resid'])){
		$res = $_GET['resid'];
		$q = "SELECT ARTICLES FROM courses WHERE id='" . $_GET['cid'] . "' LIMIT 1";
		$r = sql_execute($q);
		$d = sql_get($r);
		$data = $d['ARTICLES'];
		
		$nodedata = xmlGetSpecifiedNode($data, array('tagname'=>'resource','id'=>$res,'url'=>'','name'=>''));
		$resname = $nodedata['name'];
		$resurl = $nodedata['url'];
	}
?>
<form method="post" action="<?php
if(!isset($res)){
	echo 'courses.php?pq=addResource';
}else{
	echo 'courses.php?pq=updateResource';
}
?>
>
Please provide the URL for the resource to be embedded.
	<label for="resname">Name: </label><input style="width:50%;" type="text" id="resname" name="resource_name" value="<?php if(isset($res)){echo $resname;} ?>" /><br/>
	<label for="resurl">URL: </label><input style="width:50%;" type="text" id="resurl" name="resource_url" value="<?php if(isset($res)){echo urldecode($resurl);} ?>" /><br/>
	<input type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>" />
	<?php if(isset($res)){ echo '<input type="hidden" name="resid" value="' . $res . '" />';} ?>
	<input type="submit" value="Submit" />
</form>
Or select a file from Media
