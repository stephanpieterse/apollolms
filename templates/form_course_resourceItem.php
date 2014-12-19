<?php
	if(isset($_GET['resid'])){
		$res = $_GET['resid'];
		$q = "SELECT ARTICLES FROM courses WHERE id='" . $_GET['cid'] . "' LIMIT 1";
		$d = sql_execute(sql_get($q));
		$data = $d['ARTICLES'];
		
		$nodedata = xmlGetSpecifiedNode($data, array('tagname'=>'resource','url'=>'','name'=>''));
		$resname = $nodedata['name'];
		$resurl = $nodedata['url'];
	}
?>

Please provide the URL for the resource to be embedded.
<form method="post" action="<?php
if(!isset($res)){
	echo 'index.php?aq=add_course_res&cid=';
}else{
	echo 'courses.php?q=updateResource&resid=' . $res . '&cid=';
}
?>
<?php echo $_GET['cid']; ?>">
	Name: <input style="width:50%;" type="text" name="resource_name" value="<?php if(isset($res)){echo $resname;} ?>" /><br/>
	URL: <input style="width:50%;" type="text" name="resource_url" value="<?php if(isset($res)){echo $resurl;} ?>" /><br/>
	<input type="submit" value="Submit" />
</form>