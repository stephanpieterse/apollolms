<div id="normgroupwrap" style="float: left; width: 50%;">

<p>
Admins:<br/>
{if isset($adminNames)}
{section name=sec1 loop=$adminNames}
	{$adminNames[sec1]}
{/section}
{else}
There are no admins assigned to this group.
{/if}
</p>

<p>
Pending join requests:<br/>
{if isset($pendingSection)}
{section name=sec2 loop=$pendingSection}
		{$pendingSection[sec2].NAME} - {$pendingSection[sec2].ACCEPTLINK} - {$pendingSection[sec2].REJECTLINK}
{/section}
{else}
There are no requests currently pending.
{/if}
</p>


Members:<br/>

Courses:<br/>



</div>
<br class="clear" />
<div id="chatwrap" style="float: left;">
{include(TEMPLATE_PATH . 'groups_form_chatSection.php');}
