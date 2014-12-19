<p>Available courses:</p>
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
