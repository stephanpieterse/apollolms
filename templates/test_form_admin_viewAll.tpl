	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Search: <input class="searchBox" type="text" id="searchbox_tests" value="" />');
	</script>
	<noscript>
		<form method="GET" action="tests.php?">
		<input name="sq" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<table class="admin_view_table">
{section name=s1 loop=$testData}
<tr>
<td>{$testData[s1].NAME}</td>
{if isset($testData[s1].MOD)}
<td><a target="_blank" href="tests.php?f=modItem&id="{$testData[s1].ID}"><img src="{$iconsPath}pencil.png" alt="Edit"/></a></td>
{/if}
{if isset($testData[s1].DEL)}
<td><a href="index.php?confirm&aq=rem_test&id="{$testData[s1].ID}"><img src="{$iconsPath}cancel.png" alt="Delete"/></a></td>
{/if}
</tr>
{/section}
</table>
<script type="text/javascript">
	searchInTable("searchbox_tests");
</script>
