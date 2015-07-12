<div name="custUserArea" id="custUserArea">
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Find Users: <input class="searchBox" type="text" id="searchbox_roles" value="" />');
	</script>
	<noscript>
		<form method="GET" action="users.php">
		<input name="s" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<table class="admin_view_table">
{section name=sec1 loop=$roledata}
	<tr>
	<td>
	{$roledata[sec1].ROLENAME}
	</td>	
	{foreach name=sec2 from=$roledata[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
{/section}
</table>
<script type="text/javascript">
	searchInTable("searchbox_roles");
</script>
