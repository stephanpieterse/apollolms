Public courses available:
<br/>

<?php
	$q = "SELECT * FROM courses WHERE open_trial='1'";
	$d = sql_execute($q);
	while($r= sql_get($d)){
		if(userHasCoursePermission(0, $r['ID'])){
			$link = '<a href="open_course_loader.php?f=displayCourse&cid=' . $r['ID'] . '">';
			$link .= $r['NAME'];
			$link .= '</a>';
			$link .= $r['DESCRIPTION'];
			echo $link;
		}
	}
?>
<p>
If you are interested in courses similar to these and many others, please consider registering on the site!
</p>
