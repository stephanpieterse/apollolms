<?php
/**
 * This function file thing retrieves a relative or absolute url from a get variable, tries to figure out what the media type is and then displays it
 * 
 * @author Stephan
 * @package ApolloLMS
 * @version 1.0.0
 *
 * @TODO fix swf loading code
 */
	include('controller.php');
	$control = new Controller;
	$control->build_site_start();
	$control->build_header();
	$control->build_navigation();
	
if(isset($_GET['ref'])){
	$refurl = $_GET['ref'];
}
	
if(isset($_GET['f'])){
	$file = ($_GET['f']);

	chdir(dirname(__FILE__));
	
	require_once(CLASS_PATH . 'getid3/getid3/getid3.php');
	$mediaData = new getID3;
	
	if(!fopen($file,'r')){
		echo "<p>The specified file could not be opened. Please contact your site / course administrator or report this page to have the issue resolved. We apologise for any inconvenience caused. </p>";
	}else{

	$downloaddir = "symlinks/";
	$filename = pathinfo($file,PATHINFO_BASENAME);
	$safedir = pathinfo($file,PATHINFO_DIRNAME);
	
	$letters = 'abcdefghijklmnopqrstuvwxyz';
	srand((double) microtime() * 1000000);
	$string = '';
	for ($i = 1; $i <= rand(4,12); $i++) {
	$q = rand(1,24);
	$string = $string . $letters[$q];
	}
	
	//$handle = opendir($downloaddir);
	//while ($dir = readdir($handle)) {
//	if (is_dir($downloaddir . $dir)){
//		if ($dir != "." && $dir != ".."){
//			@unlink($downloaddir . $dir . "/" . urlencode($filename));
//			@rmdir($downloaddir . $dir);
//		}
//	}
//	}
	//closedir($handle);
//	mkdir($downloaddir . $string, 0777);
//	$fullsafelink = $downloaddir . $string . "/" . urlencode($filename);
	//symlink($safedir . urlencode($filename), $fullsafelink);
	
	//$isurl = check_is_valid_url($file);
	$fileExt = pathinfo($file, PATHINFO_EXTENSION);
	
	$desktop = false;
if($_SESSION['userAgent'] == 'desktop') {
	$desktop = true;
	$objWidth = 720;
	$objHeight = 576;
	}else{
	$objWidth = 320;
	$objHeight = 240;
	}
	
switch($fileExt){
	case 'mpg':
	case 'mpeg':
		$mimetype = "video/mpeg";
		$toload = "jplayer_video";
		$mediaInfo = $mediaData->analyze($file);
		if($desktop){
		$objWidth = isset($mediaInfo['video']['resolution_x']) ? $mediaInfo['video']['resolution_x'] : $objWidth;
		$objHeight = isset($mediaInfo['video']['resolution_y']) ? $mediaInfo['video']['resolution_y'] : $objHeight;
		if($objWidth > 720){
			$objWidth = $objWidth / 2;
			$objHeight = $objHeight / 2;
		}
		}
	break;
	case 'mp4':
	case 'flv':
	case 'f4v':
	case 'm4v':
		$mimetype = "video/mp4";
		$toload = "jplayer_video";
		$mediaInfo = $mediaData->analyze($file);
		if($desktop){
		$objWidth = isset($mediaInfo['video']['resolution_x']) ? $mediaInfo['video']['resolution_x'] : $objWidth;
		$objHeight = isset($mediaInfo['video']['resolution_y']) ? $mediaInfo['video']['resolution_y'] : $objHeight;
		if($objWidth > 720){
			$objWidth = $objWidth / 2;
			$objHeight = $objHeight / 2;
		}
		}
	break;
	case 'ogv':
		$mimetype = "video/ogg";
		$toload = "jplayer_video";
		$mediaInfo = $mediaData->analyze($file);
		if($desktop){
		$objWidth = isset($mediaInfo['video']['resolution_x']) ? $mediaInfo['video']['resolution_x'] : $objWidth;
		$objHeight = isset($mediaInfo['video']['resolution_y']) ? $mediaInfo['video']['resolution_y'] : $objHeight;
		if($objWidth > 720){
			$objWidth = $objWidth / 2;
			$objHeight = $objHeight / 2;
		}
		}
	break;
	case 'webm':
		$mimetype = "video/webm";
		$toload = "jplayer_video";
		$mediaInfo = $mediaData->analyze($file);
		if($desktop){
		$objWidth = isset($mediaInfo['video']['resolution_x']) ? $mediaInfo['video']['resolution_x'] : $objWidth;
		$objHeight = isset($mediaInfo['video']['resolution_y']) ? $mediaInfo['video']['resolution_y'] : $objHeight;
		if($objWidth > 720){
			$objWidth = $objWidth / 2;
			$objHeight = $objHeight / 2;
		}
		}
	break;
	
	case 'swf':
		$mimetype = "application/x-shockwave-flash";
	break;
	case 'pdf':
		$mimetype = "application/pdf";
		$objWidth = '100%';
		$toload = "document";
	break;
	case 'mp3':
		$mimetype = "audio/mpeg";
		$objWidth = 0;
		$objHeight = 0;
		$toload = "jplayer_audio";
	break;
	case 'wav':
		$mimetype = "audio/x-wave";
		$objWidth = 0;
		$objHeight = 0;
		$toload = "jplayer_audio";
	break;
	case 'xls':
	case 'xlsx':
	case 'ppt':
	case 'pptx':
		//$mimetype = "application/pdf";
		$objWidth = '100%';
		$toload = "document";
	break;
	case 'jpg':
	case 'jpeg':
	case 'png':
	case 'gif':
		$toload = "image";
	break;
	default:
		$mimetype = "application/octet-stream";
		$toload = "fullUrl";
	break;
}

$normallink = $file;
//$symlinked = $_SERVER['HTTP_HOST'].'/'.$fullsafelink;

if(isset($refurl)){
	$link = '<a href="' . $refurl .'"></a>';
	echo $link;
}

if($toload == "image"){
	$link = '<img src="' . $file .'" />';
	echo $link;
}

if($toload == "fullUrl"){
	$file = preg_replace("/^http:/", "https:", $file);
	echo '<iframe src="' . urldecode($file) .'"></iframe>';
}
?>
<?php
//TODO: make a check here for http / https and use the correct domain thiny
if($toload == "document"){ ?>
<?php
// check here if alternate video files are available yet and include them
	$checkdir = pathinfo($file, PATHINFO_DIRNAME) . '/.doc_res/';
	$cleanname = pathinfo($file, PATHINFO_FILENAME);
	if(file_exists($checkdir . $cleanname .'.odt')){
		$altfile = $checkdir . $cleanname . '.odt';
	}
	if(file_exists($checkdir . $cleanname .'.ods')){
		$altfile = $checkdir . $cleanname . '.ods';
	}	
	if(file_exists($checkdir . $cleanname .'.odp')){
		$altfile = $checkdir . $cleanname . '.odp';
	}
	if(isset($altfile)){
		$docfile = $altfile;
	}else{
		$docfile = $file;
		$nofilefound = true;
	}
	
	$docarr = array('doc','docx','ppt','pptx','pps','ppsx','xls','xlsx');
	
	if(in_array($fileExt,$docarr) && $nofilefound){
		echo "This document has not been converted yet. Please check back soon. We apologise for the inconvenience";
	}
?>
<!-- 
<a href="<?php if(check_is_valid_url($file)){ echo $file; }else{ echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/'. $file;} ?>" class="embed_this"></a>
<script type="text/javascript">
$('a.embed_this').gdocsViewer();
</script> -->
<iframe src="scripts/viewerjs/#../../<?php echo rawurlencode($docfile); ?>" height="640px" width="100%" allowfullscreen webkitallowfullscreen></iframe>
<?php
}
?>
<?php
if($toload == "jplayer_video"){
	$suppliedA = explode('/',$mimetype);
	$supplied = $suppliedA[1];

	// check here if alternate video files are available yet and include them
	$checkdir = pathinfo($file, PATHINFO_DIRNAME) . '/.vid_res/';
	$cleanname = pathinfo($file, PATHINFO_FILENAME);
	if(file_exists($checkdir . $cleanname .'.jpg')){
		$posterfile = $checkdir . $cleanname . '.jpg';
	}else{
		$posterfile = '';
	}
	if(file_exists($checkdir . $cleanname .'.ogv')){
		$altfiles[] = $checkdir . $cleanname . '.ogv';
	}
	if(file_exists($checkdir . $cleanname .'.mp4')){
		$altfiles[] = $checkdir . $cleanname . '.mp4';
	}	
	if(file_exists($checkdir . $cleanname .'.webm')){
		$altfiles[] = $checkdir . $cleanname . '.webm';
	}	

	if(isset($altfiles)){
	$supplied ='"';
	$setmedia = '';
		foreach($altfiles as $alt){
			$altext = pathinfo($alt,PATHINFO_EXTENSION);
			$supplied .= $altext . ',';
			$setmedia .= $altext . ':"' . $checkdir . $cleanname . '.' . $altext . '",';
		}
	$supplied .= '"';
	}else{
		$supplied = '"' . $fileExt . '"';
		$setmedia = $fileExt . ':"' . $file . '",';
	}

	include(TEMPLATE_PATH . 'jplayer_video.html');
	$scriptData = '
	<script type="text/javascript">
	$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		errorAlerts: true,
		ready: function () {
			$(this).jPlayer("setMedia", {
				' . $setmedia . '
			poster :"' . $posterfile . '"
			});
		},
		solution:"html,flash",
		swfPath: "'.SCRIPTS_PATH.'jplayer",
		supplied: ' . $supplied . ',
		wmode: "window",
		size: {
			width: "' . $objWidth . 'px",
			height: "' . $objHeight . 'px",
			cssClass: "jp-video-360p"
		},
		smoothPlayBar: true,
		keyEnabled: true
	});
});
</script>
	';
	echo $scriptData;
}

