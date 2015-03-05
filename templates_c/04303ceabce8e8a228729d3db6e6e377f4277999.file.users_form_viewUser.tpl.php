<?php /* Smarty version Smarty-3.1.17, created on 2015-03-05 20:54:10
         compiled from "./templates/users_form_viewUser.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30562881454f8c27287adc1-61275090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04303ceabce8e8a228729d3db6e6e377f4277999' => 
    array (
      0 => './templates/users_form_viewUser.tpl',
      1 => 1425588651,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30562881454f8c27287adc1-61275090',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userData' => 0,
    'groupData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54f8c272915942_25873939',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f8c272915942_25873939')) {function content_54f8c272915942_25873939($_smarty_tpl) {?><a href="users.php?f=editUser&uid=<?php echo $_smarty_tpl->tpl_vars['userData']->value['UID'];?>
"><img src="' .ICONS_PATH . 'pencil.png" alt="Edit"/></a><br/>
	Registered at:<br/>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['REGDATE'];?>

	<br/>
	Full Name:<br/>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['NAME'];?>

	<br/>
	
	E-mail:<br/>
	<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['userData']->value['EMAIL'];?>
"><?php echo $_smarty_tpl->tpl_vars['userData']->value['EMAIL'];?>
</a>
	<br/>
	Role:<br/>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['ROLE'];?>

	<br/>
	Contact Number:<br/>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['CONTACTNUM'];?>

	<br/>
	Groups:<br/>
	<?php if (isset($_smarty_tpl->tpl_vars['groupData']->value)) {?>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['name'] = 's1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['groupData']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
	<a target="_blank" href="groups.php?f=viewGroup&gid=<?php echo $_smarty_tpl->tpl_vars['groupData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><?php echo $_smarty_tpl->tpl_vars['groupData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['NAME'];?>
</a>	
	<?php endfor; endif; ?>
	<?php } else { ?>
	The user is not currently in any groups.
	<?php }?>
	<br/>
	
	Last Login:<br/>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['LASTLOGIN'];?>

<?php }} ?>
