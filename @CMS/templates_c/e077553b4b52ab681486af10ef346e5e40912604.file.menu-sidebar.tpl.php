<?php /* Smarty version Smarty-3.1.17, created on 2014-08-23 22:50:57
         compiled from "/home/denem/public_html/new/@CMS/templates/menu-sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24738123453bf1d1fde8bf8-48168291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e077553b4b52ab681486af10ef346e5e40912604' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/menu-sidebar.tpl',
      1 => 1408827053,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24738123453bf1d1fde8bf8-48168291',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53bf1d1fe4d8e4_46426022',
  'variables' => 
  array (
    'basepath' => 0,
    'ADMIN_DASHBOARD' => 0,
    'ADMIN_ADMINISTRATOR_TITLE' => 0,
    'galleryEnabled' => 0,
    'ADMIN_GALLERY_TITLE' => 0,
    'portfolioEnabled' => 0,
    'ADMIN_PORTFOLIOS' => 0,
    'ADMIN_PORTFOLIO_ITEMS' => 0,
    'ADMIN_PORTFOLIO_CATEGORIES' => 0,
    'ADMIN_PAGES_TITLE' => 0,
    'ADMIN_POSTS_TITLE' => 0,
    'ADMIN_POSTS_TITLE_LIST' => 0,
    'ADMIN_CATEGORIES_TITLE' => 0,
    'ADMIN_MENUS_TITLE' => 0,
    'sliderEnabled' => 0,
    'ADMIN_SLIDERS_TITLE' => 0,
    'ADMIN_TRANSLATIONS_TITLE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf1d1fe4d8e4_46426022')) {function content_53bf1d1fe4d8e4_46426022($_smarty_tpl) {?><div class="page-sidebar navbar-collapse collapse">
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
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_DASHBOARD']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/administrators.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
administrators">
               <i class="icon-user"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_ADMINISTRATOR_TITLE']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/mediaLibrary.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
mediaLibrary">
               <i class="icon-th"></i> 
               <span class="title">Media Library</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <?php if (($_smarty_tpl->tpl_vars['galleryEnabled']->value)) {?>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/gallery.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
galleries">
               <i class="icon-leaf"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_GALLERY_TITLE']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
            <?php }?>
            
            <?php if (($_smarty_tpl->tpl_vars['portfolioEnabled']->value)) {?>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/portfolios.php'||$_SERVER['SCRIPT_NAME']=='/@CMS/portfolioCategory.php'||$_SERVER['SCRIPT_NAME']=='/@CMS/portfolioItems.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
portfolioCategory">
               <i class="icon-group"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PORTFOLIOS']->value;?>
</span>
               <span class="arrow "></span>
               <span class="selected"></span>
               </a>
               <ul class="sub-menu">
                  <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/portfolioItems.php') {?>active<?php }?>">
                     <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
portfolioItems">
                     <?php echo $_smarty_tpl->tpl_vars['ADMIN_PORTFOLIO_ITEMS']->value;?>
</a>
                  </li>
                  <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/portfolioCategory.php') {?>active<?php }?>">
                     <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
portfolioCategories">
                     <?php echo $_smarty_tpl->tpl_vars['ADMIN_PORTFOLIO_CATEGORIES']->value;?>
</a>
                  </li>
                  <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/portfolios.php') {?>active<?php }?>">
                     <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
portfolios">
                     <?php echo $_smarty_tpl->tpl_vars['ADMIN_PORTFOLIOS']->value;?>
</a>
                  </li>
               </ul>
            </li>
            <?php }?>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/pages.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
pages">
               <i class="icon-file-text"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PAGES_TITLE']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
            
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/posts.php'||$_SERVER['SCRIPT_NAME']=='/@CMS/categories.php') {?>active<?php }?>">
               <a href="javascript:;">
               <i class="icon-bookmark-empty"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_POSTS_TITLE']->value;?>
</span>
               <span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                  <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/posts.php') {?>active<?php }?>">
                     <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
posts">
                     <?php echo $_smarty_tpl->tpl_vars['ADMIN_POSTS_TITLE_LIST']->value;?>
</a>
                  </li>
                  <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/categories.php') {?>active<?php }?>">
                     <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
categories">
                     <?php echo $_smarty_tpl->tpl_vars['ADMIN_CATEGORIES_TITLE']->value;?>
</a>
                  </li>
               </ul>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/menus.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
menus">
               <i class="icon-sitemap"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_MENUS_TITLE']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
          <?php if (($_smarty_tpl->tpl_vars['sliderEnabled']->value)) {?>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/sliders.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
sliders">
               <i class="icon-tasks"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_SLIDERS_TITLE']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
           <?php }?> 
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/translation.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
translation">
               <i class="icon-globe"></i> 
               <span class="title"><?php echo $_smarty_tpl->tpl_vars['ADMIN_TRANSLATIONS_TITLE']->value;?>
</span>
               <span class="selected"></span>
               </a>
            </li>
            
         </ul>
         <!-- END SIDEBAR MENU -->
      </div><?php }} ?>
