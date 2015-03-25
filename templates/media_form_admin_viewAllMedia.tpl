<br/>
<span class="media_breadcrumbs">
{$breadcrumbs}
</span>
<div>
<br/>
{if isset($selectors)} 
		<form name="selector">
{/if}

<ul>
{section name=sec1 loop=$itemData}
	<div class="mediaItem">
	{$itemData[sec1].NAME}
	<li>		
		
	{if $itemData[sec1].TYPE == "folder"}
	
	<a href="{$itemData[sec1].LINKVIEW}">
	<img src="{$iconpath}quartz/Folder.png" alt="Item Icon"/>
	</a>
	<a href="{$itemData[sec1].LINKREMOVE}"> <img src="{$iconpath}cancel.png" alt="Delete"/></a>
	
	{else}
	{if isset($selectors)} 
		{if $selectors == "radiobtn"}
		<input id="fileurl" name="fileurl" type="radio" value="{$itemData[sec1].LINKVIEW}" />
	{/if}
	{/if}
	<a target="_blank" href="{$itemData[sec1].LINKVIEW}">
	{if $itemData[sec1].TYPE == "pdf"}
	<img src="{$iconpath}'quartz/File_Pdf.png" alt="PDF Item"/>
	{/if}
	{if $itemData[sec1].TYPE == "video"}
	<img src="media/media_icons/Shell32_0115_0000.png" alt="Video Item"/>
	{/if}
	{if $itemData[sec1].TYPE == "audio"}
	<img src="media/media_icons/Shell32_0116_0000.png" alt="Audio Item"/>
	{/if}
	{if $itemData[sec1].TYPE == "document"}
	<img src="{$iconpath}quartz/News.png" alt="Document Item"/>
	{/if}
	{if $itemData[sec1].TYPE == "image"}
	<img height="50px" src="{$itemData[sec1].IMAGELINK}" alt="Image Item"/>
	{/if}
	{if $itemData[sec1].TYPE == "other"}
	<img src="{$iconpath}quartz/File.png" alt="Item"/>
	{/if}
	</a>
	<br/>
	{if $userCanMod == true}
		<a href="{$itemData[sec1].LINKRENAME}"><img src="{$iconpath}pencil.png" alt="Rename"/></a>
		<a href="{$itemData[sec1].LINKREMOVE}"><img src="{$iconpath}cancel.png" alt="Delete"/></a>
		<a href="{$itemData[sec1].LINKMOVE}"> <img src="{$iconpath}folder_go.png" alt="Move"/></a>
	{/if}
	{if $itemData[sec1].MEDIAKNOWN == true}
	<a alt="View Resource" title="Show the resource in the player" target="_blank" href="{$itemData[sec1].RESOURCEVIEW}"><img src="{$iconpath}page_white_code.png" alt="Embed Code"/></a>
	{/if}
	<br/>
	{$itemData[sec1].FILESIZE}
	{/if}
	</li>
	</div>
{/section}
</div>	
</ul>
{if isset($selectors)} 
		<input type="button" value="Select" onclick="post_value();" />
		</form>
{/if}
</div>
<br class="clear" />
