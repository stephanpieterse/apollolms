<!-- production -->
<script type="text/javascript" src="<?php echo SCRIPTS_PATH ?>/plupload/js/plupload.full.min.js"></script>
<div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
<br />

<div id="container">
	Files can be a maximum of 500MB in size.<br>
	Up to 50 Files can be uploaded at one time.<br/>
    <a id="pickfiles" href="javascript:;">[Select files]</a> 
    <a id="uploadfiles" href="javascript:;">[Upload files]</a>
    <a id="clearfiles" href="javascript:;">[Clear files]</a>
</div>

<br />
<pre id="console"></pre>
<script type="text/javascript">


var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('container'), // ... or DOM Element itself
	url : 'uploads.php<?php if(isset($_GET['dir'])){echo '?ppath=' . rawurlencode($_GET['dir']);} ?>',
	flash_swf_url : '<?php echo SCRIPTS_PATH ?>/plupload/js/Moxie.swf',
	silverlight_xap_url : '<?php echo SCRIPTS_PATH ?>/plupload/js/Moxie.xap',
	chunk_size:'1mb',
	
	filters : {
		max_file_size : '500mb',
		max_file_count : '50',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png,tiff"},
			{title : "Zip files", extensions : "zip"},
			{title : "Video files", extensions : "mp4,mpeg,mpg,flv,avi,webm,ogv"},
			{title : "Audio Files", extensions : "mp3,wav,aiff,ogg"},
			{title : "Documents", extensions : "pdf,ppt,pptx,doc,docx,xls,xlsx,odt,odf,ods"},
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

$('#clearfiles').click(function(e) {
    $.each(uploader.files, function(i, file) {
            uploader.removeFile(file);
       });
      document.getElementById('filelist').innerHTML = '';
      document.getElementById('console').innerHTML = '';
});
</script>
