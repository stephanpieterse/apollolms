<table class="admin_view_table">
{section name=sec1 loop=$groupData}
	
	<tr>
	<td>
	<a class="bold" href="{$groupData[sec1].LINK}">{$groupData[sec1].NAME}</a>
	<br/>
	{$groupData[sec1].DESCRIPTION}
	</td>
	<td>
	<a href="{$groupData[sec1].LINK}" >{$groupData[sec1].LINKNAME}</a>
	</td>
	</tr>
	
{/section}
</table>
