<?php /* Smarty version Smarty-3.1.17, created on 2014-07-11 02:10:29
         compiled from "/home/denem/public_html/new/@CMS/templates/menu-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120379643053bf1d1fdbbf27-85083678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a1491b16ef63b636119d6c19a165f2787a20916' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/menu-top.tpl',
      1 => 1405037426,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120379643053bf1d1fdbbf27-85083678',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53bf1d1fde68e4_43054961',
  'variables' => 
  array (
    'basepath' => 0,
    'loggedInUser' => 0,
    'ADMIN_MYPROFIL' => 0,
    'ADMIN_FULLSCREEN' => 0,
    'ADMIN_LOGOUT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf1d1fde68e4_43054961')) {function content_53bf1d1fde68e4_43054961($_smarty_tpl) {?><div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
         <a class="navbar-brand" href="index.html">
         <img src="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
include/img/logo-text.png" alt="logo" class="img-responsive" />
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
         <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="includes/img/menu-toggler.png" alt="" />
         </a> 
         <!-- END RESPONSIVE MENU TOGGLER -->
         <!-- BEGIN TOP NAVIGATION MENU -->
         <ul class="nav navbar-nav pull-right">


            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <img alt="" src="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
image/29/29/<?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['picture']!='') {?><?php echo $_smarty_tpl->tpl_vars['loggedInUser']->value['picture'];?>
<?php } else { ?>avatar.png<?php }?>"/>
               <span class="username"><?php echo $_smarty_tpl->tpl_vars['loggedInUser']->value['name'];?>
</span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
profile"><i class="icon-user"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_MYPROFIL']->value;?>
</a></li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_FULLSCREEN']->value;?>
</a></li>
                  <li><a href="?page=logout"><i class="icon-key"></i> <?php echo $_smarty_tpl->tpl_vars['ADMIN_LOGOUT']->value;?>
</a></li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div><?php }} ?>
