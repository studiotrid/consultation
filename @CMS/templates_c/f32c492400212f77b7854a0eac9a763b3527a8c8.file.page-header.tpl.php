<?php /* Smarty version Smarty-3.1.17, created on 2018-04-26 14:22:59
         compiled from "/var/www/html/@CMS/templates/page-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7353325735ae1e0c3dd6ec9-43371433%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f32c492400212f77b7854a0eac9a763b3527a8c8' => 
    array (
      0 => '/var/www/html/@CMS/templates/page-header.tpl',
      1 => 1514397367,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7353325735ae1e0c3dd6ec9-43371433',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_title' => 0,
    'ADMIN_HOME' => 0,
    'breadcrumbs' => 0,
    'basepath' => 0,
    'bread' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5ae1e0c3de7908_49928010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ae1e0c3de7908_49928010')) {function content_5ae1e0c3de7908_49928010($_smarty_tpl) {?><div class="row">
            <div class="col-md-12">
               <!-- BEGIN PAGE TITLE & BREADCRUMB-->
               <h3 class="page-title">
                  <?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>

               </h3>
               <ul class="page-breadcrumb breadcrumb">
                  <li>
                     <i class="icon-home"></i>
                     <a href="index.html"><?php echo $_smarty_tpl->tpl_vars['ADMIN_HOME']->value;?>
</a> 
                     <i class="icon-angle-right"></i>
                  </li>
                  <?php  $_smarty_tpl->tpl_vars['bread'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['bread']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['breadcrumbs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['bread']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['step']['total'] = $_smarty_tpl->tpl_vars['bread']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['step']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['bread']->key => $_smarty_tpl->tpl_vars['bread']->value) {
$_smarty_tpl->tpl_vars['bread']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['step']['iteration']++;
?>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
<?php echo $_smarty_tpl->tpl_vars['bread']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['bread']->value['title'];?>
</a><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['step']['iteration']==$_smarty_tpl->getVariable('smarty')->value['foreach']['step']['total']) {?><?php } else { ?><i class="icon-angle-right"></i><?php }?></li>
                  <?php } ?>
               </ul>
               <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
         </div><?php }} ?>
