<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 20:09:49
         compiled from "templates/groups_form_viewGroup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1239147124550daa15a68838-21370991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c396750e1e223bd51a053f1a41a7128fb83666f2' => 
    array (
      0 => 'templates/groups_form_viewGroup.tpl',
      1 => 1426968587,
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
    'totalUsers' => 0,
    'usersSection' => 0,
    'coursesSection' => 0,
    'testsSection' => 0,
    'resourceSection' => 0,
    'linkA' => 0,
    'canAddResource' => 0,
    'subgroupsSection' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550daa15a80684_52416007')) {function content_550daa15a80684_52416007($_smarty_tpl) {?><div id="normgroupwrap" style="float: left; width: 50%;">
<p>
<span class="bold">Admins:</span><br/>
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
<span class="bold">Pending join requests:</span><br/>
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


<p>
<span class="bold">Members:</span><?php echo $_smarty_tpl->tpl_vars['totalUsers']->value;?>
<br/>
<?php if (isset($_smarty_tpl->tpl_vars['usersSection']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['name'] = 'sec3';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['usersSection']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec3']['total']);
?>
		<a href="users.php?f=viewUser&uid=<?php echo $_smarty_tpl->tpl_vars['usersSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec3']['index']]['ID'];?>
"><?php echo $_smarty_tpl->tpl_vars['usersSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec3']['index']]['NAME'];?>
</a>
		<?php if (isset($_smarty_tpl->tpl_vars['usersSection']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['sec3']['index']]['ADMINLINK'])) {?>
		 - <?php echo $_smarty_tpl->tpl_vars['usersSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec3']['index']]['ADMINLINK'];?>
 
		 <?php }?>
		 <br/>
<?php endfor; endif; ?>
<?php } else { ?>
There don't seem to be any users in this group.
<?php }?>
</p>

<p>
<span class="bold">Courses:</span><br/>
<?php if (isset($_smarty_tpl->tpl_vars['coursesSection']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['name'] = 'sec4';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['coursesSection']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec4']['total']);
?>
	<?php echo $_smarty_tpl->tpl_vars['coursesSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec4']['index']]['LINK'];?>

<?php endfor; endif; ?>
<?php } else { ?>
This group doesn't have specific access to any courses.
<?php }?>
</p>

<p>
<span class="bold">Available Tests:</span><br/>
<?php if (isset($_smarty_tpl->tpl_vars['testsSection']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['name'] = 'sec5';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['testsSection']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec5']['total']);
?>
	<?php echo $_smarty_tpl->tpl_vars['testsSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec5']['index']]['LINK'];?>

<?php endfor; endif; ?>
<?php } else { ?>
This group doesn't have specific access to any tests.
<?php }?>
</p>

<p>
<span class="bold">Resources:</span><br/>
<?php if (isset($_smarty_tpl->tpl_vars['resourceSection']->value)) {?>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['name'] = 'sec6';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['resourceSection']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec6']['total']);
?>
	<?php  $_smarty_tpl->tpl_vars['linkA'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['linkA']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resourceSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec6']['index']]['LINKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['linkA']->key => $_smarty_tpl->tpl_vars['linkA']->value) {
$_smarty_tpl->tpl_vars['linkA']->_loop = true;
?>
		<?php echo $_smarty_tpl->tpl_vars['linkA']->value;?>

	<?php } ?>
	<br/>
<?php endfor; endif; ?>
<?php } else { ?>
There are no resources for this group.
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['canAddResource']->value) {?>
<a href="resources.php?f=addToGroup&gid=<?php echo $_GET['gid'];?>
">Add a Resource</a><br/>
<?php }?>
</p>

<?php if (isset($_smarty_tpl->tpl_vars['subgroupsSection']->value)) {?>
<p>
<span class="bold">Subgroups:</span><br/>

<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['name'] = 'sec7';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['subgroupsSection']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sec7']['total']);
?>
	<?php echo $_smarty_tpl->tpl_vars['subgroupsSection']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec7']['index']];?>

<?php endfor; endif; ?>
</p>
<?php }?>
</div>
<?php }} ?>
