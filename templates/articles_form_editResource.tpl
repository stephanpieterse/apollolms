{if isset($new)}
<form method="post" action="articles.php?pq=addResource">
{if isset($articleid)}
<input type="hidden" name="aid" value="{$articleid}" /> 
{/if}
{else}
<form method="post" action="articles.php?pq=updateResource">
<input type="hidden" name="resid" value="{$resid}" /> 
{/if}
<input type="hidden" name="cid" value="{$courseid}" /> 
Please provide the resource details:<br/>
<label for="resn">Name: </label>
<input style="width:50%;" type="text" id="resn" name="resource_name" value="{$resname}" /><br/>
<label for="resurl">URL: </label>
<input style="width:50%;" type="text" id="resurl" name="resource_url" value="{$resurl}" /><br/>
<input type="submit" value="Submit" />
</form>
