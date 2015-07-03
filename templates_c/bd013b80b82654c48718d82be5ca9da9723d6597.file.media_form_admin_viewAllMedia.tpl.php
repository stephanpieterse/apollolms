<?php /* Smarty version Smarty-3.1.17, created on 2015-07-03 20:07:52
         compiled from "./templates/media_form_admin_viewAllMedia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1348886028550d751d7c3729-33336013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd013b80b82654c48718d82be5ca9da9723d6597' => 
    array (
      0 => './templates/media_form_admin_viewAllMedia.tpl',
      1 => 1435237059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1348886028550d751d7c3729-33336013',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_550d751da3f583_62441696',
  'variables' => 
  array (
    'breadcrumbs' => 0,
    'selectors' => 0,
    'itemData' => 0,
    'iconpath' => 0,
    'userCanMod' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550d751da3f583_62441696')) {function content_550d751da3f583_62441696($_smarty_tpl) {?><br/>
<span class="media_breadcrumbs">
<?php echo $_smarty_tpl->tpl_vars['breadcrumbs']->value;?>

</span>
<div>
<br/>
<?php if (isset($_smarty_tpl->tpl_vars['selectors']->value)) {?> 
		<form name="selector">
<?php }?>

<ul>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['name'] = 'sec1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sec1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['itemData']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
	<div class="mediaItem">
	<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['NAME'];?>

	<li>		
		
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="folder") {?>
	
	<a href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKVIEW'];?>
">
	<img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
quartz/Folder.png" alt="Item Icon"/>
	</a>
	<a href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKREMOVE'];?>
"> <img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
cancel.png" alt="Delete"/></a>
	
	<?php } else { ?>
	<?php if (isset($_smarty_tpl->tpl_vars['selectors']->value)) {?> 
		<?php if ($_smarty_tpl->tpl_vars['selectors']->value=="radiobtn") {?>
		<input id="fileurl" name="fileurl" type="radio" value="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKVIEW'];?>
" />
	<?php }?>
	<?php }?>
	<a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKVIEW'];?>
">
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="pdf") {?>
	<img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
'quartz/File_Pdf.png" alt="PDF Item"/>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="video") {?>
	<img src="media/media_icons/Shell32_0115_0000.png" alt="Video Item"/>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="audio") {?>
	<img src="media/media_icons/Shell32_0116_0000.png" alt="Audio Item"/>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="document") {?>
	<img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
quartz/News.png" alt="Document Item"/>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="image") {?>
	<img height="50px" src="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['IMAGELINK'];?>
" alt="Image Item"/>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['TYPE']=="other") {?>
	<img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
quartz/File.png" alt="Item"/>
	<?php }?>
	</a>
	<br/>
	<?php if ($_smarty_tpl->tpl_vars['userCanMod']->value==true) {?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKRENAME'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
pencil.png" alt="Rename"/></a>
		<a href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKREMOVE'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
cancel.png" alt="Delete"/></a>
		<a href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['LINKMOVE'];?>
"> <img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
folder_go.png" alt="Move"/></a>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['MEDIAKNOWN']==true) {?>
	<a alt="View Resource" title="Show the resource in the player" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['RESOURCEVIEW'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconpath']->value;?>
page_white_code.png" alt="Embed Code"/></a>
	<?php }?>
	<br/>
	<?php echo $_smarty_tpl->tpl_vars['itemData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['sec1']['index']]['FILESIZE'];?>

	<?php }?>
	</li>
	</div>
<?php endfor; endif; ?>
</div>	
</ul>
<?php if (isset($_smarty_tpl->tpl_vars['selectors']->value)) {?> 
		<input type="button" value="Select" onclick="post_value();" />
		</form>
<?php }?>
</div>
<br class="clear" />
<?php }} ?>
