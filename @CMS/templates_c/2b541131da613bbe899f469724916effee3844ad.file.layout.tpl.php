<?php /* Smarty version Smarty-3.1.17, created on 2014-10-28 19:06:59
         compiled from "/hermes/bosoraweb110/b721/ipg.prosendnet/demo/@CMS/templates/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110147180254502193902861-55853043%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b541131da613bbe899f469724916effee3844ad' => 
    array (
      0 => '/hermes/bosoraweb110/b721/ipg.prosendnet/demo/@CMS/templates/layout.tpl',
      1 => 1414533168,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110147180254502193902861-55853043',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'login' => 0,
    'nestable' => 0,
    'xcrud_css' => 0,
    'content' => 0,
    'fileupload' => 0,
    'xcrud_js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_54502193bc9d59_93480326',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54502193bc9d59_93480326')) {function content_54502193bc9d59_93480326($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Administracija</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="includes/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <link href="assets/jquery.tagsinput.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
   <!-- BEGIN PAGE LEVEL STYLES --> 
	<link rel="stylesheet" type="text/css" href="includes/plugins/select2/select2_metro.css" />
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES --> 
	<link href="includes/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="includes/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="includes/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="includes/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="includes/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="includes/css/pages/login.css" rel="stylesheet" type="text/css"/>
	<link href="includes/css/custom.css" rel="stylesheet" type="text/css"/>
    <?php } else { ?>
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <link href="includes/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <link href="includes/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css" />
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="includes/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="includes/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="includes/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="includes/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="includes/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="includes/css/pages/profile.css" rel="stylesheet" type="text/css" />
   <link href="includes/plugins/dropzone/css/basic.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
   <link href="includes/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
   <link href="includes/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="includes/css/custom.css" rel="stylesheet" type="text/css"/>
   <?php if (isset($_smarty_tpl->tpl_vars['nestable']->value)) {?><link href="includes/css/jquery.nestable.css" rel="stylesheet" type="text/css"/><?php }?>

   <!-- END THEME STYLES -->
   <?php }?>
   <?php if (isset($_smarty_tpl->tpl_vars['xcrud_css']->value)) {?><?php echo $_smarty_tpl->tpl_vars['xcrud_css']->value;?>
<?php }?>
   <style>#SEO{min-width:100px;}</style>
   <link rel="shortcut icon" href="favicon.ico" />
   

   <!-- END JAVASCRIPTS -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="<?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>login<?php } else { ?>page-header-fixed<?php }?>">
   <?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['login']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

   <?php } else { ?>
   <!-- BEGIN HEADER -->   
   <?php echo $_smarty_tpl->getSubTemplate ("menu-top.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

   <!-- END HEADER -->
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
      <!-- BEGIN SIDEBAR -->
      <?php echo $_smarty_tpl->getSubTemplate ("menu-sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->
      <div class="page-content">
      
      <div class="row profile">
            <div class="col-md-12">
                <!-- BEGIN PAGE HEADER-->
                 <?php echo $_smarty_tpl->getSubTemplate ("page-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                 <!-- END PAGE HEADER-->
                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                </div>
         </div>
      </div>
      
      <!-- END PAGE -->
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="footer-inner">
         2014 &copy; Magnali.
      </div>
      <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
      </div>
   </div>
   <!-- END FOOTER -->
   <?php }?>
   
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="includes/plugins/respond.min.js"></script>
   <script src="includes/plugins/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="includes/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="includes/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
   <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
   <script src="includes/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
   <script src="includes/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="includes/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="includes/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="includes/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="includes/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="includes/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
    
   <script src="includes/scripts/app.js" type="text/javascript"></script>
   
   <?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="includes/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="includes/plugins/select2/select2.min.js"></script>     
	<script src="includes/scripts/login.js" type="text/javascript"></script> 
    <?php }?>
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="includes/scripts/index.js" type="text/javascript"></script>
   <script src="includes/scripts/tasks.js" type="text/javascript"></script>  
   <?php if (isset($_smarty_tpl->tpl_vars['nestable']->value)) {?> 
   <script src="includes/scripts/jquery.nestable.js" type="text/javascript"></script>   
   <script src="includes/scripts/ui-nestable.js" type="text/javascript"></script>   
   <?php }?> 
   
   <?php if (isset($_smarty_tpl->tpl_vars['fileupload']->value)) {?>
   <script src="includes/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
   <script src="includes/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
   <script src="includes/scripts/form-fileupload.js"></script>
   
   <?php }?>  
   <!-- END PAGE LEVEL SCRIPTS -->  
   <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins
         <?php if (isset($_smarty_tpl->tpl_vars['nestable']->value)) {?>UINestable.init();<?php }?>
         <?php if (isset($_smarty_tpl->tpl_vars['fileupload']->value)) {?>FormFileUpload.init();<?php }?>
         <?php if (isset($_smarty_tpl->tpl_vars['login']->value)) {?>
         Login.init();
         <?php } else { ?>
         Index.init();
         <?php }?>
      } );
   </script>
   
   <?php if (isset($_smarty_tpl->tpl_vars['xcrud_js']->value)) {?><?php echo $_smarty_tpl->tpl_vars['xcrud_js']->value;?>
<?php }?>
   
  
</body>
<!-- END BODY -->
</html><?php }} ?>
