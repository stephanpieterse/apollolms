<table class="admin_view_table">

	<form method="GET" action="events.php">
	<input name="s" type="text" value="Search"/>
	<input type="submit" />
	</form>
<tr>
<td>
NAME
</td>
<td>
DESCRIPTION
</td>
<td>
CODE
</td>
</tr>
{section name=sec1 loop=$eventData}
	<tr>
	<td>
	{$eventData[sec1].NAME}
	</td>
	<td>
	 {$eventData[sec1].DESCRIPTION}
	</td>
	<td>
	{$eventData[sec1].CODE}
	</td>
	{foreach name=sec2 from=$eventData[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
	
{/section}

</table>
