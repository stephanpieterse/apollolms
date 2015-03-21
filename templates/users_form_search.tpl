<div name="custUserArea" id="custUserArea">
{if $foundSomething == 1}
{section name=sec2 loop=$idarray}
	<br/><a href="users.php?f=viewUser&uid={$idarray[sec2].ID}">{$idarray[sec2].NAME}<img src="{$smarty.const.ICONS_PATH}magnifier.png" alt="View"/></a>
{/section}
{/if}
</div>
