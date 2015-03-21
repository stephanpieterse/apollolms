<div id="normgroupwrap" style="float: left; width: 50%;">
<p>
<span class="bold">Admins:</span><br/>
{if isset($adminNames)}
{section name=sec1 loop=$adminNames}
	{$adminNames[sec1]}
{/section}
{else}
There are no admins assigned to this group.
{/if}
</p>

<p>
<span class="bold">Pending join requests:</span><br/>
{if isset($pendingSection)}
{section name=sec2 loop=$pendingSection}
		{$pendingSection[sec2].NAME} - {$pendingSection[sec2].ACCEPTLINK} - {$pendingSection[sec2].REJECTLINK}
{/section}
{else}
There are no requests currently pending.
{/if}
</p>


<p>
<span class="bold">Members:</span>{$totalUsers}<br/>
{if isset($usersSection)}
{section name=sec3 loop=$usersSection}
		<a href="users.php?f=viewUser&uid={$usersSection[sec3].ID}">{$usersSection[sec3].NAME}</a>
		{if isset($usersSection[sec3].ADMINLINK)}
		 - {$usersSection[sec3].ADMINLINK} 
		 {/if}
		 <br/>
{/section}
{else}
There don't seem to be any users in this group.
{/if}
</p>

<p>
<span class="bold">Courses:</span><br/>
{if isset($coursesSection)}
{section name=sec4 loop=$coursesSection}
	{$coursesSection[sec4].LINK}
{/section}
{else}
This group doesn't have specific access to any courses.
{/if}
</p>

<p>
<span class="bold">Available Tests:</span><br/>
{if isset($testsSection)}
{section name=sec5 loop=$testsSection}
	{$testsSection[sec5].LINK}
{/section}
{else}
This group doesn't have specific access to any tests.
{/if}
</p>

<p>
<span class="bold">Resources:</span><br/>
{if isset($resourceSection)}
{section name=sec6 loop=$resourceSection}
	{foreach name=fr from=$resourceSection[sec6].LINKS item=linkA}
		{$linkA}
	{/foreach}
	<br/>
{/section}
{else}
There are no resources for this group.
{/if}
{if $canAddResource}
<a href="resources.php?f=addToGroup&gid={$smarty.get.gid}">Add a Resource</a><br/>
{/if}
</p>

{if isset($subgroupsSection)}
<p>
<span class="bold">Subgroups:</span><br/>

{section name=sec7 loop=$subgroupsSection}
	{$subgroupsSection[sec7]}
{/section}
</p>
{/if}
</div>
