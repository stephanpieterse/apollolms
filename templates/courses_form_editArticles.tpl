<span class="bold">{$articleData.COURSENAME}</span>
<br/>
<p><a href="courses.php?f=admin_CourseManage">Back to Courses</a></p>
<p><a href="articles.php?f=editArticle&cid={$articleData.COURSEID}">Add a New Article</a><br/>
<a href="courses.php?f=editResource&cid={$articleData.COURSEID}">Add a New Resource</a></p>
<br/>
Articles:
{if isset($tableData)}
<table class="admin_view_table">
{section name=s1 loop=$tableData}
<tr>
<td>{$tableData[s1].ITEMNAME}</td>
{if isset($tableData[s1].VIEW)}
<td><a href="articles.php?f=displayArticle&id={$tableData[s1].ID}"><img src="{$iconsPath}magnifier.png" alt="View"/>{$tableData[s1].NAME}</a><td>
{else}
<td></td>
{/if}
{if isset($tableData[s1].MODIFY)}
<td><a href="articles.php?f=mod_article&aid={$tableData[s1].ID}"><img src="{$iconsPath}pencil.png" alt="Edit"/>Edit</a></td>
<td><a href="courses.php?f=editArticles&id={$articleData.COURSEID}&root={$tableData[s1].ID}"><img src="{$iconsPath}pencil.png" alt="Edit Articles"/>sub-Articles</a></td>
<td><a href="articles.php?q=mv_art&id={$articleData.ID}&dir=up&aid={$tableData[s1].ID}"><img src="{$iconsPath}arrow_up.png" alt="Move Up"/></a></td>
<td><a href="articles.php?q=mv_art&id={$articleData.ID}&dir=down&aid={$tableData[s1].ID}"><img src="{$iconsPath}arrow_up.png" alt="Move Down"/></a></td>
{else}
<td></td>
<td></td>
<td></td>
{/if}
{if isset($tableData[s1].DELETE)}
<td><a href="articles.php?confirm&q=removeArticle&aid={$tableData[s1].ID}&cid={$articleData.COURSEID}"><img src="{$iconsPath}cancel.png" alt="Delete"/></a></td>
{else}
<td></td>
{/if}
</tr>
{/section}
</table>
{/if}

Resources:
{if isset($resourceData)}
<table class="admin_view_table">
{section name=s1 loop=$resourceData}
<tr>
<td>{$resourceData[s1].ITEMNAME}</td>
{if isset($resourceData[s1].VIEW)}
<td><a target="_blank" href="resource_view.php?f={$resourceData[s1].URL}"><img src="{$iconsPath}magnifier.png" alt="View"/>{$resourceData[s1].NAME}</a><td>
{else}
<td></td>
{/if}
{if isset($resourceData[s1].MODIFY)}
<td><a href="courses.php?f=editResource&cid={$articeData.COURSEID}&resid={$resourceTable[s1].ID}"><img src="{$iconsPath}pencil.png" alt="Edit"/>Edit</a></td>
{else}
<td></td>
{/if}
{if isset($tableData[s1].DELETE)}
<td><a href="courses.php?q=removeResource&id={$resourceTable[s1].ID}&cid={$articleData.COURSEID}"><img src="{$iconsPath}cancel.png" alt="Delete"/></a></td>
{else}
<td></td>
{/if}
</tr>
{/section}
</table>
{/if}
