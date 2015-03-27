<?php /* Smarty version Smarty-3.1.17, created on 2015-03-26 13:13:20
         compiled from "./templates/users_form_viewUser.tpl" */ ?>
<?php /*%%SmartyHeaderCode:419452987550d7124d437d0-78923642%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04303ceabce8e8a228729d3db6e6e377f4277999' => 
    array (
      0 => './templates/users_form_viewUser.tpl',
      1 => 1427375567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '419452987550d7124d437d0-78923642',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_550d7124e382f0_56727128',
  'variables' => 
  array (
    'userData' => 0,
    'groupData' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550d7124e382f0_56727128')) {function content_550d7124e382f0_56727128($_smarty_tpl) {?>	<a href="users.php?q=resendPassword&uid=<?php echo $_smarty_tpl->tpl_vars['userData']->value['ID'];?>
">Resend Password</a><br/>
	<span class="bold">Registered at:</span>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['REGDATE'];?>

	<br/>
	<span class="bold">Full Name:</span>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['NAME'];?>
 <a href="users.php?f=editUser&uid=<?php echo $_smarty_tpl->tpl_vars['userData']->value['ID'];?>
"><img src="<?php echo @constant('ICONS_PATH');?>
pencil.png" alt="Edit"/></a>
	<br/>
	<span class="bold">E-mail:</span>
	<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['userData']->value['EMAIL'];?>
"><?php echo $_smarty_tpl->tpl_vars['userData']->value['EMAIL'];?>
</a>
	<br/>
	<span class="bold">Role:</span>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['ROLE'];?>

	<br/>
	<span class="bold">Contact Number:</span>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['CONTACTNUM'];?>

	<br/>
	<span class="bold">Groups:</span><a href="users.php?f=editUserGroups&uid=<?php echo $_smarty_tpl->tpl_vars['userData']->value['ID'];?>
"><img src="<?php echo @constant('ICONS_PATH');?>
pencil.png" alt="Edit"/></a><br/>
	<?php if (isset($_smarty_tpl->tpl_vars['groupData']->value)) {?>
	<p>
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
</a><br/>
	
	<?php endfor; endif; ?>
	</p>
	<?php } else { ?>
	The user is not currently in any groups.
	<?php }?>
	<br/>
	Last Login:<br/>
	<?php echo $_smarty_tpl->tpl_vars['userData']->value['LASTLOGIN'];?>

	<br/>
<?php }} ?>
