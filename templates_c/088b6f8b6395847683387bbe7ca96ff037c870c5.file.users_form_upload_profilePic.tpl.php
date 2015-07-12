<?php /* Smarty version Smarty-3.1.17, created on 2015-07-12 20:45:13
         compiled from "./templates/users_form_upload_profilePic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205561343955a2d1d94b0525-27476165%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '088b6f8b6395847683387bbe7ca96ff037c870c5' => 
    array (
      0 => './templates/users_form_upload_profilePic.tpl',
      1 => 1436733839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205561343955a2d1d94b0525-27476165',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55a2d1d94c1572_26359818',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55a2d1d94c1572_26359818')) {function content_55a2d1d94c1572_26359818($_smarty_tpl) {?><form enctype="multipart/form-data" action="users.php?fq=upload_profilePicture" method="post">
File to upload: <br/>
<input name="uploadedfile" type="file" /> <br/>
<input type="submit" value="Upload" />
</form>
<?php }} ?>
