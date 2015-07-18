<?php /* Smarty version Smarty-3.1.17, created on 2015-07-18 13:22:29
         compiled from "./templates/courses_form_editArticles.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1862577749550f13acc9aeb9-37234585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '294f01d0d586001e81af6bfd8952b2575513e654' => 
    array (
      0 => './templates/courses_form_editArticles.tpl',
      1 => 1437225747,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1862577749550f13acc9aeb9-37234585',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_550f13acd93540_09109669',
  'variables' => 
  array (
    'articleData' => 0,
    'tableData' => 0,
    'iconsPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550f13acd93540_09109669')) {function content_550f13acd93540_09109669($_smarty_tpl) {?><span class="bold"><?php echo $_smarty_tpl->tpl_vars['articleData']->value['COURSENAME'];?>
</span>
<br/>
<p><a href="courses.php?f=admin_CourseManage">Back to Courses</a></p>
<p><a href="articles.php?f=editArticle&cid=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['COURSEID'];?>
">Add a New Article</a><br/>
<a href="courses.php?f=editResource&cid=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['COURSEID'];?>
">Add a New Resource</a></p>
<br/>
Articles:
<?php if (isset($_smarty_tpl->tpl_vars['tableData']->value)) {?>
<table class="admin_view_table">
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['s1']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['name'] = 's1';
$_smarty_tpl->tpl_vars['smarty']->value['section']['s1']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['tableData']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
<td><?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ITEMNAME'];?>
</td>
<?php if (isset($_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['s1']['index']]['VIEW'])) {?>
<td><a href="articles.php?f=displayArticle&id=<?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
magnifier.png" alt="View"/><?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['NAME'];?>
</a><td>
<?php } else { ?>
<td></td>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['s1']['index']]['MODIFY'])) {?>
<td><a href="articles.php?f=mod_article&aid=<?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
pencil.png" alt="Edit"/>Edit</a></td>
<td><a href="courses.php?f=editArticles&id=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['COURSEID'];?>
&root=<?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
pencil.png" alt="Edit Articles"/>sub-Articles</a></td>
<td><a href="articles.php?q=mv_art&id=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['ID'];?>
&dir=up&aid=<?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
arrow_up.png" alt="Move Up"/></a></td>
<td><a href="articles.php?q=mv_art&id=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['ID'];?>
&dir=down&aid=<?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
arrow_up.png" alt="Move Down"/></a></td>
<?php } else { ?>
<td></td>
<td></td>
<td></td>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['s1']['index']]['DELETE'])) {?>
<td><a href="articles.php?confirm&q=removeArticle&aid=<?php echo $_smarty_tpl->tpl_vars['tableData']->value[$_smarty_tpl->getVariable('smarty')->value['section']['s1']['index']]['ID'];?>
&cid=<?php echo $_smarty_tpl->tpl_vars['articleData']->value['ID'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['iconsPath']->value;?>
cancel.png" alt="Delete"/></a></td>
<?php } else { ?>
<td></td>
<?php }?>
</tr>
<?php endfor; endif; ?>
</table>
<?php }?>
<?php }} ?>
