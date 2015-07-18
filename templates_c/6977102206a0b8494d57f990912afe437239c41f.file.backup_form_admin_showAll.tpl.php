<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 10:14:18
         compiled from "./templates/backup_form_admin_showAll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193792591255a2cbfa60f161-78380763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6977102206a0b8494d57f990912afe437239c41f' => 
    array (
      0 => './templates/backup_form_admin_showAll.tpl',
      1 => 1436967554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193792591255a2cbfa60f161-78380763',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55a2cbfa6c62a3_09250183',
  'variables' => 
  array (
    'bdata' => 0,
    'iconsPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55a2cbfa6c62a3_09250183')) {function content_55a2cbfa6c62a3_09250183($_smarty_tpl) {?><table class="admin_view_table">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['name'] = 's1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['bdata']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['total']);
?>
<tr><td>
<?php echo $_smarty_tpl->tpl_vars['bdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['DATE'];?>

</td><td>
<?php echo $_smarty_tpl->tpl_vars['bdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['COMMENTS'];?>

</td><td>
<a href="backup.php?f=previewData&bid=<?php echo $_smarty_tpl->tpl_vars['bdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
eye.png" alt="preview" /></a>
</td><td>
<a href="backup.php?q=restoreData&bid=<?php echo $_smarty_tpl->tpl_vars['bdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
arrow_redo.png" alt="restore" /></a>
</td><td>
<a href="backup.php?q=removeData&bid=<?php echo $_smarty_tpl->tpl_vars['bdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
bin.png" alt="remove" /></a>
</td></tr>
<?php endfor; endif; ?>
</table>
<?php }} ?>
