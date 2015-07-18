<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 18:26:16
         compiled from "./templates/courses_form_editResource.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88383474855aa94415b2c46-96234860%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d7d3e1bac82cf98a92c01433a746ee659602e68' => 
    array (
      0 => './templates/courses_form_editResource.tpl',
      1 => 1437243971,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88383474855aa94415b2c46-96234860',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55aa94415d7bf8_36559435',
  'variables' => 
  array (
    'new' => 0,
    'articleid' => 0,
    'resid' => 0,
    'courseid' => 0,
    'resname' => 0,
    'resurl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55aa94415d7bf8_36559435')) {function content_55aa94415d7bf8_36559435($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['new']->value)) {?>
<form name="resdetails" method="post" action="courses.php?pq=addResource">
<?php if (isset($_smarty_tpl->tpl_vars['articleid']->value)) {?>
<input type="hidden" name="aid" value="<?php echo $_smarty_tpl->tpl_vars['articleid']->value;?>
" /> 
<?php }?>
<?php } else { ?>
<form name="resdetails" method="post" action="courses.php?pq=updateResource">
<input type="hidden" name="resid" value="<?php echo $_smarty_tpl->tpl_vars['resid']->value;?>
" /> 
<?php }?>
<input type="hidden" name="cid" value="<?php echo $_smarty_tpl->tpl_vars['courseid']->value;?>
" /> 
Please provide the resource details:<br/>
<label for="resn">Name: </label>
<input style="width:50%;" type="text" id="resname" name="resource_name" value="<?php echo $_smarty_tpl->tpl_vars['resname']->value;?>
" /><br/>
<label for="resurl">URL: </label>
<input style="width:50%;" type="text" id="resurl" name="resource_url" value="<?php echo $_smarty_tpl->tpl_vars['resurl']->value;?>
" /><br/>
<input type="submit" value="Submit" />
</form>

<script type="text/javascript">
function openChildSelector(){
	//var childWin = window.open("<<?php ?>?php echo get_serverURL() . '/' . SUBDOMAIN_NAME . '/'; ?<?php ?>>mediaslim.php?f=mediaSelect&dir=uploads&selector=single","SelectFile","width=550,height=550,resizable=1,scrollbars=1");

	var prevReturnValue = window.returnValue; // Save the current returnValue
	window.returnValue = undefined;
	var dlgReturnValue = window.open("mediaslim.php?f=mediaSelect&dir=uploads&selector=single","SelectFile","width=550,height=550,resizable=1,scrollbars=1");
	if (dlgReturnValue == undefined) // We don't know here if undefined is the real result...
	{
    // So we take no chance, in case this is the Google Chrome bug
		dlgReturnValue = window.returnValue;
	}
	window.returnValue = prevReturnValue; // Restore the original returnValue

	//document.resdetails.resource_url.value = dlgReturnValue;
	
}
</script>

<a href="javascript:void(0);" onclick="openChildSelector(); return false;">Or select a file from Media</a>
<?php }} ?>
