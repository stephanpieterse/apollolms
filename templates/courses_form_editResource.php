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
echo '" >';
?>
Please provide the URL for the resource to be embedded.
	<label for="resname">Name: </label><input style="width:50%;" type="text" id="resname" name="resource_name" value="<?php if(isset($res)){echo $resname;} ?>" /><br/>
	<label for="resurl">URL: </label><input style="width:50%;" type="text" id="resurl" name="resource_url" value="<?php if(isset($res)){echo urldecode($resurl);} ?>" /><br/>
	<input type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>" />
	<?php if(isset($res)){ echo '<input type="hidden" name="resid" value="' . $res . '" />';} ?>
	<input type="submit" value="Submit" />
</form>

Or select a file to upload
<!-- production -->
<script type="text/javascript" src="<?php echo SCRIPTS_PATH ?>/plupload/js/plupload.full.min.js"></script>

<!-- debug 
<script type="text/javascript" src="../js/moxie.js"></script>
<script type="text/javascript" src="../js/plupload.dev.js"></script>
-->
<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />

<div id="container">
	Files can be a maximum of 500MB in size.<br>
    <a id="pickfiles" href="javascript:;">[Select files]</a> 
    <a id="uploadfiles" href="javascript:;">[Upload files]</a>
</div>

<br />
<pre id="console"></pre>
<script type="text/javascript">
// Custom example logic

var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : 'uploads.php<?php if(isset($_GET['dir'])){echo '?ppath=' . rawurlencode($_GET['dir']);} ?>',
	flash_swf_url : '<?php echo SCRIPTS_PATH ?>/plupload/js/Moxie.swf',
	silverlight_xap_url : '<?php echo SCRIPTS_PATH ?>/plupload/js/Moxie.xap',
	chunk_size:'2mb',
	
	filters : {
		max_file_size : '500mb',
		max_file_count : '1',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png,tiff"},
			{title : "Zip files", extensions : "zip"},
			{title : "Video files", extensions : "mp4,mpeg,mpg,flv,avi,webm,ogv"},
			{title : "Audio Files", extensions : "mp3,wav,aiff,ogg"},
			{title : "Documents", extensions : "pdf,ppt,pptx,doc,docx,xls,odt,odf,ods"},
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				uploader.start();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			plupload.each(files, function(file) {
				document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
				document.getElementById('resurl').value= "" + plupload(<?php if(isset($_GET['dir'])){echo rawurlencode($_GET['dir']); } ?>file.name);
			});
		},

		UploadProgress: function(up, file) {
			document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		},

		Error: function(up, err) {
			document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
		}
	}
});

uploader.init();
</script>
