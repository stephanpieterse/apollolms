<?php
	$courseID = $_GET['cid'];
	if(isset($_GET['uid'])){
		$userID = $_GET['uid'];
	}else{
		$userID = $_SESSION['userID'];
	}
	
	$q = "SELECT * FROM courses WHERE id='$courseID' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
?>

Course Info:
<table class="centerfloat">
<tr><td>Course Name:</td><td><?php echo $d['NAME']; ?></td></tr>
<tr><td>Description:</td><td><?php echo $d['DESCRIPTION']; ?></td></tr>
<tr><td>Cost:</td><td><?php if($d['PRICE'] == 0){echo "Free";}else{echo $d['PRICE'];} ?></td></tr>
<tr><td>Par Time:</td><td><?php if($d['PAR_HOURS'] == 0){echo "None";}else{echo $d['PAR_HOURS'];} ?></td></tr>
</table>
<p>
<?php
if(userHasCoursePermission($userID,$courseID)){
echo '<div class="centerfloat centertext"><a class="biglinkT2 asButton centertext" style="background:#f1fff1;" href="courses.php?q=registerForCourse&cid=' . $courseID . '">REGISTER FOR THIS COURSE</a></div>';
}else{
	echo '<div class="centertext centerfloat biglinkT1">You do not have access to this course item.</div>';
}
?>
</p>