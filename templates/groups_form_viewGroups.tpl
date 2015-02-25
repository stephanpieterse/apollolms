<ul>
{section name=s1 loop=$itemData}
<li>
<a href="groups.php?f=viewGroup&gid={$itemData[s1].ID}">{$itemData[s1].NAME}</a>
<br/>
{$itemData[s1].DESCRIPTION}
</li>
{/section}
</ul>
