<noscript>
	<form method="GET" action="courses.php">
	<input name="s" type="text" value="Search"/>
	<input type="submit" value="Search"/>
	</form>
	</noscript>
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
	document.write('<input class="searchBox" type="text" id="searchbox_courses" name="searchbox_courses" value="" />');
	document.write('<input class="searchButton" type="button" onclick="searchForCoursesComplete(document.getElementById(\'searchbox_courses\').value);" value="Search"/>');
	</script>
<table class="admin_view_table">

{section name=sec1 loop=$courseData}
	<tr>
	<td>
	{$courseData[sec1].NAME}
	</td>
	{foreach name=sec2 from=$courseData[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
{/section}
</table>

Course Packages:
<table class="admin_view_table">
{section name=sec1 loop=$coursePackagesData}
	<tr>
	<td>
	{$coursePackagesData[sec1].NAME}
	</td>
	{foreach name=sec2 from=$coursePackagesData[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
{/section}
</table>
