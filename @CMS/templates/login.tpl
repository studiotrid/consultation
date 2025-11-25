<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="includes/img/logo-w.png" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="login.php" method="post">
            <input type="hidden" name="login"/>
			<h3 class="form-title">{$ADMIN_LOGIN_TITLE|default:""}</h3>
			<div class="alert alert-error {if isset($message)}{else}hide{/if}">
				<button class="close" data-dismiss="alert"></button>
				<span>{if isset($message)}{$message}{/if}</span>
			</div>
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">{$ADMIN_USERNAME}</label>
				<div class="input-icon">
					<i class="icon-user"></i>
					<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="{$ADMIN_USERNAME}" name="username"/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">{$ADMIN_PASSWORD}</label>
				<div class="input-icon">
					<i class="icon-lock"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="{$ADMIN_PASSWORD}" name="password"/>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> {$ADMIN_REMEMBER}
				</label>
				<button type="submit" class="btn green pull-right">
				{$ADMIN_LOGIN} <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
  </div>