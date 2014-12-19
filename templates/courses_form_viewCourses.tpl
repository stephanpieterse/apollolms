<p>Available courses:</p>
<div id="search_results"></div>
<form method=get action="courses.php">
<input type="text" name="s" value="Search Courses" />
<input type="submit" value="Search">
</form>
<ul class="fullWidth">
{section name=sec1 loop=$courseData}
	<a class="disp_block" href="{$courseData[sec1].HEADLINK}" >
	<li class="fl_L course_item">
	<img src="{$courseData[sec1].ITEMIMG}" /><br/>
	<span class="center">{$courseData[sec1].NAME}</span><br/>
	<div class="course_item_description">{$courseData[sec1].DESCRIPTION}</div>
	<div class="course_item_tags" >{$courseData[sec1].TAGS}</div>
	</li>
	</a>
{/section}
</ul>
<br class="clear"/>
<hr/>
<p>Available Course Packages:</p>
{section name=sec1 loop=$coursePacks}
	
	{$coursePacks[sec1].NAME}
	{$coursePacks[sec1].DESCRIPTION}
	
	{$coursePacks[sec1].TAGS}
	
{/section}
