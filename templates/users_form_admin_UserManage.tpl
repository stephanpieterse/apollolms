<div name="custUserArea" id="custUserArea">
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Find Users: <input class="searchBox" type="text" id="searchbox_user" value="" />');
	</script>
	<noscript>
		<form method="GET" action="users.php">
		<input name="s" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<table class="admin_view_table">
{section name=sec1 loop=$memberdata}
	<tr>
	<td>
	<a href="users.php?f=viewUser&uid={$memberdata[sec1].ID}">	
	{$memberdata[sec1].PROFILEPIC}
	</a>
	</td>
	<td>
	{$memberdata[sec1].NAME}
	</td>
	{foreach name=sec2 from=$memberdata[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
{/section}
</table>
</div>
<script type="text/javascript">
	searchInTable("searchbox_user");
</script>
