<?php /* Smarty version Smarty-3.1.17, created on 2014-12-11 09:32:30
         compiled from "./templates/billing_form_admin_BillingManage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1693607820548964aec1ae42-09465091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3703b509a681de721bb7c0743d4543df9694192c' => 
    array (
      0 => './templates/billing_form_admin_BillingManage.tpl',
      1 => 1403673911,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1693607820548964aec1ae42-09465091',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'billingEmail' => 0,
    'activeMembers' => 0,
    'totalSpaceUsed' => 0,
    'totalUploadsMax' => 0,
    'totalSpaceUsedBandwith' => 0,
    'totalAdminCost' => 0,
    'listAllUsers' => 0,
    'totalCoursesBill' => 0,
    'totalFinalCost' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_548964aec5ef82_36606532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548964aec5ef82_36606532')) {function content_548964aec5ef82_36606532($_smarty_tpl) {?><form method="post" action="sitesettings.php?q=update_billingEmail">
Billing Adress:<br/>
<input class="fullWidth" type="text" name="bill_email" value="<?php echo $_smarty_tpl->tpl_vars['billingEmail']->value;?>
"/>
<input value="Update" type="submit" />
</form>
<table class="centerfloat">
<tr>
<td>Total Active Users: </td><td><?php echo $_smarty_tpl->tpl_vars['activeMembers']->value;?>
</td>
</tr><tr><td>
Space Used:</td><td><?php echo $_smarty_tpl->tpl_vars['totalSpaceUsed']->value;?>
 MB of <?php echo $_smarty_tpl->tpl_vars['totalUploadsMax']->value;?>
</td>
</tr><tr><td>
Estimated Bandwith per user: </td><td> <?php echo $_smarty_tpl->tpl_vars['totalSpaceUsedBandwith']->value;?>
 MB</td>
</tr><tr><td>
Administration + Server Cost: </td><td> <?php echo $_smarty_tpl->tpl_vars['totalAdminCost']->value;?>
</td>
</tr><tr><td>
Active users: </td><td><div style="max-height:200px; overflow:auto;"><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['listAllUsers']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
?><?php echo $_smarty_tpl->tpl_vars['listAllUsers']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']];?>
<br/><?php endfor; endif; ?></div></td>
</tr><td>
Cost for newly registered courses: </td><td><?php echo $_smarty_tpl->tpl_vars['totalCoursesBill']->value;?>
</td>
</tr><tr>
<td>Applicable Discount:</td><td>0</td>
</tr><tr>
<td>TOTAL COST</td><td>R<?php echo $_smarty_tpl->tpl_vars['totalFinalCost']->value;?>
</td>
</tr>
</table>
These figures are for testing and reference only, no bills will be sent and the information displayed is purely for informing you of the estimated cost of the system once out of beta phase.
<?php }} ?>
