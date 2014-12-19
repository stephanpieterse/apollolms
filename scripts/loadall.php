<?php
$dirTo = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . "/scripts";
if ($dh = opendir($dirTo)) {
        while (($file = readdir($dh)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            if (is_file($dir . $file)) {
                if (is_array($types)) {
                    if (!in_array(strtolower(pathinfo($dir . $file, PATHINFO_EXTENSION)), $types, true)) {
                        continue;
                    }
                }
               // $callback($baseDir . $file);
			   include($file);
			   echo $file;
            }
        }
        closedir($dh);
    }
?>