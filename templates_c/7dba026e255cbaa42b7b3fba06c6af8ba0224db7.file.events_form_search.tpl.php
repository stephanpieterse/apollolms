<?php /* Smarty version Smarty-3.1.17, created on 2014-05-16 21:19:16
         compiled from "./templates/events_form_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1427032249537680d4a40817-77318481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dba026e255cbaa42b7b3fba06c6af8ba0224db7' => 
    array (
      0 => './templates/events_form_search.tpl',
      1 => 1400275154,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1427032249537680d4a40817-77318481',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'idarray' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_537680d4aa8124_47329104',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_537680d4aa8124_47329104')) {function content_537680d4aa8124_47329104($_smarty_tpl) {?><div name="custUserArea" id="custUserArea">
<?php  $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['idarray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['id']->key => $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['id']->_loop = true;
?>
	<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<br/><a href="events.php?f=viewUser"></a>
	<?php } ?>

<?php }} ?>
