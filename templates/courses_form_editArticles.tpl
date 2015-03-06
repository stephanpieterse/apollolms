<span class="bold">{$articleData.COURSENAME}</span>
<br/>
<p><a href="courses.php?f=admin_CourseManage">Back to Courses</a></p>
<p><a href="articles.php?f=editArticle&cid={$articleData.COURSEID}">Add a New Article</a></p>
<p><a href="courses.php?f=editResource&cid={$articleData.COURSEID}">Add a New Resource</a></p>
<br/>
Articles:
{if isset($tableData)}
<table class="admin_view_table">
{section name=s1 loop=$tableData}
<tr>
<td>{$tableData[s1].ITEMNAME}</td>
{foreach name=s2 from=$tableData[s1].LINKS item=link}
	<td>{$link}</td>
{/foreach}
</tr>
{/section}
</table>
{/if}
