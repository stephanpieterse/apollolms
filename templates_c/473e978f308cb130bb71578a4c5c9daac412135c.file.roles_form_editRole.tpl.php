<?php /* Smarty version Smarty-3.1.17, created on 2015-02-10 19:12:11
         compiled from "./templates/roles_form_editRole.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53637540954da580b1c57e9-91408019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '473e978f308cb130bb71578a4c5c9daac412135c' => 
    array (
      0 => './templates/roles_form_editRole.tpl',
      1 => 1423595431,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53637540954da580b1c57e9-91408019',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'newrole' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54da580b248eb3_73420467',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54da580b248eb3_73420467')) {function content_54da580b248eb3_73420467($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['newrole']->value==true) {?>
	<input type="submit" value="Add New Role" />
<?php } else { ?>
	<input type="submit" value="Update Role" />
<?php }?>
</form>
<?php }} ?>
