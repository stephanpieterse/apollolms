<?php /* Smarty version Smarty-3.1.17, created on 2015-06-08 20:30:11
         compiled from "./templates/courses_form_editCoursePackage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7370212855575fb538198e1-50512183%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8141b75cc97558bb379c81540da024d2cc0c1e2' => 
    array (
      0 => './templates/courses_form_editCoursePackage.tpl',
      1 => 1426836583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7370212855575fb538198e1-50512183',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formTop' => 0,
    'courseName' => 0,
    'courseCode' => 0,
    'coursePrice' => 0,
    'courseTags' => 0,
    'courseHTML' => 0,
    'coursesList' => 0,
    'coursePERM' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5575fb53a9ee55_99606718',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5575fb53a9ee55_99606718')) {function content_5575fb53a9ee55_99606718($_smarty_tpl) {?><div style="border:1px solid; padding: 5px;">
<?php echo $_smarty_tpl->tpl_vars['formTop']->value;?>

<h1>BASIC</h1>
<table class="admin_view_table">
<tr>
<td>Course Package Name:</td>
<td><input style="width:250px;" type="text" name="courseName" value="<?php echo $_smarty_tpl->tpl_vars['courseName']->value;?>
" /></br>
</td></tr><tr>
<td>Code:</td><td><input style="width:150px;" type="text" name="courseCode" value="<?php echo $_smarty_tpl->tpl_vars['courseCode']->value;?>
" /></br></td>
</tr><tr>
<td>Cost: R</td><td><input style="width:50px;" type="text" name="price" value="<?php echo $_smarty_tpl->tpl_vars['coursePrice']->value;?>
" /></br></td>
</tr><tr>
<td>Tags: (seperated by ;)</td><td><textarea style="width:100%;" type="text" name="tags"><?php echo $_smarty_tpl->tpl_vars['courseTags']->value;?>
</textarea></br></td>
</tr>
</table>
</div>
<br />
<textarea style="width:80%;" id="courseIntroContent" name="courseIntroContent"><?php echo $_smarty_tpl->tpl_vars['courseHTML']->value;?>
</textarea>
<br />

<ul class="course_pack_list">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['name'] = 's1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['coursesList']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<label>
<li>
	<input type="checkbox" name="pack_includes" value="<?php echo $_smarty_tpl->tpl_vars['coursesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
" /> 
	<?php echo $_smarty_tpl->tpl_vars['coursesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['NAME'];?>
<br/>
	<?php echo $_smarty_tpl->tpl_vars['coursesList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['CODE'];?>
<br/>
	</li>
	</label>
<?php endfor; endif; ?>
</ul>
<br class="clear"/>
<div class="thinBorder"><h1>Permissions</h1>
<?php echo $_smarty_tpl->tpl_vars['coursePERM']->value;?>

</div>
<p><input type="submit" value="Submit" /></p>
</form>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'courseIntroContent' );
        CKEDITOR.replace( 'courseDescription' );
		CKEDITOR.config();
    };
</script>
<?php }} ?>
