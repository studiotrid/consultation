<?php /* Smarty version Smarty-3.1.17, created on 2024-02-06 12:08:11
         compiled from "/var/www/html/@CMS/templates/menu-sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10931592115ae1e0c3dae3f8-46777221%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aeb0cc3d1f8f6097f78165de460dabdf45e69844' => 
    array (
      0 => '/var/www/html/@CMS/templates/menu-sidebar.tpl',
      1 => 1707221098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10931592115ae1e0c3dae3f8-46777221',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5ae1e0c3dd5449_98419899',
  'variables' => 
  array (
    'loggedInUser' => 0,
    'basepath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ae1e0c3dd5449_98419899')) {function content_5ae1e0c3dd5449_98419899($_smarty_tpl) {?><div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>

            </li>
            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['username']!='ikcg') {?>
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
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/api.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
api.php">
               <i class="icon-user"></i> 
               <span class="title">API korisnici</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/osiguranja.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
osiguranja.php">
               <i class="icon-th"></i> 
               <span class="title">Tarife PZO Osiguranja</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/dzo.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
dzo.php">
               <i class="icon-th"></i> 
               <span class="title">Tarife DZO Osiguranja</span>
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
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/zaposleni.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
zaposleni.php">
               <i class="icon-user"></i> 
               <span class="title">Zaposleni</span>
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
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/poliseKomdom.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
poliseKomdom.php">
               <i class="icon-file-text"></i> 
               <span class="title">Polise [komdom]</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/zastupnici.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
zastupnici.php">
               <i class="icon-user"></i> 
               <span class="title">Zastupnici</span>
               <span class="selected"></span>
               </a>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/popusti.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
popusti.php">
               <i class="icon-arrow-down-right-2"></i> 
               <span class="title">Popusti</span>
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
            
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/standalone-nezgoda.php'||$_SERVER['SCRIPT_NAME']=='/@CMS/standalone-imovina.php') {?>active<?php }?>">
               <a href="#">
               <i class="icon-user"></i> 
               <span class="title">Standalone</span>
               <span class="selected"></span><span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/standalone-nezgoda.php') {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
standalone-nezgoda.php">Nezgoda</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/standalone-imovina.php') {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
standalone-imovina.php">Imovina</a></li>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/minikasko.php') {?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
minikasko.php">MiniKasko</a></li>
               </ul>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/eplacanje.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
eplacanje.php">
               <i class="icon-user"></i> 
               <span class="title">E-plaćanje</span>
               <span class="selected"></span><span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
eplacanje.php?tip=polisa">Polisa</a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
eplacanje.php?tip=polisa&status=paid">Plaćeno</a></li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
eplacanje.php?tip=polisa&status=process">U procesu</a></li>
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
eplacanje.php?tip=polisa&status=fail">Greška</a></li>
                        </ul>
                    </li>
               </ul>
            </li>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/pages.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
pages">
               <i class="icon-file-text"></i> 
               <span class="title">Stranice</span>
               <span class="selected"></span>
               </a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['loggedInUser']->value['username']!='natasa.todorovic') {?>
                <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/forma.php') {?>active<?php }?>">
                   <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
forma.php">
                   <i class="icon-file-text"></i> 
                   <span class="title">IKCG - prijave</span>
                   <span class="selected"></span>
                   </a>
                </li>
            <?php }?>
            <?php } else { ?>
            
            <li class="<?php if ($_SERVER['SCRIPT_NAME']=='/@CMS/forma.php') {?>active<?php }?>">
               <a href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
forma.php">
               <i class="icon-file-text"></i> 
               <span class="title">IKCG - prijave</span>
               <span class="selected"></span>
               </a>
            </li>
            
          <?php }?>
            
         </ul>
         <!-- END SIDEBAR MENU -->
      </div><?php }} ?>
