<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 10:22:17
         compiled from "./templates/articles_form_editArticle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50045347655aa28d9ef5b15-67800865%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23436cba22c6d509fd047b4ce3ea623306b6f52c' => 
    array (
      0 => './templates/articles_form_editArticle.tpl',
      1 => 1437213346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50045347655aa28d9ef5b15-67800865',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'new' => 0,
    'COURSE_ID' => 0,
    'ARTICLE_ID' => 0,
    'ARTICLE_NAME' => 0,
    'ARTICLE_DESC' => 0,
    'ARTICLE_CODE' => 0,
    'HTML_CONTENT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55aa28d9f22473_05614189',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55aa28d9f22473_05614189')) {function content_55aa28d9f22473_05614189($_smarty_tpl) {?><script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php if ($_smarty_tpl->tpl_vars['new']->value==true) {?>
<form method="POST" action="articles.php?pq=updateArticle">';
<input type="hidden" name="courseID" value="<?php echo $_smarty_tpl->tpl_vars['COURSE_ID']->value;?>
" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ARTICLE_ID']->value;?>
" />';
<?php } else { ?>
<form method="POST" action="articles.php?pq=addNewArticle">
<input type="hidden" name="courseID" value="<?php echo $_smarty_tpl->tpl_vars['COURSE_ID']->value;?>
" />
<?php }?>
<div style="border: 1px solid; padding: 5px;">
<table>
<tr>
<td width="150px;">Article name:</td><td>
<input type="text" name="articleName" value="<?php echo $_smarty_tpl->tpl_vars['ARTICLE_NAME']->value;?>
" /></td>
</tr>
<tr>
<td>Description:</td><td>
<input type="text" name="articleDescription" value="<?php echo $_smarty_tpl->tpl_vars['ARTICLE_DESC']->value;?>
" /></td>
</tr>
<tr>
<td>Code:</td><td><input type="text" name="articleCode" value="<?php echo $_smarty_tpl->tpl_vars['ARTICLE_CODE']->value;?>
" /></td>
</tr>
<tr>
<td>Published:</td>
<td>
<select name="publishedStatus">
<option>Yes</option>
<option>No</option>
</select>
</td>
</tr>
</table>
</div>
<span class="bold">Page Content:</span>
<textarea id="pageContent" name="pageContent">
<?php echo $_smarty_tpl->tpl_vars['HTML_CONTENT']->value;?>

</textarea>
<br/>
<?php if ($_smarty_tpl->tpl_vars['new']->value==true) {?>
<input type="submit" name="save" value="Save" />
<input type="submit" name="saveCont" value="Save & Continue" />
<?php } else { ?>
<input type="submit" value="Add New Article" />
<?php }?>
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'pageContent' );
        CKEDITOR.replace( 'articleDescription' );
		CKEDITOR.config();
    };
</script>
<?php }} ?>
