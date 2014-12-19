<?php /* Smarty version Smarty-3.1.17, created on 2014-04-28 09:02:32
         compiled from "./templates/events_form_viewEvent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:281225014535e187f2d0da7-79727323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '216ce9e124b917e87f940dcbbf899e609e4464e9' => 
    array (
      0 => './templates/events_form_viewEvent.tpl',
      1 => 1398675750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281225014535e187f2d0da7-79727323',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_535e187f31e1e1_68026751',
  'variables' => 
  array (
    'eventName' => 0,
    'eventDescription' => 0,
    'eventPermissions' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535e187f31e1e1_68026751')) {function content_535e187f31e1e1_68026751($_smarty_tpl) {?><div name="custUserArea" id="custUserArea">
<table class="admin_view_table">
Name:<br/>
<?php echo $_smarty_tpl->tpl_vars['eventName']->value;?>

<br/>
Description:<br/>
<?php echo $_smarty_tpl->tpl_vars['eventDescription']->value;?>

<br/>
<?php echo $_smarty_tpl->tpl_vars['eventPermissions']->value;?>

</table>
<?php }} ?>
