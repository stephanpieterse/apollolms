<p>Available courses:</p>
<div id="search_results"></div>
<form method=get action="courses.php">
<input type="text" name="s" value="Search Courses" />
<input type="submit" value="Search">
</form>
<div class="fullWidth">
{section name=sec1 loop=$courseData}
	<div class="fl_L course_item">
	<span class="center">{$courseData[sec1].NAME}</span><br/>
	{$courseData[sec1].DESCRIPTION}<br/>
	{$courseData[sec1].TAGS}<br/>
	</div>
{/section}
</div>
<br class="clear"/>
<hr/>
<p>Available Course Packages:</p>
{section name=sec1 loop=$coursePacks}
	
	{$coursePacks[sec1].NAME}
	{$coursePacks[sec1].DESCRIPTION}
	
	{$coursePacks[sec1].TAGS}
	
{/section}
