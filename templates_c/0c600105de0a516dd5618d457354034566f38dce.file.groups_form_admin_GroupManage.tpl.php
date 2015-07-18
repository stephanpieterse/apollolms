<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 10:21:01
         compiled from "./templates/groups_form_admin_GroupManage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11157818995575fc7e537df3-33953988%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c600105de0a516dd5618d457354034566f38dce' => 
    array (
      0 => './templates/groups_form_admin_GroupManage.tpl',
      1 => 1436967554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11157818995575fc7e537df3-33953988',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5575fc7e54b3c1_28875878',
  'variables' => 
  array (
    'gdata' => 0,
    'iconsPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5575fc7e54b3c1_28875878')) {function content_5575fc7e54b3c1_28875878($_smarty_tpl) {?>	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Search: <input class="searchBox" type="text" id="searchbox_groups" value="" />');
	</script>
	<noscript>
		<form method="GET" action="groups.php">
		<input name="s" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<div id="custGroupArea">
<table class="admin_view_table">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['gdata']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<a href="groups.php?f=viewGroup&gid=<?php echo $_smarty_tpl->tpl_vars['gdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['ID'];?>
"><?php echo $_smarty_tpl->tpl_vars['gdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['NAME'];?>
</a>
</td>
<td>
<a href="groups.php?f=editGroup&gid=<?php echo $_smarty_tpl->tpl_vars['gdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['ID'];?>
"> <img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
pencil.png" alt=\"Edit\"/></a>
</td>
<td>
<a href="index.php?action=rem_group&group=<?php echo $_smarty_tpl->tpl_vars['gdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['ID'];?>
"> <img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
cancel.png" alt="Delete"/></a>
</td>
<?php endfor; endif; ?>
</table>
</div>
<br class="clear"/>
<script type="text/javascript">
	searchInTable("searchbox_groups");
</script>
<?php }} ?>
