<?php /* Smarty version Smarty-3.1.17, created on 2014-05-16 20:55:25
         compiled from "./templates/users_form_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50837092553767a77a6da24-81553136%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abda244c064c1f4d557de411b4e0ece3cadc2ce5' => 
    array (
      0 => './templates/users_form_search.tpl',
      1 => 1400273696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50837092553767a77a6da24-81553136',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53767a77ac2d54_21936995',
  'variables' => 
  array (
    'idarray' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53767a77ac2d54_21936995')) {function content_53767a77ac2d54_21936995($_smarty_tpl) {?><div name="custUserArea" id="custUserArea">
<?php  $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['idarray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['id']->key => $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['id']->_loop = true;
?>
	<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<br/><a href="users.php?f=viewUser"></a>
	<?php } ?>

<?php }} ?>
