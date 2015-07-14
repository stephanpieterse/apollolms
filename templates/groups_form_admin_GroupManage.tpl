	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Search: <input class="searchBox" type="text" id="searchbox_groups" value="" />');
	</script>
	<noscript>
		<form method="GET" action="groups.php">
		<input name="s" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<div id="custGroupArea">
<table class="admin_view_table">
{section name=sec1 loop=$gdata}
<tr>
<td>
<a href="groups.php?f=viewGroup&gid={$gdata[sec1].ID}">{$gdata[sec1].NAME}</a>
</td>
<td>
<a href="groups.php?f=editGroup&gid={$gdata[sec1].ID}"> <img src="{$iconsPath}pencil.png" alt=\"Edit\"/></a>
</td>
<td>
<a href="index.php?action=rem_group&group={$gdata[sec1].ID}"> <img src="{$iconsPath}cancel.png" alt="Delete"/></a>
</td>
{/section}
</table>
</div>
<br class="clear"/>
<script type="text/javascript">
	searchInTable("searchbox_groups");
</script>
