<?php /* Smarty version Smarty-3.1.17, created on 2014-07-11 01:09:19
         compiled from "/home/denem/public_html/new/@CMS/templates/page-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170683817653bf1d1fe4fe33-13784206%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc8b10afa4d90b11af4943a0e3ca481748590891' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/page-header.tpl',
      1 => 1404995497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170683817653bf1d1fe4fe33-13784206',
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
  'unifunc' => 'content_53bf1d1fe6e4f5_33918484',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf1d1fe6e4f5_33918484')) {function content_53bf1d1fe6e4f5_33918484($_smarty_tpl) {?><div class="row">
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
