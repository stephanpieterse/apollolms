<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 17:34:06
         compiled from "./templates/users_form_admin_UserManage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1109859946550dab8e07a622-07066828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57bd1c5f6fbcfd95c9d843f229eae2fcdc5fe2cc' => 
    array (
      0 => './templates/users_form_admin_UserManage.tpl',
      1 => 1426943738,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1109859946550dab8e07a622-07066828',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'memberdata' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_550dab8e1326c9_72281825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550dab8e1326c9_72281825')) {function content_550dab8e1326c9_72281825($_smarty_tpl) {?><div name="custUserArea" id="custUserArea">
	<script type="text/javascript" src="scripts/ajax_searches.js"></script>
	<script type="text/javascript">
		document.write('Find Users: <input class="searchBox" type="text" id="searchbox_user" name="searchbox_user" value="" />');
		document.write('<input class="searchButton" type="button" onclick="searchForUsers(document.getElementById(\'searchbox_user\').value);" value="Search"/>');
	</script>
	<noscript>
		<form method="GET" action="users.php">
		<input name="s" type="text" value="Search"/>
		<input type="submit" />
		</form>
	</noscript>
<table class="admin_view_table">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['memberdata']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
	<a href="users.php?f=viewUser&uid=<?php echo $_smarty_tpl->tpl_vars['memberdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['ID'];?>
">
	
	<?php echo $_smarty_tpl->tpl_vars['memberdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['PROFILEPIC'];?>

	</a>
	</td>
	<td>
	Name: <?php echo $_smarty_tpl->tpl_vars['memberdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['NAME'];?>
 - <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['memberdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['EMAIL'];?>
"><?php echo $_smarty_tpl->tpl_vars['memberdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['EMAIL'];?>
</a>
	</td>
	<?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['memberdata']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
	<td><?php echo $_smarty_tpl->tpl_vars['link']->value;?>
</td>
	<?php } ?>
	</tr>
	
<?php endfor; endif; ?>

</table>
<?php }} ?>
