<div name="custUserArea" id="custUserArea">
<table class="admin_view_table">
	<form method="GET" action="users.php">
	<input name="s" type="text" value="Search"/>
	<input type="submit" />
	</form>
<!--
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
	document.write('Find Users: <input class="searchBox" type="text" id="searchbox_user" name="searchbox_user" value="" />');
	document.write('<input class="searchButton" type="button" onclick="searchForUsers(document.getElementById(\'searchbox_user\').value);" value="Search"/>');
	</script>
	-->

{section name=sec1 loop=$memberdata}
	<tr>
	<td>
	<a href="users.php?f=viewUser&uid={$memberdata[sec1].ID}">
	{$memberdata[sec1].GENDER}
	{$memberdata[sec1].PROFILEPIC}
	</a>
	</td>
	<td>
	Name: {$memberdata[sec1].NAME} - <a href="mailto:{$memberdata[sec1].EMAIL}">{$memberdata[sec1].EMAIL}</a>
	</td>	
	{foreach name=sec2 from=$memberdata[sec1].LINKS item=link}
	<td>{$link}</td>
	{/foreach}
	</tr>
	
{/section}

</table>
