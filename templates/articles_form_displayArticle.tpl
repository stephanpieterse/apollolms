<div class="mainArticle">
<h2>{$data['NAME']}</h2>
{$data['HTML_CONTENT']}
<br/>
<div class="pages">
{section name=sec1 loop=$pagesData}
<a href="articles.php?f=displayArticle&id={$pagesData[sec1].AID}&cid={$courseID}">{$pagesData[sec1].NAME} </a><br/>
{/section}
</div>	
<div class="resources">
{section name=sec1 loop=$resData}
<img src="{$smarty.const.ICONPATH}brick.png" alt="Resource"/><a href="{$resData[sec1].RESURL}">{$resData[sec1].NAME}</a><br/>'
{/section}	
</div>
</div>
<br class="clear" />
