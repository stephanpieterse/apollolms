<div class="mainArticle">
<h2>{$data['NAME']}</h2>
{$data['HTML_CONTENT']}
<br/>
<div class="pages">
{section name=sec1 loop=$pagesData}
<a href="index.php?uq=viewPage&pnm={$pagesData[sec1].PNM}&aid={$pagesData[sec1].AID}">{$pagesData[sec1].NAME} </a><br/>
{/section}
</div>	
<div class="resources">
{section name=sec1 loop=$resData}
<img src="{$smarty.const.ICONPATH}brick.png" alt="Resource"/><a href="{$resData[sec1].RESURL}">{$resData[sec1].NAME}</a><br/>'
{/section}	
</div>
</div>
<br class="clear" />
