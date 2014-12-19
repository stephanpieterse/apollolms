<table class="admin_view_table">
	<form method="GET" action="roles.php">
	<input name="s" type="text" value="Search"/>
	<input type="submit" />
	</form>

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
