<div name="custUserArea" id="custUserArea">

<p><a href="courses.php?f=editArticles&id={$headerData.COURSE}">Back to Article</a></p>
<p><a href="index.php?aq=newPage&aid={$headerData.AID}">Add a New Page</a></p>
<p><a href="articles.php?f=editResource&aid={$headerData.AID}">Add a New Resource</a></p>

<table class="admin_view_table">
{section name=sec1 loop=$pageData}
	<tr>
	<td>
	{$pageData[sec1].NAME}
	</td>
	{foreach name=sec2 from=$pageData[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
{/section}
</table>
