	<span class="bold">Registered at:</span>
	{$userData.REGDATE}
	<br/>
	<span class="bold">Full Name:</span>
	{$userData.NAME} <a href="users.php?f=editUser&uid={$userData.ID}"><img src="{$smarty.const.ICONS_PATH}pencil.png" alt="Edit"/></a>
	<br/>
	<span class="bold">E-mail:</span>
	<a href="mailto:{$userData.EMAIL}">{$userData.EMAIL}</a>
	<br/>
	<span class="bold">Role:</span>
	{$userData.ROLE}
	<br/>
	<span class="bold">Contact Number:</span>
	{$userData.CONTACTNUM}
	<br/>
	<span class="bold">Groups:</span><a href="users.php?f=editUserGroups&uid={$userData.ID}"><img src="{$smarty.const.ICONS_PATH}pencil.png" alt="Edit"/></a><br/>
	{if isset($groupData)}
	<p>
	{section name=s1 loop=$groupData}
	
	<a target="_blank" href="groups.php?f=viewGroup&gid={$groupData[s1].ID}">{$groupData[s1].NAME}</a><br/>
	
	{/section}
	</p>
	{else}
	The user is not currently in any groups.
	{/if}
	<br/>
	Last Login:<br/>
	{$userData.LASTLOGIN}
	<br/>
