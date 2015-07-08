<table class="admin_view_table">
{section name=s1 loop=$bdata}
<tr><td>
{$bdata[s1].DATE}
</td><td>
{$bdata[s1].COMMENTS}
</td><td>
<a href="backup.php?f=previewData&bid={bdata[s1].ID}"><img src="{$iconsPath}eye.png" alt="preview" /></a>
</td><td>
<a href="backup.php?q=restoreData&bid={$bdata[s1].ID}"><img src="{$iconsPath}arrow_redo.png" alt="restore" /></a>
</td><td>
<a href="backup.php?q=removeData&bid={$bdata[s1].ID}"><img src="{$iconsPath}bin.png" alt="remove" /></a>
</td></tr>
{/section}
</table>