if($toload == "jplayer_audio"){
	
	$suppliedA = explode('/',$mimetype);
	$supplied = $suppliedA[1];
	include(TEMPLATE_PATH . 'jplayer_audio.html');
	$scriptData = '
	<script type="text/javascript">
	$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		errorAlerts: true,
		ready: function () {
			$(this).jPlayer("setMedia", {
				' . $fileExt . ':"' . $file . '"
			});
		},
		solution:"html,flash",
		swfPath: "'.SCRIPTS_PATH.'jplayer",
		supplied: "' . $fileExt . '",
		wmode: "window",
		size: {
			width: "' . $objWidth . 'px",
			height: "' . $objHeight . 'px",
			cssClass: "jp-video-360p"
		},
		smoothPlayBar: true,
		keyEnabled: true
	});
});
</script>
	';
	echo $scriptData;
}
?>
<?php
/*echo '
<object width="' . $objWidth . '" height="'. $objHeight .'" scale="aspect" type="' . $mimetype .'" data="' . $file . '">
<param name="src" value="'.$file.'" />
<param name="autoplay" value="false" />
<param name="autoStart" value="0" />
<param name="allowFullScreen" value="true" />
<embed type="' . $mimetype .'" src=" ' . $file . '" width="' . $objWidth . '" height="'. $objHeight .'" scale="aspect" autoStart="false" hidden="false">
The object could not be loaded.
</embed>
</object>';
*/
}
}// endif file exists
    $control->build_footer();
?>
