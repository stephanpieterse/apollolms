<a href="users.php?f=editUser&uid={$userData.UID}"><img src="' .ICONS_PATH . 'pencil.png" alt="Edit"/></a><br/>
	Registered at:<br/>
	{$userData.REGDATE}
	<br/>
	Full Name:<br/>
	{$userData.NAME}
	<br/>
	
	E-mail:<br/>
	<a href="mailto:{$userData.EMAIL}">{$userData.EMAIL}</a>
	<br/>
	Role:<br/>
	{$userData.ROLE}
	<br/>
	Contact Number:<br/>
	{$userData.CONTACTNUM}
	<br/>
	Groups:<br/>
	{if isset($groupData)}
	{section name=s1 loop=$groupData}
	<a target="_blank" href="groups.php?f=viewGroup&gid={$groupData[s1].ID}">{$groupData[s1].NAME}</a>	
	{/section}
	{else}
	The user is not currently in any groups.
	{/if}
	<br/>
	
	Last Login:<br/>
	{$userData.LASTLOGIN}
