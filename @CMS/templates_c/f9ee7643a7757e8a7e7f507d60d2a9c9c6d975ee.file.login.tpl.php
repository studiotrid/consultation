<?php /* Smarty version Smarty-3.1.17, created on 2023-08-03 13:28:37
         compiled from "/var/www/html/@CMS/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18080979075ae1e05c4b40b1-13400603%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9ee7643a7757e8a7e7f507d60d2a9c9c6d975ee' => 
    array (
      0 => '/var/www/html/@CMS/templates/login.tpl',
      1 => 1691069315,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18080979075ae1e05c4b40b1-13400603',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5ae1e05c4ccb13_41448320',
  'variables' => 
  array (
    'ADMIN_LOGIN_TITLE' => 0,
    'message' => 0,
    'ADMIN_USERNAME' => 0,
    'ADMIN_PASSWORD' => 0,
    'ADMIN_REMEMBER' => 0,
    'ADMIN_LOGIN' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ae1e05c4ccb13_41448320')) {function content_5ae1e05c4ccb13_41448320($_smarty_tpl) {?><!-- BEGIN LOGO -->
	<div class="logo">
		<img src="includes/img/logo-w.png" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="login.php" method="post">
            <input type="hidden" name="login"/>
			<h3 class="form-title"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['ADMIN_LOGIN_TITLE']->value)===null||$tmp==='' ? '' : $tmp);?>
</h3>
			<div class="alert alert-error <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?><?php } else { ?>hide<?php }?>">
				<button class="close" data-dismiss="alert"></button>
				<span><?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
<?php }?></span>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9"><?php echo $_smarty_tpl->tpl_vars['ADMIN_USERNAME']->value;?>
</label>
				<div class="input-icon">
					<i class="icon-user"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo $_smarty_tpl->tpl_vars['ADMIN_USERNAME']->value;?>
" name="username"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9"><?php echo $_smarty_tpl->tpl_vars['ADMIN_PASSWORD']->value;?>
</label>
				<div class="input-icon">
					<i class="icon-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo $_smarty_tpl->tpl_vars['ADMIN_PASSWORD']->value;?>
" name="password"/>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> <?php echo $_smarty_tpl->tpl_vars['ADMIN_REMEMBER']->value;?>

				</label>
				<button type="submit" class="btn green pull-right">
				<?php echo $_smarty_tpl->tpl_vars['ADMIN_LOGIN']->value;?>
 <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
  </div><?php }} ?>
