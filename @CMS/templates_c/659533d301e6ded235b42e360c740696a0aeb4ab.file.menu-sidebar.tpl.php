<?php /* Smarty version Smarty-3.1.17, created on 2018-04-02 00:54:09
         compiled from "/home/savaos/webshop.sava-osiguranje.rs/@CMS/templates/menu-sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9069251975a442f5a424ae8-26161734%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '659533d301e6ded235b42e360c740696a0aeb4ab' => 
    array (
      0 => '/home/savaos/webshop.sava-osiguranje.rs/@CMS/templates/menu-sidebar.tpl',
      1 => 1522623245,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9069251975a442f5a424ae8-26161734',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5a442f5a49c183_96580339',
  'variables' => 
  array (
    'basepath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a442f5a49c183_96580339')) {function content_5a442f5a49c183_96580339($_smarty_tpl) {?><div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>

            </li>
            <li class="start <?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/index.php') {?>active<?php }?> ">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
">
               <i class="icon-home"></i> 
               <span class="title">Kontrolna strana</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/administrators.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
administrators">
               <i class="icon-user"></i> 
               <span class="title">Administratori</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/osiguranja.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
osiguranja.php">
               <i class="icon-th"></i> 
               <span class="title">Cene Osiguranja</span>
               <span class="selected"></span>
               </a>
            </li>
            
           <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/registrovani.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
registrovani.php">
               <i class="icon-user"></i> 
               <span class="title">Registrovani korisnici</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/promo-kod.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
promo-kod.php">
               <i class="icon-th"></i> 
               <span class="title">Promo kodovi</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/polise.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
polise.php">
               <i class="icon-file-text"></i> 
               <span class="title">Polise</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/reffer.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
reffer.php">
               <i class="icon-user"></i> 
               <span class="title">Reffer</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/pages.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
pages">
               <i class="icon-file-text"></i> 
               <span class="title">Stranice</span>
               <span class="selected"></span>
               </a>
            </li>
            
          
            
         </ul>
         <!-- END SIDEBAR MENU -->
      </div><?php }} ?>
