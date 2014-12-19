<?php
	session_start();
if(isset($_GET['f'])){
	$file = $_GET['f'];

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
	
	$handle = opendir($downloaddir);
	while ($dir = readdir($handle)) {
	if (is_dir($downloaddir . $dir)){
		if ($dir != "." && $dir != ".."){
			@unlink($downloaddir . $dir . "/" . urlencode($filename));
			@rmdir($downloaddir . $dir);
		}
	}
	}
	closedir($handle);
	mkdir($downloaddir . $string, 0777);
	$fullsafelink = $downloaddir . $string . "/" . urlencode($filename);
	symlink($safedir . urlencode($filename), $fullsafelink);
	
	$fileExt = pathinfo($file, PATHINFO_EXTENSION);

if($_SESSION['userAgent'] == 'desktop') {
	$objWidth = 640;
	$objHeight = 480;
	}else
	{
	$objWidth = 320;
	$objHeight = 240;
	}
	
switch($fileExt){
	case 'mpg':
	case 'mpeg':
		$mimetype = "video/mpeg";
		break;
	case 'mp4':
	case 'flv':
	case 'f4v':
		$mimetype = "video/mp4";
		break;
	case 'swf':
		$mimetype = "application/x-shockwave-flash";
		break;
	case 'pdf':
		$mimetype = "application/pdf";
		$objWidth = '100%';
		break;
	case 'mp3':
		$mimetype = "audio/mpeg";
		$objWidth = 200;
		$objHeight = 45;
		break;
	case 'wav':
		$mimetype = "audio/x-wave";
		$objWidth = 200;
		$objHeight = 45;
		break;
	default:
		$mimetype = "application/octet-stream";
		break;
}

$normallink = $file;
$symlinked = $_SERVER['HTTP_HOST'].'/'.$fullsafelink;

echo '
<object width="' . $objWidth . '" height="'. $objHeight .'" scale="aspect" type="' . $mimetype .'" data="' . $file . '">
<param name="src" value="'.$file.'" />
<param name="autoplay" value="false" />
<param name="autoStart" value="0" />
<param name="allowFullScreen" value="true" />
<embed type="' . $mimetype .'" src=" ' . $file . '" width="' . $objWidth . '" height="'. $objHeight .'" scale="aspect" autoStart="false" hidden="false">
The object could not be loaded.
</embed>
</object>';

}
?>
