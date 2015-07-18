<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 15:29:18
         compiled from "./templates/test_form_admin_viewAll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181205704155a55c06c9b9a4-08995671%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20ff6d928738d726f36c0e9e8916a4c095d3d567' => 
    array (
      0 => './templates/test_form_admin_viewAll.tpl',
      1 => 1436967554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181205704155a55c06c9b9a4-08995671',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55a55c06e6c650_53942541',
  'variables' => 
  array (
    'testData' => 0,
    'iconsPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55a55c06e6c650_53942541')) {function content_55a55c06e6c650_53942541($_smarty_tpl) {?>	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Search: <input class="searchBox" type="text" id="searchbox_tests" value="" />');
	</script>
	<noscript>
		<form method="GET" action="tests.php?">
		<input name="sq" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<table class="admin_view_table">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['name'] = 's1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['testData']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['testData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['NAME'];?>
</td>
<?php if (isset($_smarty_tpl->tpl_vars['testData']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['s1']['index']]['MOD'])) {?>
<td><a target="_blank" href="tests.php?f=modItem&id="<?php echo $_smarty_tpl->tpl_vars['testData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
pencil.png" alt="Edit"/></a></td>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['testData']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['s1']['index']]['DEL'])) {?>
<td><a href="index.php?confirm&aq=rem_test&id="<?php echo $_smarty_tpl->tpl_vars['testData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
cancel.png" alt="Delete"/></a></td>
<?php }?>
</tr>
<?php endfor; endif; ?>
</table>
<script type="text/javascript">
	searchInTable("searchbox_tests");
</script>
<?php }} ?>
