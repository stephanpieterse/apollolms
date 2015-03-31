<?php
/*
 * @author Stephan Pieterse
 * @package ApolloLMS
 * 
 * The links for the first level navigation
 * */
?>

<ul class="firstnavbar">
<li><a href="index.php">Home</a></li>
<li><a href="groups.php?f=joinNewGroup">Groups</a></li>
<!-- <li><a href="courses.php?f=viewCourses">Courses</a></li> -->
<li><a href="tests.php?f=listAvailableTests">Tests</a></li>
<!-- <li><a href="events.php?f=user_home">Events</a></li> -->
<li><a href="resources.php?f=user_home">Resources</a></li>
<?php
	echo loadPageModules("navbar");
?>
</ul>
