<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 18:03:40
         compiled from "templates/groups_form_viewGroup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1239147124550daa15a68838-21370991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c396750e1e223bd51a053f1a41a7128fb83666f2' => 
    array (
      0 => 'templates/groups_form_viewGroup.tpl',
      1 => 1426961018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1239147124550daa15a68838-21370991',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_550daa15a80684_52416007',
  'variables' => 
  array (
    'adminNames' => 0,
    'pendingSection' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550daa15a80684_52416007')) {function content_550daa15a80684_52416007($_smarty_tpl) {?><div id="normgroupwrap" style="float: left; width: 50%;">

<p>
<h2>Admins:</h2><br/>
<?php if (isset($_smarty_tpl->tpl_vars['adminNames']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['adminNames']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
	<?php echo $_smarty_tpl->tpl_vars['adminNames']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']];?>

<?php endfor; endif; ?>
<?php } else { ?>
There are no admins assigned to this group.
<?php }?>
</p>

<p>
Pending join requests:<br/>
<?php if (isset($_smarty_tpl->tpl_vars['pendingSection']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['name'] = 'sec2';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['pendingSection']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec2']['total']);
?>
		<?php echo $_smarty_tpl->tpl_vars['pendingSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec2']['index']]['NAME'];?>
 - <?php echo $_smarty_tpl->tpl_vars['pendingSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec2']['index']]['ACCEPTLINK'];?>
 - <?php echo $_smarty_tpl->tpl_vars['pendingSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec2']['index']]['REJECTLINK'];?>

<?php endfor; endif; ?>
<?php } else { ?>
There are no requests currently pending.
<?php }?>
</p>


Members:<br/>

Courses:<br/>



</div>
<br class="clear" />
<?php }} ?>
