<?php /* Smarty version Smarty-3.1.17, created on 2014-12-05 08:41:03
         compiled from "./templates/courses_form_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149000606753767e5c95daf6-48263673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ca6cfd05ab4e48e2f3d487275f8963ef034feb1' => 
    array (
      0 => './templates/courses_form_search.tpl',
      1 => 1403411978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149000606753767e5c95daf6-48263673',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53767e5c9aec98_68780573',
  'variables' => 
  array (
    'idarray' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53767e5c9aec98_68780573')) {function content_53767e5c9aec98_68780573($_smarty_tpl) {?><div name="custUserArea" id="custUserArea">
<?php  $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['idarray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['id']->key => $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['id']->_loop = true;
?>
	<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<br/><a href="users.php?f=viewUser"></a>
	<?php } ?>

<?php }} ?>
