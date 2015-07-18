<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
{if $new == false}
<form method="POST" action="articles.php?pq=updateArticle">
<input type="hidden" name="courseID" value="{$COURSE_ID}" />
<input type="hidden" name="id" value="{$ARTICLE_ID}" />
{else}
<form method="POST" action="articles.php?pq=addNewArticle">
<input type="hidden" name="courseID" value="{$COURSE_ID}" />
{/if}
<div style="border: 1px solid; padding: 5px;">
<table>
<tr>
<td width="150px;">Article name:</td><td>
<input type="text" name="articleName" value="{$ARTICLE_NAME}" /></td>
</tr>
<tr>
<td>Description:</td><td>
<input type="text" name="articleDescription" value="{$ARTICLE_DESC}" /></td>
</tr>
<tr>
<td>Code:</td><td><input type="text" name="articleCode" value="{$ARTICLE_CODE}" /></td>
</tr>
<tr>
<td>Published:</td>
<td>
<select name="publishedStatus">
<option>Yes</option>
<option>No</option>
</select>
</td>
</tr>
</table>
</div>
<span class="bold">Page Content:</span>
<textarea id="pageContent" name="pageContent">
{$HTML_CONTENT}
</textarea>
<br/>
{if $new == true}
<input type="submit" name="save" value="Save" />
<input type="submit" name="saveCont" value="Save & Continue" />
{else}
<input type="submit" value="Add New Article" />
{/if}
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'pageContent' );
        CKEDITOR.replace( 'articleDescription' );
		CKEDITOR.config();
    };
</script>
