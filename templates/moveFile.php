<?php
/**
 * @package ApolloLMS
 * */
?>
<form method="post" action="index.php?aq=mve_file" >
<select name="rootDirPath">

<?php

/* THIS IS ALREADY DECLARED?
function scanMkDir($dir, $prefix = ''){

$dir = rtrim($dir, '\\/');
  $result = array();
   
    foreach (scandir($dir) as $f) {
      if ($f !== '.' and $f !== '..') {
		if (is_dir("$dir/$f")) {
		 $result[] = $prefix.$f;
          $result = array_merge($result, scanMkDir("$dir/$f", "$prefix$f/"));
		 
        }
		else {
         // $result[] = $prefix.$f;
        }
      }
    }

return $result;
}
*/

	echo print_option("uploads/");
	$result = scanMkDir("uploads/","uploads/");
	
	foreach($result as $f){
	echo print_option($f . "/");
	}
?>

</select>
<?php
	tagarg('input',array('type'=>'hidden','name'=>'dir','value'=>$_GET['dir']),true);
	tagarg('input',array('type'=>'hidden','name'=>'file','value'=>$_GET['file']),true);
	
?>
<input type="submit" value="Move To Folder" />
</form>
