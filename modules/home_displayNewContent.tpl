<span class="group_content_show">
{section name=sec1 loop=$groupData}
	<a class="disp_block" href="{$groupData[sec1].HEADLINK}" >
	<li class="fl_L course_item">
	{if $groupData[sec1].ITEMIMG != ''}
		<img src="{$groupData[sec1].ITEMIMG}" />
	{/if}
	<br/>
	<span class="center">{$groupData[sec1].NAME}</span><br/>
	<div class="course_item_description">{$groupData[sec1].DESCRIPTION}</div>
	</li>
	</a>
{/section}
</span>
<br/>
<br class="clear" />
<p>Available courses:</p>
<ul class="fullWidth">
{section name=sec1 loop=$courseData}
	<a class="disp_block" href="{$courseData[sec1].HEADLINK}" >
	<li class="fl_L course_item">
	{if $courseData[sec1].ITEMIMG != ''}
		<img src="{$courseData[sec1].ITEMIMG}" />
	{/if}
	<br/>
	<span class="center">{$courseData[sec1].NAME}</span><br/>
	<div class="course_item_description">{$courseData[sec1].DESCRIPTION}</div>
	<div class="course_item_tags" >{$courseData[sec1].TAGS}</div>
	</li>
	</a>
{/section}
</ul>
<br class="clear"/>
<hr/>
