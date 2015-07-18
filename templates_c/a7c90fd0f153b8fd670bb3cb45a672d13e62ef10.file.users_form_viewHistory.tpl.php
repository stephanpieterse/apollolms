<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 15:30:35
         compiled from "./templates/users_form_viewHistory.tpl" */ ?>
<?php /*%%SmartyHeaderCode:472408036550d7124f12452-04768376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7c90fd0f153b8fd670bb3cb45a672d13e62ef10' => 
    array (
      0 => './templates/users_form_viewHistory.tpl',
      1 => 1432632493,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '472408036550d7124f12452-04768376',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_550d7125041c92_41954368',
  'variables' => 
  array (
    'itemdata' => 0,
    'itKey' => 0,
    'itVal' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550d7125041c92_41954368')) {function content_550d7125041c92_41954368($_smarty_tpl) {?><div name="custUserArea" id="custUserArea">
<table class="admin_view_table">
<?php if (isset($_smarty_tpl->tpl_vars['itemdata']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['itemdata']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['total']);
?>
	<tr>
	<td>
	<?php echo $_smarty_tpl->tpl_vars['itemdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TIME'];?>

	</td>
	<td>
	<?php  $_smarty_tpl->tpl_vars['itVal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itVal']->_loop = false;
 $_smarty_tpl->tpl_vars['itKey'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['itemdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itVal']->key => $_smarty_tpl->tpl_vars['itVal']->value) {
$_smarty_tpl->tpl_vars['itVal']->_loop = true;
 $_smarty_tpl->tpl_vars['itKey']->value = $_smarty_tpl->tpl_vars['itVal']->key;
?>
		<?php echo $_smarty_tpl->tpl_vars['itKey']->value;?>
 = <?php echo $_smarty_tpl->tpl_vars['itVal']->value;?>
<br/>
	<?php } ?>
	</td>
	</tr>
<?php endfor; endif; ?>
<?php } else { ?>
	<tr><td>The user has no current history.</td></tr>
<?php }?>
</table>
<?php }} ?>
