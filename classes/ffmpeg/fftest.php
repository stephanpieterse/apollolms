<?php
	echo "hi";
	shell_exec("./ffmpeg -y -i test.3gp test.avi");
	if (file_exists("test.avi")){
		echo "yay";
	}else{
		echo "aww";
	}
?>
