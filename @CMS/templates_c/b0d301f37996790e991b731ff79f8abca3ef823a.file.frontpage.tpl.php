<?php /* Smarty version Smarty-3.1.17, created on 2014-07-11 01:09:30
         compiled from "/home/denem/public_html/new/@CMS/templates/frontpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27576153653bf1d2aafb9c9-25844795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0d301f37996790e991b731ff79f8abca3ef823a' => 
    array (
      0 => '/home/denem/public_html/new/@CMS/templates/frontpage.tpl',
      1 => 1404995497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27576153653bf1d2aafb9c9-25844795',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ADMIN_SAVE_CHANGES' => 0,
    'ADMIN_CLOSE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53bf1d2ab55319_34942069',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf1d2ab55319_34942069')) {function content_53bf1d2ab55319_34942069($_smarty_tpl) {?>
         <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
         <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                     <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                     Widget settings form goes here
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn blue"><?php echo $_smarty_tpl->tpl_vars['ADMIN_SAVE_CHANGES']->value;?>
</button>
                     <button type="button" class="btn default" data-dismiss="modal"><?php echo $_smarty_tpl->tpl_vars['ADMIN_CLOSE']->value;?>
</button>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
         <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  
         <!-- BEGIN PAGE HEADER-->
         <?php echo $_smarty_tpl->getSubTemplate ("page-header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

         <!-- END PAGE HEADER-->
         <!-- BEGIN DASHBOARD STATS -->
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat blue">
                  <div class="visual">
                     <i class="icon-comments"></i>
                  </div>
                  <div class="details">
                     <div class="number">
                        1349
                     </div>
                     <div class="desc">                           
                        New Feedbacks
                     </div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat green">
                  <div class="visual">
                     <i class="icon-shopping-cart"></i>
                  </div>
                  <div class="details">
                     <div class="number">549</div>
                     <div class="desc">New Orders</div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat purple">
                  <div class="visual">
                     <i class="icon-globe"></i>
                  </div>
                  <div class="details">
                     <div class="number">+89%</div>
                     <div class="desc">Brand Popularity</div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="dashboard-stat yellow">
                  <div class="visual">
                     <i class="icon-bar-chart"></i>
                  </div>
                  <div class="details">
                     <div class="number">12,5M$</div>
                     <div class="desc">Total Profit</div>
                  </div>
                  <a class="more" href="#">
                  View more <i class="m-icon-swapright m-icon-white"></i>
                  </a>                 
               </div>
            </div>
         </div>
         <!-- END DASHBOARD STATS -->
         <?php }} ?>
