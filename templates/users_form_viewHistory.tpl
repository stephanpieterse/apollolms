<div name="custUserArea" id="custUserArea">
<table class="admin_view_table">
{section name=sec1 loop=$itemdata}
	<tr>
	<td>
	{$itemdata[sec1].TIME}
	</td>
	<td>
	{foreach from=$itemdata[sec1] key=itKey item=itVal}
		{$itKey} = {$itVal}<br/>
	{/foreach}
	</td>
	</tr>
{/section}
</table>
