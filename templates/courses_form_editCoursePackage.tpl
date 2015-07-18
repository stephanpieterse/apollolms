<div style="border:1px solid; padding: 5px;">
{$formTop}
<h1>BASIC</h1>
<table class="admin_view_table">
<tr>
<td>Course Package Name:</td>
<td><input style="width:250px;" type="text" name="courseName" value="{$courseName}" /></br>
</td></tr><tr>
<td>Code:</td><td><input style="width:150px;" type="text" name="courseCode" value="{$courseCode}" /></br></td>
</tr><tr>
<td>Cost: R</td><td><input style="width:50px;" type="text" name="price" value="{$coursePrice}" /></br></td>
</tr><tr>
<td>Tags: (seperated by ;)</td><td><textarea style="width:100%;" type="text" name="tags">{$courseTags}</textarea></br></td>
</tr>
</table>
</div>
<br />
<textarea style="width:80%;" id="courseIntroContent" name="courseIntroContent">{$courseHTML}</textarea>
<br />

<ul class="course_pack_list">
{section name=s1 loop=$coursesList}
<label>
<li>
<input type="checkbox" name="pack_includes" value="{$coursesList[s1].ID}" /> 
{$coursesList[s1].NAME}<br/>
{$coursesList[s1].CODE}<br/>
</li>
</label>
{/section}
</ul>
<br class="clear"/>
<div class="thinBorder"><h1>Permissions</h1>
{$coursePERM}
</div>
<p><input type="submit" value="Submit" /></p>
</form>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'courseIntroContent' );
        CKEDITOR.replace( 'courseDescription' );
		CKEDITOR.config();
    };
</script>
