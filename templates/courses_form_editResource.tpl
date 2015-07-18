{if isset($new)}
<form name="resdetails" method="post" action="courses.php?pq=addResource">
{if isset($articleid)}
<input type="hidden" name="aid" value="{$articleid}" /> 
{/if}
{else}
<form name="resdetails" method="post" action="courses.php?pq=updateResource">
<input type="hidden" name="resid" value="{$resid}" /> 
{/if}
<input type="hidden" name="cid" value="{$courseid}" /> 
Please provide the resource details:<br/>
<label for="resn">Name: </label>
<input style="width:50%;" type="text" id="resname" name="resource_name" value="{$resname}" /><br/>
<label for="resurl">URL: </label>
<input style="width:50%;" type="text" id="resurl" name="resource_url" value="{$resurl}" /><br/>
<input type="submit" value="Submit" />
</form>

<script type="text/javascript">
function openChildSelector(){
	//var childWin = window.open("<?php echo get_serverURL() . '/' . SUBDOMAIN_NAME . '/'; ?>mediaslim.php?f=mediaSelect&dir=uploads&selector=single","SelectFile","width=550,height=550,resizable=1,scrollbars=1");

	var prevReturnValue = window.returnValue; // Save the current returnValue
	window.returnValue = undefined;
	var dlgReturnValue = window.open("mediaslim.php?f=mediaSelect&dir=uploads&selector=single","SelectFile","width=550,height=550,resizable=1,scrollbars=1");
	if (dlgReturnValue == undefined) // We don't know here if undefined is the real result...
	{
    // So we take no chance, in case this is the Google Chrome bug
		dlgReturnValue = window.returnValue;
	}
	window.returnValue = prevReturnValue; // Restore the original returnValue

	//document.resdetails.resource_url.value = dlgReturnValue;
	
}
</script>

<a href="javascript:void(0);" onclick="openChildSelector(); return false;">Or select a file from Media</a>
