<?php /* Smarty version Smarty-3.1.17, created on 2014-10-28 19:23:52
         compiled from "/hermes/bosoraweb110/b721/ipg.prosendnet/demo/@CMS/templates/menu-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:441231143545022e2784562-87764413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ebcfee72d80692f956f10c6114ed9ceafd93e68d' => 
    array (
      0 => '/hermes/bosoraweb110/b721/ipg.prosendnet/demo/@CMS/templates/menu-top.tpl',
      1 => 1414538629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '441231143545022e2784562-87764413',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_545022e28b5998_44330095',
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
<?php if ($_valid && !is_callable('content_545022e28b5998_44330095')) {function content_545022e28b5998_44330095($_smarty_tpl) {?><div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
         <a class="navbar-brand" href="index.html">
         <img src="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
includes/img/logo.png" alt="logo" class="img-responsive" />
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
